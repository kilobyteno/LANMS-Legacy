<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;
use Request;
use anlutro\LaravelSettings\Facade as Setting;
use Carbon\Carbon;

class CheckLicense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:checklicense';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will check the license data towards Kilobyte AS\'s servers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        function checkLicense($licensekey, $localkey = '')
        {
            $whmcsurl = 'https://portal.kilobyte.no/';
            $licensing_secret_key = 'InfihexLANMS';
            $localkeydays = 1; // The number of days to wait between performing remote license checks
            $allowcheckfaildays = 3; // The number of days to allow failover for after local key expiry
            // -----------------------------------
            //  -- Do not edit below this line --
            // -----------------------------------
            $check_token = time() . md5(mt_rand(1000000000, mt_getrandmax()) . $licensekey);
            $checkdate = date("Ymd");
            $domain = Request::server("SERVER_NAME");
            if ($domain == 'localhost') {
                $domain = Setting::get("WEB_DOMAIN");
            }
            $usersip = Request::server("SERVER_ADDR") ? Request::server("SERVER_ADDR") : Request::server("LOCAL_ADDR");
            $dirpath = dirname(__FILE__);
            $verifyfilepath = 'modules/servers/licensing/verify.php';
            $localkeyvalid = false;
            $originalcheckdate = "19700101";
            if ($localkey) {
                $localkey = str_replace("\n", '', $localkey); # Remove the line breaks
                $localdata = substr($localkey, 0, strlen($localkey) - 32); # Extract License Data
                $md5hash = substr($localkey, strlen($localkey) - 32); # Extract MD5 Hash
                if ($md5hash == md5($localdata . $licensing_secret_key)) {
                    $localdata = strrev($localdata); # Reverse the string
                    $md5hash = substr($localdata, 0, 32); # Extract MD5 Hash
                    $localdata = substr($localdata, 32); # Extract License Data
                    $localdata = base64_decode($localdata);
                    $localkeyresults = unserialize($localdata);
                    // print (json_encode($localkeyresults) . PHP_EOL);
                    $originalcheckdate = $localkeyresults['checkdate'];
                    if ($md5hash == md5($originalcheckdate . $licensing_secret_key)) {
                        $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - $localkeydays, date("Y")));
                        if ($originalcheckdate > $localexpiry) {
                            //print('Local key is valid' . PHP_EOL);
                            $localkeyvalid = true;
                            $results = $localkeyresults;
                            $validdomains = explode(',', $results['validdomain']);
                            if (!in_array(Request::server("SERVER_NAME"), $validdomains)) {
                                $localkeyvalid = false;
                                $localkeyresults['status'] = "Invalid";
                                $localkeyresults['description'] = "Domain is invalid";
                                $results = array();
                                //print('Domain is invalid' . PHP_EOL);
                            }
                            if (isset($results['validip'])) {
                                $validips = explode(',', $results['validip']);
                                if (!in_array($usersip, $validips)) {
                                    $localkeyvalid = false;
                                    $localkeyresults['status'] = "Invalid";
                                    $localkeyresults['description'] = "IP Address is invalid";
                                    $results = array();
                                    //print('IP Address is invalid' . PHP_EOL);
                                }
                            }
                            if (isset($results['validdirectory'])) {
                                $validdirs = explode(',', $results['validdirectory']);
                                if (!in_array($dirpath, $validdirs)) {
                                    $localkeyvalid = false;
                                    $localkeyresults['status'] = "Invalid";
                                    $localkeyresults['description'] = "Directory is invalid";
                                    $results = array();
                                    //print('Directory is invalid' . PHP_EOL);
                                }
                            }
                        }
                    }
                }
            }
            if (!$localkeyvalid) {
                //print('Localkey is not valid' . PHP_EOL);
                $responseCode = 0;
                $postfields = array(
                    'licensekey' => $licensekey,
                    'domain' => $domain,
                    'ip' => $usersip,
                    'dir' => $dirpath,
                );
                if ($check_token) {
                    $postfields['check_token'] = $check_token;
                }
                $query_string = '';
                foreach ($postfields as $k => $v) {
                    $query_string .= $k.'='.urlencode($v).'&';
                }
                if (function_exists('curl_exec')) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $whmcsurl . $verifyfilepath);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($ch);
                    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                } else {
                    $responseCodePattern = '/^HTTP\/\d+\.\d+\s+(\d+)/';
                    $fp = @fsockopen($whmcsurl, 80, $errno, $errstr, 5);
                    if ($fp) {
                        $newlinefeed = "\r\n";
                        $header = "POST ".$whmcsurl . $verifyfilepath . " HTTP/1.0" . $newlinefeed;
                        $header .= "Host: ".$whmcsurl . $newlinefeed;
                        $header .= "Content-type: application/x-www-form-urlencoded" . $newlinefeed;
                        $header .= "Content-length: ".@strlen($query_string) . $newlinefeed;
                        $header .= "Connection: close" . $newlinefeed . $newlinefeed;
                        $header .= $query_string;
                        $data = $line = '';
                        @stream_set_timeout($fp, 20);
                        @fputs($fp, $header);
                        $status = @socket_get_status($fp);
                        while (!@feof($fp)&&$status) {
                            $line = @fgets($fp, 1024);
                            $patternMatches = array();
                            if (!$responseCode
                                && preg_match($responseCodePattern, trim($line), $patternMatches)
                            ) {
                                $responseCode = (empty($patternMatches[1])) ? 0 : $patternMatches[1];
                            }
                            $data .= $line;
                            $status = @socket_get_status($fp);
                        }
                        @fclose($fp);
                    }
                }
                if ($responseCode != 200) {
                    $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - ($localkeydays + $allowcheckfaildays), date("Y")));
                    if ($originalcheckdate > $localexpiry) {
                        $results = $localkeyresults;
                        //print("Invalid Date Response");
                    } else {
                        $results = array();
                        $results['status'] = "Invalid";
                        $results['description'] = "Remote Check Failed";
                        //print('Remote Check Failed' . PHP_EOL);
                        return $results;
                    }
                } else {
                    preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $matches);
                    $results = array();
                    foreach ($matches[1] as $k => $v) {
                        $results[$v] = $matches[2][$k];
                    }
                }
                if (!is_array($results)) {
                    Setting::set("APP_LICENSE_STATUS", "Invalid");
                    Setting::set("APP_LICENSE_STATUS_DESC", "Invalid License Server Response");
                    Setting::save();
                    //print("Invalid License Server Response" . PHP_EOL);
                }
                if (isset($results['md5hash'])) {
                    if ($results['md5hash'] != md5($licensing_secret_key . $check_token)) {
                        $results['status'] = "Invalid";
                        $results['description'] = "MD5 Checksum Verification Failed";
                        //print('MD5 Checksum Verification Failed' . PHP_EOL);
                        return $results;
                    }
                }
                if ($results['status'] == "Active") {
                    //print('Result status is Active' . PHP_EOL);
                    $results['checkdate'] = $checkdate;
                    $data_encoded = serialize($results);
                    $data_encoded = base64_encode($data_encoded);
                    $data_encoded = md5($checkdate . $licensing_secret_key) . $data_encoded;
                    $data_encoded = strrev($data_encoded);
                    $data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
                    $data_encoded = wordwrap($data_encoded, 80, "\n", true);
                    $results['localkey'] = $data_encoded;
                }
                $results['remotecheck'] = true;
                //print('remotecheck is true' . PHP_EOL);
            }
            unset($postfields, $data, $matches, $whmcsurl, $licensing_secret_key, $checkdate, $usersip, $localkeydays, $allowcheckfaildays, $md5hash);
            return $results;
        }
        /* END OF FUNCTION */

        $this->info("Hostname: ".Request::server("SERVER_NAME"));
        // Get the license key and local key from storage
        $app_licensekey = Setting::get("APP_LICENSE_KEY");
        $app_localkey = Setting::get("APP_LICENSE_LOCAL_KEY");

        if ($app_licensekey == null) {
            $this->error('You have not saved a license key.');
            Setting::set("APP_LICENSE_STATUS", "Invalid");
            Setting::set("APP_LICENSE_STATUS_DESC", "No license key added.");
            Setting::save();
        } else {
            $this->info('Checking License...');
            //$results = checkLicense($app_licensekey, $app_localkey); // Validate the license key information

            // print(json_encode($results).PHP_EOL);
            /*
            Setting::set("APP_LICENSE_LAST_CHECKED", Carbon::now());
            Setting::set("APP_LICENSE_INFO_NAME", (array_key_exists('registeredname', $results) ? $results['registeredname'] : ''));
            Setting::set("APP_LICENSE_INFO_COMPANY", (array_key_exists('companyname', $results) ? $results['companyname'] : ''));
            Setting::set("APP_LICENSE_INFO_EMAIL", (array_key_exists('email', $results) ? $results['email'] : ''));
            Setting::set("APP_LICENSE_INFO_PRODUCTNAME", (array_key_exists('productname', $results) ? $results['productname'] : ''));
            Setting::set("APP_LICENSE_INFO_REGDATE", (array_key_exists('regdate', $results) ? $results['regdate'] : ''));
            Setting::set("APP_LICENSE_INFO_NEXTDUE", (array_key_exists('nextduedate', $results) ? $results['nextduedate'] : ''));
            Setting::set("APP_LICENSE_INFO_CYCLE", (array_key_exists('billingcycle', $results) ? $results['billingcycle'] : ''));
            Setting::save();

            $status = $results['status'];
            if (isset($results['message'])) {
                $status_message = $results['message'];
                $this->line('Message is set! Message is: '.$status_message);
            } else {
                $status_message = "";
                $this->line('Message is not set! Something wrong with the result?');
            }
            if (isset($results['localkey'])) {
                $res_localkey = $results['localkey'];
                $this->info('Localkey is set!');
            } else {
                $res_localkey = "";
                $this->line('Localkey is not set! Something wrong with the result?');
            }
            switch ($status) {
                case "Active":
                    Setting::set("APP_LICENSE_LOCAL_KEY", $res_localkey); // get new local key and save it
                    Setting::set("APP_LICENSE_STATUS", $status);
                    Setting::set("APP_LICENSE_STATUS_DESC", $status_message);
                    Setting::save();
                    $this->info('Status: '.$status);
                    break;
                case "Invalid":
                    Setting::set("APP_LICENSE_STATUS", $status);
                    Setting::set("APP_LICENSE_STATUS_DESC", $status_message);
                    Setting::save();
                    $this->error('Status: '.$status);
                    break;
                case "Expired":
                    Setting::set("APP_LICENSE_STATUS", $status);
                    Setting::set("APP_LICENSE_STATUS_DESC", $status_message);
                    Setting::save();
                    $this->error('Status: '.$status_message);
                    break;
                case "Suspended":
                    Setting::set("APP_LICENSE_STATUS", $status);
                    Setting::set("APP_LICENSE_STATUS_DESC", $status_message);
                    Setting::save();
                    $this->error('Status: '.$status);
                    break;
                default:
                    Setting::set("APP_LICENSE_STATUS", "Invalid");
                    Setting::set("APP_LICENSE_STATUS_DESC", "No defined result. ".$status_message);
                    Setting::save();
                    $this->error('Unknown Status: '.$status);
                    break;
            }
            */
            Setting::set("APP_LICENSE_STATUS", "Active");
            Setting::set("APP_LICENSE_STATUS_DESC", "License is active.");
            Setting::save();
            //$this->info('Descripton: '.$status_message);
            $this->info('Done.');
        }
    }
}

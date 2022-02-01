<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;
use LANMS\Info;

class RefreshInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:refreshinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will update all infos with proper description fields.';

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
        $infos = Info::all();
        $descriptions = array(
            'when' => 'Add simple view of when the event is happening. For example "21. Dec - 24. Dec 2020".',
            'where' => 'Add name of the venue or location. For example "Kilobyte Arena".',
            'where_url' => 'Add Google Maps URL to the event location. Preferably a Google short URL.',
            'price' => 'This is not used for Stripe, it is just for a simple view. For example "300kr".',
            'price_alt' => 'If you have a increased price for the entrance. This is not used for Stripe, it is just for a simple view. For example "350kr".',
            'where_url' => 'Add Google Maps URL to the event location. Preferably a Google short URL.',
            'address_street' => 'This will be used for invoices.',
            'address_postal_code' => 'This will be used for invoices.',
            'address_city' => 'This will be used for invoices.',
            'address_county' => 'This will be used for invoices.',
            'address_country' => 'This will be used for invoices.',
            'social_facebook' => 'Add the trailing end of the facebook URL. For example the URL is "https://facebook.com/kilobyteno", then input "kilobyteno".',
            'social_twitter' => 'Add the trailing end of the twitter URL. For example the URL is "https://twitter.com/kilobyteno", then input "kilobyteno".',
            'social_instagram' => 'Add the trailing end of the instagram URL. For example the URL is "https://instagram.com/kilobyteno", then input "kilobyteno".',
            'social_youtube' => 'Add the trailing end of the youtube URL. For example the URL is "https://youtube.com/kilobyteno", then input "kilobyteno".',
            'social_snapchat' => 'Add the username of the snapchat account.',
            'social_twitch' => 'Add the trailing end of the twitch URL. For example the URL is "https://twitch.com/kilobyteno", then input "kilobyteno".',
            'social_discord' => 'You need to register your server at https://discord.me/ you use the URL generated there. For example the URL is "https://discord.me/kilobyteno", then input "kilobyteno".',
            'social_discord_server_id' => 'Find the server ID under "Widget" in the server settings. Remeber to have "Enable Server Widget" enabled under the same page.',
        );
        foreach ($infos as $info) {
            if (array_key_exists($info->name, $descriptions)) {
                if (is_null($info->description) || $info->description != $descriptions[$info->name]) {
                    $info->description = $descriptions[$info->name];
                    $info->save();
                    $this->info('Updated description for '.$info->name);
                }
            }
        }
    }
}

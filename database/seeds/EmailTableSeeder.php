<?php

use Illuminate\Database\Seeder;
use LANMS\Email;

class EmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Email::create(array(
            'content' =>  '<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
    *{font-family:"Helvetica Neue",Helvetica,Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0}.btn-primary td,h1,h2,h3,h4,p{font-family:"Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif}img{max-width:300px;width:100%}body{-webkit-font-smoothing:antialiased;height:100%;-webkit-text-size-adjust:none;width:100%!important}a{color:#348eda}.btn-primary{Margin-bottom:10px;width:auto!important}.btn-primary td{background-color:#348eda;border-radius:25px;font-size:14px;text-align:center;vertical-align:top}.btn-primary td a{background-color:#348eda;border:1px solid #348eda;border-radius:25px;border-width:10px 20px;display:inline-block;color:#fff;cursor:pointer;font-weight:700;line-height:2;text-decoration:none}.last{margin-bottom:0}.first{margin-top:0}.padding{padding:10px 0}table.body-wrap{padding:20px;width:100%}table.body-wrap .container{border:1px solid #f0f0f0;border-radius:6px}table.footer-wrap{clear:both!important;width:100%}.footer-wrap .container p{color:#666;font-size:12px}table.footer-wrap a{color:#999}h1,h2,h3{color:#111;font-weight:200;line-height:1.2em;margin:40px 0 10px}h1{font-size:36px}h2{font-size:28px}h3{font-size:22px}ol,p,ul{font-size:14px;font-weight:400;margin-bottom:10px}ol li,ul li{margin-left:5px;list-style-position:inside}.container{clear:both!important;display:block!important;Margin:0 auto!important;max-width:600px!important}.body-wrap .container{padding:20px}.content{display:block;margin:0 auto;max-width:600px}.content table{width:100%}hr{height:0;margin-top:17px;margin-bottom:17px;border:0;border-top:1px solid #eee}small{font-size:85%}h4{font-weight:500;line-height:1.1;color:#373e4a;font-size:15px}h4 small{font-weight:400;line-height:1;color:#999;font-size:75%}
</style>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

            <!-- content -->
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <img src="http://lanms.io/images/lanms_light.png" width="300"><br>
                            <h2>Forgot Password</h2>
                            <hr>
                                        
                             

It looks as if you have requested to reset your password. Use the link below to create a new password for your account. If you did not expect this email, you can safely ignore it.<br><br>

Reset Password URL: <a href="http://lanms.io/account/password/reset/E6Bw2xhsmAb5ypqCvhBkeL5FIYLNRVNe">http://lanms.io/account/password/reset/E6Bw2xhsmAb5ypqCvhBkeL5FIYLNRVNe</a><br>
<small>http://lanms.io/account/password/reset/E6Bw2xhsmAb5ypqCvhBkeL5FIYLNRVNe</small><br><br>


If you have any questions at all, feel free to contact us!<br>


                            <p>&nbsp;</p>
                            <p>&mdash; LANMS</p>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /content -->

        </td>
        <td></td>
    </tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">

            <!-- content -->
            <div class="content">
                <table>
                    <tr>
                        <td align="center">
                            <h4><small><em>You received this email because you registered on:</em></small><br><a href="http://lanms.io/">lanms.io</a></h4>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /content -->

        </td>
        <td></td>
    </tr>
</table>
<!-- /footer -->

</body>
</html>  
',
            'subject' => 'Test Email',
            'author_id' => 1,
        ))->users()->attach([1,2,3]);
    }
}

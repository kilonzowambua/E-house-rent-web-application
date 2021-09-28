<?php
/*
 * Created on Tue Aug 24 2021
 *
 * 
 * The MIT License (MIT)
 * Copyright (c) 2021 Devlan Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


require_once('../config/config.php');
/* Mailer Configurations */
require_once('../vendor/PHPMailer/src/SMTP.php');
require_once('../vendor/PHPMailer/src/PHPMailer.php');
require_once('../vendor/PHPMailer/src/Exception.php');

$ret = "SELECT * FROM `Ubc_Mailer_Settings`  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->setFrom($sys->mailer_mail_from_email);
    $mail->addAddress($staff_email);
    $mail->FromName = $sys->mailer_mail_from_name;
    $mail->isHTML(true);
    $mail->IsSMTP();
    $mail->SMTPSecure = $sys->mailer_protocol;
    $mail->Host = $sys->mailer_host;
    $mail->SMTPAuth = true;
    $mail->Port = $sys->mailer_port;
    $mail->Username = $sys->mailer_username;
    $mail->Password = $sys->mailer_password;
    $mail->Subject = 'Staff Account Authentication Credentials';
    /* Custom Mail Body */
    $mail->Body = '
    <!doctype html>
    <html lang="en-US">
    
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Staff Authentication credential</title>
        <meta name="description" content="Reset Password Email">
        <style type="text/css">
            a:hover {text-decoration: underline !important;}
        </style>
    </head>
    
    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <!--100% body table-->
        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
            <tr>
                <td>
                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                        align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                              <a href="https://ubc.co.ke" title="logo" target="_blank">
                                <img width="200" src="https://ubc.co.ke/public/images/logo/logo.jpg" title="logo" alt="Logo">
                              </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                    style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0 35px;">
                                            <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Staff Account Authentication Credentials</h1>
                                            <span
                                                style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                Hi there, <br>
                                                Your <b> Ukamba Bible College Portal </b> staff account has been activated.
                                            </p>
                                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                               These are your staff login credentials :<br>
                                               Staff Number:<b>' . $staff_number . '</b>
                                               <br>
                                               Password:<b>' . $staff_idno . '</b>
                                               <br>
                                               Kindly change it after login
                                               <br>
                                               <br>
                                               Kind Regards<br>
                                               <b>Ukamba Bible College IT Team </b> <br>
                                               <i>
                                                    Ukamba Bible College is a community of students, teachers and other workers committed to serve the Lord.
                                               </i>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; ' . date('Y') . ' <strong> Ukamba Bible College MIS. A <a href="https://devlan.martdev.info/"> DevLan Inc </a> Production</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    ';
}

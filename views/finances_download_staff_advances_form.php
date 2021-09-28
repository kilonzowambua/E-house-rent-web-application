<?php
/*
 * Created on Thu Aug 26 2021
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
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
require_once '../config/codeGen.php';
superadmin_check_login();
require_once('../vendor/autoload.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

/* Convert Logo To Base64 Image */
$path = '../public/img/logo_preloader.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$ubc_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

$ret = "SELECT * FROM   Ubc_Academic_Calendar   WHERE academic_calendar_status = 'Current'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($current = $res->fetch_object()) {
    $html = '
    <!DOCTYPE html>
    <html>

        <head>
            <meta name="" content="XYZ,0,0,1" />
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
        </head>

        <body style="margin:1px;">
            <div class="footer">
                <hr>
                <i> <b> This Form Is Only Valid If It Bears  Clerk`s Signature And Principal`s Stamp. Generated On ' . date('d M Y') . '</b></i>
            </div>

            <h3 class="list_header" align="center">
                <img src="' . $ubc_logo . '" align="center">
                <br>
                <h3>
                    UKAMBA BIBLE COLLEGE <br>
                    P.O BOX 1271-90100 - MACHAKOS, KENYA <br>
                    0727459365 / 0716795859 <br>
                    www.ubc.co.ke
                </h3>
                <hr style="width:100%" , color=black>
                <hr class="red">
                <h4> Staff Advances </h4>
            </h3>

            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Staff Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Signature</th>
                </tr>
            </thead>
            ';
    $rows = 1;
    $cnt = 1;
    while ($rows <= 25) {
        $html .=
            '
                <tr>
                    <td width="2%">' . $cnt . '</td>
                    <td width="100%"> </td>
                    <td width="35%"> </td>
                    <td width="40%"> </td>
                    <td width="85%"> </td>
                </tr>
                ';
        $rows++;
        $cnt = $cnt + 1;
    }
    $html .= '
            </table>
            <br><br><br><br><br>
            <table cellspacing="0" style="font-size:10pt">
                <tr>
                    <td id="bold_row" style="text-align: center;">Clerk Signature :  </td>
                    <td>...........................................................</td>
                    <td id="bold_row" style="text-align: center;">Date:</td>
                    <td>....................................</td>
                </tr>
            </table>
            <br><br><br>
        </body>
    </html>';

    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->set_paper('A4', 'landscape');
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->render();
    $dompdf->stream('Staff Advances Form', array("Attachment" => 1));
    $options = $dompdf->getOptions();
    $options->setDefaultFont('');
    $dompdf->setOptions($options);
}

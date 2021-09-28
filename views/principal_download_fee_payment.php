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

/* Get Student Details */
$student_id = $_GET['student_id'];
$ret = "SELECT * FROM  Ubc_Student INNER JOIN  Ubc_Academic_Calendar
 WHERE student_id = '$student_id'  AND academic_calendar_status = 'Current'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($student = $res->fetch_object()) {
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
                <i> Ukamba Bible College <b> ' . $student->student_name . ' ' . $student->student_admission_no . ' </b> Fees Payment Record. Generated On ' . date('d M Y') . '</i>
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
                <h4>
                    ' . $student->student_name . ' ' . $student->student_admission_no . '
                     <br> Fee Payment Records For  ' . $student->academic_calendar_year . ' -  ' . $student->academic_calendar_term . '
                </h4>
            </h3>

            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th>Receipt No.</th>
                    <th>Date Paid</th>
                    <th>Mode Of Payment</th>
                    <th>Confirmation Code</th>
                    <th>Total Amount Paid</th>
                </tr>
            </thead>
            ';
        $student_id  = $_GET['student_id'];
        $ret = "SELECT * FROM  Ubc_Fee_Payment fp  
        INNER JOIN   Ubc_Student s   ON  s.student_id = fp.fee_payment_student_id
        INNER JOIN Ubc_Academic_Calendar ac ON fp.fee_payment_academic_calendar_id = ac.academic_calendar_id
        WHERE ac.academic_calendar_status = 'Current' AND s.student_id = '$student_id'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($fee_payment = $res->fetch_object()) {
            $current_academic_term = $fee_payment->academic_calendar_id;

            /* Compute Sum Of Total Paid */
            $query = "SELECT SUM(fee_payment_amount) FROM Ubc_Fee_Payment 
            WHERE fee_payment_student_id ='$student_id' 
            AND fee_payment_academic_calendar_id = '$current_academic_term' ";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $stmt->bind_result($total_paid);
            $stmt->fetch();
            $stmt->close();

            /* Compute Billed Amount */
            $query = "SELECT SUM(billing_amount) FROM Ubc_Billings WHERE billing_student_id ='$student_id' 
            AND  billing_academic_calendar_id = '$current_academic_term' ";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $stmt->bind_result($total_billed);
            $stmt->fetch();
            $stmt->close();


            /* Compute Balance */
            $balance = $total_billed - $total_paid;

            $html .=
            '
                <tr>
                    <td>' . $fee_payment->fee_payment_receipt_number . '</td>
                    <td>' . date('d M Y', strtotime($fee_payment->fee_date_paid)). '</td>
                    <td>' . $fee_payment->fee_payment_mode . '</td>
                    <td>' . $fee_payment->fee_payment_confirmation_codes . '</td>
                    <td>Ksh ' . $fee_payment->fee_payment_amount . '</td>
                </tr>
                ';
            }
            $html .= '
            <tr>
                <td colspan="4">Total Paid:</td>
                <td> Ksh ' . $total_paid . ' </td>
            </tr>
            <tr>
                <td colspan="4">Total Billed:</td>
                <td> Ksh ' . $total_billed . ' </td>
            </tr>
            <tr>
                <td colspan="4">Fee Balance:</td>
                <td> Ksh ' . $balance . ' </td>
            </tr>
            </table>
            <br><br><br>
        </body>
    </html>';

    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->set_paper('A4');
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->render();
    $dompdf->stream($student->student_name . ' Fees Payment Record ', array("Attachment" => 1));
    $options = $dompdf->getOptions();
    $options->setDefaultFont('');
    $dompdf->setOptions($options);
}

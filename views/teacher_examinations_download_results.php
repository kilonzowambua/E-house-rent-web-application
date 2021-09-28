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

/* Get Class Details And Class Details */
$allocation = $_GET['allocation'];
$ret = "SELECT * FROM  Ubc_Teaching_Allocations ta
INNER JOIN Ubc_Units u ON ta.teaching_allocation_unit_id = u.unit_id
WHERE ta.teaching_allocation_id = '$allocation'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($calendar = $res->fetch_object()) {
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
                <i> Ukamba Bible College ' . $calendar->teaching_allocation_class_name . ' '.$calendar->unit_code.' '.$calendar->unit_name.', Student Perfomances. Generated On ' . date('d M Y') . '</i>
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
                <h4>' . $calendar->teaching_allocation_class_name . ' '.$calendar->unit_code.'-'.$calendar->unit_name.', Student Perfomance</h4>
            </h3>

            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Details</th>
                    <th>Midterm Marks</th>
                    <th>Assignments</th>
                    <th>End Term </th>
                    <th>Total Marks</th>
                    <th>Grade</th>
                    <th>Grade Point</th>
                </tr>
            </thead>
            ';
            $ret = "SELECT * FROM Ubc_Student_Marks sm INNER JOIN Ubc_Teaching_Allocations ta
            ON sm.marks_allocation_id = ta.teaching_allocation_id
            INNER JOIN Ubc_Student s ON sm.marks_student_id  = s.student_id
            WHERE sm.marks_allocation_id = '$allocation'  ORDER BY s.student_name ASC ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            $cnt = 1;
            while ($marks = $res->fetch_object()) {
                 /* Total Marks */
                 $total_marks = (int)$marks->marks_midterm_exam + (int)$marks->marks_assignments + (int)$marks->marks_final;
                 /* Compute Average */
                 //$avg = round(($total_marks / 3), 0);
                $html .=
                    '
                <tr>
                    <td width="3%">'.$cnt.'</td>
                    <td>'.$marks->student_admission_no.' '. $marks->student_name.'</td>
                    <td>'.$marks->marks_midterm_exam.'</td>
                    <td>'.$marks->marks_assignments.'</td>
                    <td>'.$marks->marks_final.'</td>
                    <td>'.$total_marks.'</td>
                    <td>';
                    if ($total_marks <= 100 && $total_marks >= 95) {
                        $grade = 'A';
                        $gp = '12';
                    } else if ($total_marks <= 94 && $total_marks >= 90) {
                        $grade = 'A-';
                        $gp = '11.25';
                    } else if ($total_marks <= 89 && $total_marks >= 87) {
                        $grade = 'B+';
                        $gp = '10.5';
                    } else if ($total_marks <= 86 && $total_marks >= 84) {
                        $grade = 'B';
                        $gp = '9';
                    } else if ($total_marks <= 83 && $total_marks >= 80) {
                        $grade = 'B-';
                        $gp = '8.25';
                    } else if ($total_marks <= 79 && $total_marks >= 77) {
                        $grade = 'C+';
                        $gp = '7.5';
                    } else if ($total_marks <= 76 && $total_marks >= 74) {
                        $grade = 'C';
                        $gp = '6';
                    } else if ($total_marks <= 73 && $total_marks >= 70) {
                        $grade = 'C-';
                        $gp = '5.25';
                    } else if ($total_marks <= 73 && $total_marks >= 70) {
                        $grade = 'C-';
                        $gp = '5.25';
                    } else if ($total_marks <= 69 && $total_marks >= 67) {
                        $grade = 'D+';
                        $gp = '4.5';
                    } else if ($total_marks <= 66 && $total_marks >= 64) {
                        $grade = 'D';
                        $gp = '3.75';
                    } else if ($total_marks <= 63 && $total_marks >= 60) {
                        $grade = 'D-';
                        $gp = '2.25';
                    } else {
                        $grade = 'E';
                        $gp = '0';
                    }
                    $html.=$grade;'</td>
                    ';
                    $html.='
                    <td>';
                    if ($total_marks <= 100 && $total_marks >= 95) {
                        $grade = 'A';
                        $gp = '12';
                    } else if ($total_marks <= 94 && $total_marks >= 90) {
                        $grade = 'A-';
                        $gp = '11.25';
                    } else if ($total_marks <= 89 && $total_marks >= 87) {
                        $grade = 'B+';
                        $gp = '10.5';
                    } else if ($total_marks <= 86 && $total_marks >= 84) {
                        $grade = 'B';
                        $gp = '9';
                    } else if ($total_marks <= 83 && $total_marks >= 80) {
                        $grade = 'B-';
                        $gp = '8.25';
                    } else if ($total_marks <= 79 && $total_marks >= 77) {
                        $grade = 'C+';
                        $gp = '7.5';
                    } else if ($total_marks <= 76 && $total_marks >= 74) {
                        $grade = 'C';
                        $gp = '6';
                    } else if ($total_marks <= 73 && $total_marks >= 70) {
                        $grade = 'C-';
                        $gp = '5.25';
                    } else if ($total_marks <= 73 && $total_marks >= 70) {
                        $grade = 'C-';
                        $gp = '5.25';
                    } else if ($total_marks <= 69 && $total_marks >= 67) {
                        $grade = 'D+';
                        $gp = '4.5';
                    } else if ($total_marks <= 66 && $total_marks >= 64) {
                        $grade = 'D';
                        $gp = '3.75';
                    } else if ($total_marks <= 63 && $total_marks >= 60) {
                        $grade = 'D-';
                        $gp = '2.25';
                    } else {
                        $grade = 'E';
                        $gp = '0';
                    }    
                    $html.=$gp;                               
                    $html.='
                    </td>
                </tr>
                ';
                $cnt = $cnt + 1;
            }
            $html .= '
        </body>
    </html>';

    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->set_paper('A4');
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->render();
    $dompdf->stream($calendar->teaching_allocation_class_name . ' '.$calendar->unit_code.','.$calendar->unit_name. ' Student Perfomance List', array("Attachment" => 1));
    $options = $dompdf->getOptions();
    $options->setDefaultFont('');
    $dompdf->setOptions($options);
}

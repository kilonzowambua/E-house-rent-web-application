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
/* Load System Settings Here */
$ret = 'SELECT * FROM  Ubc_System_Settings ';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($system_settings = $res->fetch_object()) {
?>
    <!doctype html>
    <html class="no-js" lang="">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $system_settings->Ubc_System_Setting_system_name; ?> | Staffs</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="../public/img/logo_preloader.png">
        <!-- Normalize CSS -->
        <link rel="stylesheet" href="../public/css/normalize.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="../public/css/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="../public/css/all.min.css">
        <!-- Flaticon CSS -->
        <link rel="stylesheet" href="../public/fonts/flaticon.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="../public/css/animate.min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../public/css/style.css">
        <!-- Modernize js -->
        <script src="../public/js/modernizr-3.6.0.min.js"></script>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="../public/css/animate.min.css">
        <!-- Alert Js -->
        <link rel="stylesheet" href="../public/plugins/iziToast/iziToast.min.css">
        <!-- Select 2 Css -->
        <link rel="stylesheet" href="../public/css/select2.min.css">
        <!-- Date Picker CSS -->
        <link rel="stylesheet" href="../public/css/datepicker.min.css">
        <!-- Responsive Data Tables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
        <!-- Export Data Tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    </head>
<?php } ?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once '../partials/header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Overral performance</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Reports</a>
                        </li>
                        <li>Perfomance</li>
                    </ul>
                </div>

                <hr>


                <div class="card card-body">
                    <div class="table-responsive">
                        <table id="export-data-table">
                            <thead>
                                <tr>
                                <th>Student Details</th>
                                    <th>Subject</th>
                                    <th>Mid Term </th>
                                    <th>Assignments</th>
                                    <th>Final Exam </th>
                                    <th>Average</th>
                                    <th>Grade</th>
                                    <th>Grade Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM  Ubc_Staff WHERE staff_status != "Delete" ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($staff = $res->fetch_object()) { ?>
                                    <tr>
                                    <?php
                                $ret = "SELECT * FROM  Ubc_Student_Marks m
                                INNER JOIN Ubc_Student s ON m.marks_student_id = s.student_id 
                                INNER JOIN  Ubc_Teaching_Allocations ta ON m.marks_allocation_id = ta.teaching_allocation_id
                                INNER JOIN Ubc_Units u ON ta.teaching_allocation_unit_id = u.unit_id";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($marks = $res->fetch_object()) {
                                    /* Total Marks */
                                    $total_marks = (int)$marks->marks_midterm_exam + (int)$marks->marks_assignments + (int)$marks->marks_final;
                                    /* Compute Average */
                                    $avg = round(($total_marks / 3), 0);
                                    /* Get Grade */

                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $marks->student_admission_no; ?><br>
                                            <?php echo $marks->student_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->unit_code; ?> <br>
                                            <?php echo $marks->unit_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->marks_midterm_exam; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->marks_assignments; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->marks_final; ?>
                                        </td>

                                        <td>
                                            <?php echo $avg; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($avg <= 100 && $avg >= 95) {
                                                $grade = 'A';
                                                $gp = '12';
                                            } else if ($avg <= 94 && $avg >= 90) {
                                                $grade = 'A-';
                                                $gp = '11.25';
                                            } else if ($avg <= 89 && $avg >= 87) {
                                                $grade = 'B+';
                                                $gp = '10.5';
                                            } else if ($avg <= 86 && $avg >= 84) {
                                                $grade = 'B';
                                                $gp = '9';
                                            } else if ($avg <= 83 && $avg >= 80) {
                                                $grade = 'B-';
                                                $gp = '8.25';
                                            } else if ($avg <= 79 && $avg >= 77) {
                                                $grade = 'C+';
                                                $gp = '7.5';
                                            } else if ($avg <= 76 && $avg >= 74) {
                                                $grade = 'C';
                                                $gp = '6';
                                            } else if ($avg <= 73 && $avg >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($avg <= 73 && $avg >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($avg <= 69 && $avg >= 67) {
                                                $grade = 'D+';
                                                $gp = '4.5';
                                            } else if ($avg <= 66 && $avg >= 64) {
                                                $grade = 'D';
                                                $gp = '3.75';
                                            } else if ($avg <= 63 && $avg >= 60) {
                                                $grade = 'D-';
                                                $gp = '2.25';
                                            } else {
                                                $grade = 'E';
                                                $gp = '0';
                                            }
                                            echo
                                            $grade; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($avg <= 100 && $avg >= 95) {
                                                $grade = 'A';
                                                $gp = '12';
                                            } else if ($avg <= 94 && $avg >= 90) {
                                                $grade = 'A-';
                                                $gp = '11.25';
                                            } else if ($avg <= 89 && $avg >= 87) {
                                                $grade = 'B+';
                                                $gp = '10.5';
                                            } else if ($avg <= 86 && $avg >= 84) {
                                                $grade = 'B';
                                                $gp = '9';
                                            } else if ($avg <= 83 && $avg >= 80) {
                                                $grade = 'B-';
                                                $gp = '8.25';
                                            } else if ($avg <= 79 && $avg >= 77) {
                                                $grade = 'C+';
                                                $gp = '7.5';
                                            } else if ($avg <= 76 && $avg >= 74) {
                                                $grade = 'C';
                                                $gp = '6';
                                            } else if ($avg <= 73 && $avg >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($avg <= 73 && $avg >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($avg <= 69 && $avg >= 67) {
                                                $grade = 'D+';
                                                $gp = '4.5';
                                            } else if ($avg <= 66 && $avg >= 64) {
                                                $grade = 'D';
                                                $gp = '3.75';
                                            } else if ($avg <= 63 && $avg >= 60) {
                                                $grade = 'D-';
                                                $gp = '2.25';
                                            } else {
                                                $grade = 'E';
                                                $gp = '0';
                                            }
                                            echo
                                            $gp; ?>
                                        </td>

                                    </tr>
                                <?php }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php require_once '../partials/footer.php'; ?>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

    </html>
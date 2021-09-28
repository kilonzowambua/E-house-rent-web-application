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
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
student_checklogin();
require_once '../partials/head.php';
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once '../partials/student_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/student_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Examination</h3>
                    <ul>
                        <li>
                            <a href="std_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Examination</a>
                        </li>
                        <li>Provisional Results</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="text-right">
                    <a href="std_academics_download_results" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                        <i class="fas fa-file-download"></i>
                        Download Provisional Results
                    </a>
                </div>
                <hr>
                <!-- Dashboard Content Start Here -->
                <div class="row gutters-20">
                    <div class="col-lg-12 col-xl-12 col-4-xxxl">
                        <div class="card dashboard-card-six pd-b-20">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Total Marks</th>
                                                <th>Grade</th>
                                                <th>Grade Point</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $student_id  = $_SESSION['student_id'];
                                                $ret = "SELECT * FROM  Ubc_Student_Marks m
                                                INNER JOIN Ubc_Student s ON m.marks_student_id = s.student_id 
                                                INNER JOIN  Ubc_Teaching_Allocations ta ON m.marks_allocation_id = ta.teaching_allocation_id
                                                INNER JOIN Ubc_Units u ON ta.teaching_allocation_unit_id = u.unit_id
                                                WHERE s.student_id = '$student_id'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($marks = $res->fetch_object()) {
                                                    /* Total Marks */
                                                    $total_marks = (int)$marks->marks_midterm_exam + (int)$marks->marks_assignments + (int)$marks->marks_final;
                                                    /* Compute Average */
                                                    //$avg = round(($total_marks / 3), 0);
                                                    /* Get Grade */
                                                ?>
                                                    <td>
                                                        <?php echo $marks->unit_code; ?> <br>
                                                        <?php echo $marks->unit_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $total_marks; ?>
                                                    </td>
                                                    <td>
                                                        <?php
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
                                                        echo
                                                        $grade; ?>
                                                    </td>
                                                    <td>
                                                        <?php
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
                                                        echo
                                                        $gp; ?>
                                                    </td>
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard Content End Here -->
                <!-- Footer Area Start Here -->
                <?php require_once '../partials/footer.php'; ?>
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <?php require_once '../partials/scripts.php'; ?>

</body>



</html>
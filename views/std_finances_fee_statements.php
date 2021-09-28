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
                    <h3>Fee Statements</h3>
                    <ul>
                        <li>
                            <a href="std_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="std_dashboard">Finances</a>
                        </li>
                        <li>Fee Statements</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="text-right">
                    <a href="std_finances_download_fee_statement" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                        <i class="fas fa-file-download"></i>
                        Download Statement
                    </a>
                </div>
                <hr>
                <!-- Dashboard Content Start Here -->
                <div class="row gutters-20">
                    <div class="col-lg-12 col-xl-12 col-4-xxxl">
                        <div class="card dashboard-card-six pd-b-20">
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Ref #</th>
                                                <th>Academic Year & Term</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $student_id  = $_SESSION['student_id'];
                                            $ret = "SELECT * FROM Ubc_Billings b 
                                            INNER JOIN Ubc_Academic_Calendar ac ON ac.academic_calendar_id = b.billing_academic_calendar_id
                                            INNER JOIN Ubc_Student s ON s.student_id = b.billing_student_id
                                            WHERE s.student_id = '$student_id'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($billings = $res->fetch_object()) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $billings->billing_ref; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $billings->academic_calendar_year . ', ' . $billings->academic_calendar_term; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $billings->billing_date; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $billings->billing_desc; ?>
                                                    </td>
                                                    <td>
                                                        Ksh <?php echo $billings->billing_amount; ?>
                                                    </td>

                                                </tr>
                                            <?php }
                                            ?>
                                            <tr>
                                                <td colspan="4">Total Billed:</td>
                                                <?php
                                                $query = "SELECT SUM(billing_amount) FROM Ubc_Billings WHERE billing_student_id ='$student_id' ";
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $stmt->bind_result($total_billed);
                                                $stmt->fetch();
                                                $stmt->close();
                                                ?>
                                                <td> Ksh
                                                    <?php
                                                    echo $total_billed;
                                                    ?>
                                                </td>
                                            </tr>
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
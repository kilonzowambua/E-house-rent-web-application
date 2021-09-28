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
require_once '../partials/head.php';
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once '../partials/finance_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/finance_sidebar.php';
            ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Previous Terms Fee Payments</h3>
                    <ul>
                        <li>
                            <a href="finance_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Fee Payments</a>
                        </li>
                        <li>Previous Term Payment</li>
                    </ul>
                </div>
                <form method="post" enctype="multipart/form-data" class="new-added-form">
                    <fieldset class="border border-primary p-2">
                        <legend class="w-auto text-primary font-weight-bold"> Class & Academic Term Details </legend>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-6 form-group">
                                <select class="select2 form-control" name="class" style="width: 100%;">
                                    <option> Select Class </option>
                                    <option>Class 1</option>
                                    <option>Class 2</option>
                                    <option>Class 3</option>
                                </select>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-6 form-group">
                                <select class="select2 form-control" name="term" style="width: 100%;">
                                    <option> Select Academic Term And Year </option>
                                    <?php
                                    $ret = "SELECT * FROM  Ubc_Academic_Calendar WHERE  academic_calendar_status != 'Current'  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($cal = $res->fetch_object()) { ?>
                                        <option value="<?php echo $cal->academic_calendar_id; ?>">
                                            <?php echo $cal->academic_calendar_term . ', ' . $cal->academic_calendar_year; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 form-group mg-t-8 text-right">
                                <button name="SeachStudentResults" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">
                                    Search Payments Records
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <hr>
                <div class="card card-body">
                    <div class="text-center">
                        <?php
                        if (isset($_POST['SeachStudentResults'])) {
                            $term = $_POST['term'];
                            $class = $_POST['class'];
                        ?> <h3><?php echo $class; ?> Student Fee Payments For Previous Academic Years </h3>

                            <a href="finances_download_previous_payment?class=<?php echo $class; ?>" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Download Payment Record
                            </a>
                        <?php
                        } ?>
                        <br>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Details</th>
                                    <th>Receipt No.</th>
                                    <th>Date Paid</th>
                                    <th>Payment Mode</th>
                                    <th>Amount Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['SeachStudentResults'])) {
                                    $class = $_POST['class'];
                                    $term = $_POST['term'];
                                    $ret =
                                        "SELECT * FROM  Ubc_Fee_Payment fp  
                                    INNER JOIN   Ubc_Student s   ON  s.student_id = fp.fee_payment_student_id
                                    INNER JOIN Ubc_Academic_Calendar ac ON fp.fee_payment_academic_calendar_id = ac.academic_calendar_id
                                    WHERE ac.academic_calendar_id = '$term' AND s.student_academic_level = '$class'";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($fee_payment = $res->fetch_object()) {
                                        $current_academic_term = $fee_payment->academic_calendar_id; ?>
                                        <tr>
                                            <td>
                                                <?php echo $fee_payment->student_admission_no . ' ' . $fee_payment->student_name; ?>
                                            </td>
                                            <td><?php echo $fee_payment->fee_payment_receipt_number; ?></td>
                                            <td><?php echo date('d M Y', strtotime($fee_payment->fee_date_paid)); ?></td>
                                            <td><?php echo $fee_payment->fee_payment_mode; ?></td>
                                            <td>
                                                Ksh <?php echo $fee_payment->fee_payment_amount; ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
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
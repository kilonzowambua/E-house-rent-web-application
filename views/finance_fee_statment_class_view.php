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
            $student_id = $_GET['student_id'];
            $ret = "SELECT * FROM  Ubc_Student WHERE student_id = '$student_id' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($student = $res->fetch_object()) {
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3><?php echo $student->student_name; ?> Student Fee Statements</h3>
                        <ul>
                            <li>
                                <a href="finance_dashboard">Home</a>
                            </li>
                            <li>
                                <a href="finance_fee_statements">Reports</a>
                            </li>
                            <li>Statements</li>
                        </ul>
                    </div>
                    <hr>
                    <fieldset class="border border-primary p-2">
                        <legend class="w-auto text-primary font-weight-bold"> </legend>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Receipt No.</th>
                                            <th>Date Paid</th>
                                            <th>Academic Year & Term</th>
                                            <th>Payment Mode</th>
                                            <th>Confirmation Code</th>
                                            <th>Amount Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM  Ubc_Fee_Payment fp  
                                        INNER JOIN   Ubc_Student s   ON  s.student_id = fp.fee_payment_student_id
                                        INNER JOIN Ubc_Academic_Calendar ac ON fp.fee_payment_academic_calendar_id = ac.academic_calendar_id
                                        WHERE  s.student_id = '$student_id'";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($fee_payment = $res->fetch_object()) {

                                        ?>
                                            <tr>
                                                <td><?php echo $fee_payment->fee_payment_receipt_number; ?></td>
                                                <td><?php echo date('d M Y', strtotime($fee_payment->fee_date_paid)); ?></td>
                                                <td><?php echo $fee_payment->academic_calendar_year . ' ' . $fee_payment->academic_calendar_term; ?></td>
                                                <td><?php echo $fee_payment->fee_payment_mode; ?></td>
                                                <td><?php echo $fee_payment->fee_payment_confirmation_codes; ?></td>
                                                <td>
                                                    Ksh <?php echo $fee_payment->fee_payment_amount; ?>
                                                </td>
                                            </tr>
                                        <?php
                                        } ?>
                                        <tr>
                                            <td colspan="5">Total Paid:</td>
                                            <?php
                                            $query = "SELECT SUM(fee_payment_amount) FROM Ubc_Fee_Payment WHERE fee_payment_student_id ='$student_id'";
                                            $stmt = $mysqli->prepare($query);
                                            $stmt->execute();
                                            $stmt->bind_result($total_paid);
                                            $stmt->fetch();
                                            $stmt->close();
                                            ?>
                                            <td> Ksh
                                                <?php
                                                echo $total_paid;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Total Billed:</td>
                                            <?php
                                            $query = "SELECT SUM(billing_amount) FROM Ubc_Billings WHERE billing_student_id ='$student_id'";
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
                                        <tr>
                                            <td colspan="5">Fee Balance:</td>
                                            <td>
                                                Ksh
                                                <?php echo ($total_billed - $total_paid); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <?php require_once '../partials/footer.php'; ?>
                </div>
            <?php } ?>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

</html>
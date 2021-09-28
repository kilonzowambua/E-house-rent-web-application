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
            <?php require_once '../partials/finance_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Student Billing</h3>
                    <ul>
                        <li>
                            <a href="finance_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Individual Student Finances</a>
                        </li>
                        <li>Individual Student Billing Logs</li>
                    </ul>
                </div>
                <form method="post" enctype="multipart/form-data" class="new-added-form">
                    <fieldset class="border border-primary p-2">
                        <legend class="w-auto text-primary font-weight-bold"> Student Details </legend>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                <select class="select2 form-control" name="student_id" style="width: 100%;">
                                    <option>
                                        Select Student Name & Admission Number
                                    </option>
                                    <?php
                                    $ret = "SELECT * FROM `Ubc_Student` ORDER BY `student_name` ASC  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($student = $res->fetch_object()) {
                                    ?>
                                        <option value="<?php echo $student->student_id; ?>">
                                            <?php echo $student->student_admission_no . ' ' . $student->student_name; ?>
                                        </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="col-12 form-group mg-t-8 text-right">
                                <button name="SeachStudentResults" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">
                                    Search Billings Records
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <hr>
                <div class="card card-body">
                    <div class="text-center">
                        <h3>Student Billing fees </h3>
                        <!-- Download This Student All Fee Payment Records -->
                        <?php
                        if (isset($_POST['SeachStudentResults'])) {
                            $student_id = $_POST['student_id']; ?>
                            <a href="finance_download_individual_billings?student_id=<?php echo $student_id; ?>" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Download Billing Record
                            </a>
                        <?php
                        } ?>
                        <br>
                        <br>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th>Ref No.</th>
                                    <th>Billing Date</th>
                                    <th>Academic Year & Term</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['SeachStudentResults'])) {
                                    $student_id = $_POST['student_id'];
                                    $ret = "SELECT * FROM  Ubc_Billings b 
                                    INNER JOIN   Ubc_Student s   ON  s.student_id = b.billing_student_id 
                                    INNER JOIN Ubc_Academic_Calendar ac ON b.billing_academic_calendar_id  = ac.academic_calendar_id
                                    WHERE s.student_id = '$student_id';
                                    ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($billing = $res->fetch_object()) {

                                        //$current_academic_term = $fee_payment->academic_calendar_id;
                                ?>
                                <h4>Student admission:</h4><b><?php echo $billing->student_admission_no?></b><br>
                                <h4>Student name:</h4><b><?php echo $billing->student_name?></b>'s Billings 
                                        <tr>
                                            
                                            <td><?php echo $billing->billing_ref ; ?></td>
                                            <td><?php echo $billing->billing_date; ?></td>
                                            <td><?php echo $billing->academic_calendar_year . ' ' . $billing->academic_calendar_term; ?></td>
                                            <td>
                                                Ksh <?php echo $billing->billing_amount; ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                   
                                    <tr>
                                        <td colspan="3">Total Billing:</td>
                                        <?php
                                        $query = "SELECT SUM(billing_amount) FROM Ubc_Billings
                                         WHERE billing_student_id ='$student_id'";
                                        $stmt = $mysqli->prepare($query);
                                        $stmt->execute();
                                        $stmt->bind_result($total_bill);
                                        $stmt->fetch();
                                        $stmt->close();
                                        ?>
                                        <td> Ksh
                                            <?php
                                            echo $total_bill;
                                            ?>
                                        </td>
                                    </tr>
                                    
                                   
                                <?php  } ?>
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
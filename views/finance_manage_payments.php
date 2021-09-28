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

/* Add Student Fee Payment */
if (isset($_POST['Add_Fee_Payment'])) {
    $fee_payment_id = $ID;
    //$fee_payment_academic_calendar_id = $_POST['fee_payment_academic_calendar_id'];
    $fee_payment_student_id = $_POST['fee_payment_student_id'];
    $fee_payment_amount =  str_replace(',', '', ($_POST['fee_payment_amount']));
    $fee_payment_mode = $_POST['fee_payment_mode'];
    $fee_date_paid = $_POST['fee_date_paid'];
    $fee_payment_receipt_number = $_POST['fee_payment_receipt_number'];
    $fee_payment_confirmation_codes = $_POST['fee_payment_confirmation_codes'];
    $fee_payment_academic_calendar_id = $_POST['fee_payment_academic_calendar_id'];

    /* Prevent Double Entries */
    /* $sql = "SELECT * FROM  Ubc_Fee_Payment  
    WHERE (fee_payment_student_id ='$fee_payment_student_id' AND fee_payment_receipt_number = '$fee_payment_receipt_number')
    OR (fee_payment_student_id ='$fee_payment_student_id' AND fee_payment_confirmation_codes = '$fee_payment_confirmation_codes') ";

    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($fee_payment_student_id == $row['fee_payment_student_id'] && $fee_payment_receipt_number == $row['fee_payment_receipt_number']) {
            $err = "Fee Payment With This : $fee_payment_receipt_number Already Exists";
        } elseif ($fee_payment_student_id == $row['fee_payment_student_id'] && (!empty($fee_payment_confirmation_codes == $row['fee_payment_confirmation_codes']))) {
            $err = "Fee Payment With This : $fee_payment_confirmation_codes Already Exists";
        }
    } else { */
    $query = 'INSERT INTO Ubc_Fee_Payment (fee_payment_id, fee_payment_academic_calendar_id, fee_payment_student_id, fee_payment_amount, fee_payment_mode, fee_date_paid, fee_payment_receipt_number, fee_payment_confirmation_codes)
         VALUES (?,?,?,?,?,?,?,?)';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssssssss',
        $fee_payment_id,
        $fee_payment_academic_calendar_id,
        $fee_payment_student_id,
        $fee_payment_amount,
        $fee_payment_mode,
        $fee_date_paid,
        $fee_payment_receipt_number,
        $fee_payment_confirmation_codes
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Receipt No : $fee_payment_receipt_number Posted";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/*Update fees payment */
if (isset($_POST['Update_Fee_Payment'])) {
    $fee_payment_id = $_POST['fee_payment_id'];
    $fee_payment_amount =  str_replace(',', '', ($_POST['fee_payment_amount']));
    $fee_payment_mode = $_POST['fee_payment_mode'];
    $fee_date_paid = $_POST['fee_date_paid'];
    $fee_payment_receipt_number = $_POST['fee_payment_receipt_number'];
    $fee_payment_confirmation_codes = $_POST['fee_payment_confirmation_codes'];
    $query = 'UPDATE Ubc_Fee_Payment SET fee_payment_amount =?,fee_payment_mode =? ,fee_date_paid =? ,fee_payment_receipt_number =?,fee_payment_confirmation_codes =? WHERE fee_payment_id  =?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssssss',
        $fee_payment_amount,
        $fee_payment_mode,
        $fee_date_paid,
        $fee_payment_receipt_number,
        $fee_payment_confirmation_codes,
        $fee_payment_id
    );
    $stmt->execute();

    if ($stmt) {
        $success = "Fee Payment Updated";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/*Remove fees payment */
if (isset($_GET['delete'])) {
    $error = 0;
    $fee_payment_id = $_GET['delete'];
    if (!$error) {
        $sql = "DELETE FROM  Ubc_Fee_Payment  WHERE fee_payment_id ='$fee_payment_id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Deleted" && header("refresh:1; url=finance_manage_payments");
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }
}

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
                    <h3>Finances</h3>
                    <ul>
                        <li>
                            <a href="finance_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Finances</a>
                        </li>
                        <li>Fee Payments</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-money-bill-alt"></i>
                        Add Payment
                    </button>
                </div>
                <hr>
                <!-- Add Modal -->
                <div class="modal left-slide-modal fade" id="add_modal" role="dialog">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Fill All Fields</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" class="new-added-form">
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Student & Fee Payment Mode Term Details</legend>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Student Admission Number & Name</label>
                                                <select class="select2 form-control" name="fee_payment_student_id" style="width: 100%;">
                                                    <option>
                                                        Select Student
                                                    </option>
                                                    <?php
                                                    $ret = 'SELECT * FROM  Ubc_Student ';
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($student = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $student->student_id; ?>">
                                                            <?php echo $student->student_admission_no . '  ' . $student->student_name; ?>
                                                        </option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Fee Payment Mode</label>
                                                <select class="select2 form-control" name="fee_payment_mode" style="width: 100%;">
                                                    <option>MPESA</option>
                                                    <option>Paybill</option>
                                                    <option>Cash</option>
                                                    <option>Bank Deposits</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Fee Payment Details</legend>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Amount Paid (Ksh)</label>
                                                <input type="text" required name="fee_payment_amount" required class="form-control">
                                            </div>
                                            <?php
                                            $ret = "SELECT * FROM  Ubc_Academic_Calendar WHERE academic_calendar_status = 'Current'";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($ac = $res->fetch_object()) { ?>
                                                <input type="hidden" required name="fee_payment_academic_calendar_id" value="<?php echo $ac->academic_calendar_id; ?>" required class="form-control">
                                            <?php } ?>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Date Paid</label>
                                                <input type="date" required name="fee_date_paid" required class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Receipt Number </label>
                                                <input type="text" required name="fee_payment_receipt_number" required class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Confirmation Code (If Mode Is MPESA & Paybill) </label>
                                                <input type="text" name="fee_payment_confirmation_codes" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-12 form-group mg-t-8 text-right">
                                        <button name="Add_Fee_Payment" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Post Payment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End  Modal -->

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Details</th>
                                    <th>Payment Mode </th>
                                    <th>Receipt Number</th>
                                    <th>Amount Paid</th>
                                    <th>Confirmation ID</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM Ubc_Fee_Payment fp 
                                INNER JOIN Ubc_Student s ON s.student_id =  fp.fee_payment_student_id
                                 ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($paid_fees = $res->fetch_object()) {

                                ?>
                                    <tr>
                                        <td>
                                            Adm No: <?php echo $paid_fees->student_admission_no; ?><br>
                                            Name: <?php echo $paid_fees->student_name; ?>
                                        </td>
                                        <td><?php echo $paid_fees->fee_payment_mode; ?></td>
                                        <td><?php echo $paid_fees->fee_payment_receipt_number; ?></td>
                                        <td>Ksh <?php echo $paid_fees->fee_payment_amount; ?></td>
                                        <td><?php echo $paid_fees->fee_payment_confirmation_codes; ?></td>
                                        <td>
                                            <a href="#edit-<?php echo $paid_fees->fee_payment_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                <i class="fas fa-edit"></i>
                                                Update
                                            </a>
                                            <div class="modal left-slide-modal fade" id="edit-<?php echo $paid_fees->fee_payment_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Fee Payment Record For :
                                                                <?php echo $paid_fees->student_admission_no . ' ' . $paid_fees->student_name; ?>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                <fieldset class="border border-primary p-2">
                                                                    <legend class="w-auto text-primary font-weight-bold">Student & Fee Payment Mode Term Details</legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Student Admission Number & Name</label>
                                                                            <select readonly class="select2 form-control" name="fee_payment_student_id" style="width: 100%;">
                                                                                <option>
                                                                                    <?php echo $paid_fees->student_admission_no . ' ' . $paid_fees->student_name; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Fee Payment Mode</label>
                                                                            <select class="select2 form-control" name="fee_payment_mode" style="width: 100%;">
                                                                                <option><?php echo $paid_fees->fee_payment_mode; ?>
                                                                                <option>MPESA</option>
                                                                                <option>Paybill</option>
                                                                                <option>Cash</option>
                                                                                <option>Bank Deposit</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <fieldset class="border border-primary p-2">
                                                                    <legend class="w-auto text-primary font-weight-bold">Fee Payment Details</legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Amount Paid (Ksh)</label>
                                                                            <input type="text" required value="<?php echo $paid_fees->fee_payment_amount; ?>" name="fee_payment_amount" required class="form-control">
                                                                            <input type="text" required value="<?php echo $paid_fees->fee_payment_id; ?>" name="fee_payment_id" hidden class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Date Paid</label>
                                                                            <input type="date" required value="<?php echo $paid_fees->fee_date_paid; ?>" name="fee_date_paid" required class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Receipt Number </label>
                                                                            <input type="text" readonly value="<?php echo $paid_fees->fee_payment_receipt_number; ?>" required name="fee_payment_receipt_number" required class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Confirmation Code (If Mode Is MPESA & Paybill) </label>
                                                                            <input type="text" value="<?php echo $paid_fees->fee_payment_confirmation_codes; ?>" name="fee_payment_confirmation_codes" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <div class="col-12 form-group mg-t-8 text-right">
                                                                    <button name="Update_Fee_Payment" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Posted Payment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                            <a href="#delete-<?php echo $paid_fees->fee_payment_id; ?>" data-toggle="modal" class="radius-30 badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete Staff Confirmation -->
                                            <div class="modal fade" id="delete-<?php echo $paid_fees->fee_payment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete
                                                                <br>
                                                                <b><?php
                                                                    echo
                                                                    $paid_fees->student_name . ' Receipt No:' . $paid_fees->fee_payment_receipt_number;
                                                                    ?>
                                                                </b>
                                                                <br>
                                                                Fee Payment Record ?
                                                            </h4>
                                                            <p>Heads Up, You are about to delete this payment record. This action is irrevisble.</p>
                                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                                            <a href="finance_manage_payments?delete=<?php echo $paid_fees->fee_payment_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                        </td>
                                    </tr>
                                <?php }
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
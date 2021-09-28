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
/* Bill Student */
if (isset($_POST['Bill_Student'])) {

    $billing_academic_calendar_id = $_POST['billing_academic_calendar_id'];
    $billing_date = date('d, M Y');
    $billing_ref = $ref;
    $billing_desc = $_POST['billing_desc'];
    $billing_amount = str_replace(',', '', ($_POST['billing_amount']));

    /* To Do Prevent Double Entry */
    $copy_sql = "INSERT INTO Ubc_Billings (billing_student_id) SELECT student_id FROM Ubc_Student";

    //$update_sql = "INSERT INTO Ubc_Billings (billing_academic_calendar_id, billing_date, billing_ref, billing_desc, billing_amount) VALUES(?,?,?,?,?)";
    $update_sql = "UPDATE Ubc_Billings SET billing_academic_calendar_id =?, billing_date =?, billing_ref =?, billing_desc =?, billing_amount =? 
    WHERE  billing_academic_calendar_id = '1' ";
    $copy_stmt = $mysqli->prepare($copy_sql);
    $update_stmt = $mysqli->prepare($update_sql);

    $rc = $update_stmt->bind_param(
        'sssss',
        $billing_academic_calendar_id,
        $billing_date,
        $billing_ref,
        $billing_desc,
        $billing_amount
    );

    $copy_stmt->execute();
    $update_stmt->execute();

    if ($copy_stmt && $update_stmt) {
        $success = "Student Billed";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Update billed fee */
if (isset($_POST['Update_bill'])) {
    $billing_amount = $_POST['billing_amount'];
    $billing_academic_calendar_id = $_POST['billing_academic_calendar_id'];
    $query = 'UPDATE Ubc_Billings SET billing_amount =? WHERE billing_academic_calendar_id  =?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ss', $billing_amount, $billing_academic_calendar_id);
    $stmt->execute();

    if ($stmt) {
        $success = "Billed Amount Updated";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
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
                    <h3>Student Fee Billings</h3>
                    <ul>
                        <li>
                            <a href="finance_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Billing</a>
                        </li>
                        <li>Billings</li>
                    </ul>
                </div>
                <!-- Bill Students -->
                <div class="text-right">
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-calendar-check"></i>
                        Add Term Fee Billing
                    </button>
                </div>
                <hr>
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
                                <fieldset class="border border-primary p-2">
                                    <legend class="w-auto text-primary font-weight-bold">Student Billing Details</legend>
                                    <form method="post" enctype="multipart/form-data" class="new-added-form">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Academic Year & Term</label>
                                                <select class="form-control select2" name="billing_academic_calendar_id">
                                                    <?php
                                                    $ret = "SELECT * FROM  Ubc_Academic_Calendar WHERE academic_calendar_status = 'Current'";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($calendar = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $calendar->academic_calendar_id; ?>"><?php echo $calendar->academic_calendar_year . ' , ' . $calendar->academic_calendar_term; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Amount</label>
                                                <input type="text" name="billing_amount" required class="form-control">
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Description</label>
                                                <textarea type="text" rows="5" name="billing_desc" required class="form-control"></textarea>

                                            </div>
                                            <div class="col-12 form-group mg-t-8 text-right">
                                                <button name="Bill_Student" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Term Billing</button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Academic Calendar</th>
                                    <th>Billed Amount</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT DISTINCT billing_academic_calendar_id, billing_amount, academic_calendar_year, academic_calendar_term FROM  Ubc_Billings b 
                                INNER JOIN  Ubc_Academic_Calendar ac ON b.billing_academic_calendar_id = ac.academic_calendar_id';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($billings = $res->fetch_object()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $billings->academic_calendar_year; ?><br>
                                            <?php echo $billings->academic_calendar_term; ?><br>
                                        </td>
                                        <td>
                                            Ksh <?php echo $billings->billing_amount; ?><br>
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
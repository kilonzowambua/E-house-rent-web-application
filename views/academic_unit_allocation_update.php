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

/* Add Unit Allocaltion */
if (isset($_POST['Update_Allocation'])) {
    $teaching_allocation_id = $_GET['update'];
    $teaching_allocation_academic_calendar_id = $_POST['teaching_allocation_academic_calendar_id'];
    $teaching_allocation_staff_id = $_POST['teaching_allocation_staff_id'];
    $teaching_allocation_unit_id = $_POST['teaching_allocation_unit_id'];
    $teaching_allocation_class_name = $_POST['teaching_allocation_class_name'];

    $query = 'UPDATE Ubc_Teaching_Allocations  SET teaching_allocation_academic_calendar_id = ?, teaching_allocation_staff_id =?, teaching_allocation_unit_id =?, teaching_allocation_class_name =? 
  WHERE teaching_allocation_id = ?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssss',
        $teaching_allocation_academic_calendar_id,
        $teaching_allocation_staff_id,
        $teaching_allocation_unit_id,
        $teaching_allocation_class_name,
        $teaching_allocation_id
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=academic_unit_allocations");
    } else {
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
        <?php require_once '../partials/academic_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/academic_sidebar.php';
            $update = $_GET['update'];
            $ret =
                "SELECT * FROM  Ubc_Teaching_Allocations ta
             INNER JOIN Ubc_Academic_Calendar ac ON ta.teaching_allocation_academic_calendar_id = ac.academic_calendar_id
             INNER JOIN Ubc_Staff s ON  s.staff_id = ta.teaching_allocation_staff_id
             INNER JOIN Ubc_Units u ON u.unit_id = ta.teaching_allocation_unit_id
             WHERE ta.teaching_allocation_id = '$update'
            ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($allocated = $res->fetch_object()) {
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3>Units & Subjects Allocation</h3>
                        <ul>
                            <li>
                                <a href="academic_dashboard">Home</a>
                            </li>
                            <li>
                                <a href="">Academics</a>
                            </li>
                            <li>
                                <a href="academic_unit_allocations">Allocations</a>
                            </li>
                            <li>Update Allocations</li>
                        </ul>
                    </div>
                    <hr>
                    <div class="card card-body">
                        <form method="post" enctype="multipart/form-data" class="new-added-form">
                            <fieldset class="border border-primary p-2">
                                <legend class="w-auto text-primary font-weight-bold">Teacher & Academic Year Details</legend>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Staff Details</label>
                                        <select class="select2 form-control" name="teaching_allocation_staff_id" style="width: 100%;">
                                            <option value="<?php echo $allocated->teaching_allocation_staff_id; ?>"><?php echo $allocated->staff_number . "" . $allocated->staff_name; ?></option>
                                            <?php
                                            $ret = 'SELECT * FROM  Ubc_Staff ';
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($staff = $res->fetch_object()) {
                                            ?>
                                                <option value="<?php echo $staff->staff_id; ?>"><?php echo $staff->staff_number . " " . $staff->staff_name; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Current Academic Year</label>
                                        <select class="select2 form-control" readonly name="teaching_allocation_academic_calendar_id" style="width: 100%;">
                                            <?php
                                            $ret = 'SELECT * FROM  Ubc_Academic_Calendar WHERE academic_calendar_status = "Current"';
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($academic_year_details = $res->fetch_object()) {
                                            ?>
                                                <option value="<?php echo $academic_year_details->academic_calendar_id; ?>"><?php echo $academic_year_details->academic_calendar_year . " - " . $academic_year_details->academic_calendar_term; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="border border-primary p-2">
                                <legend class="w-auto text-primary font-weight-bold">Subject & Class Details</legend>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Subject / Unit Details</label>
                                        <select class="select2 form-control" name="teaching_allocation_unit_id" style="width: 100%;">
                                            <option value="<?php echo $allocated->teaching_allocation_unit_id; ?>"><?php echo $allocated->unit_code . " " . $allocated->unit_name; ?></option>
                                            <?php
                                            $ret = 'SELECT * FROM  Ubc_Units ';
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($units = $res->fetch_object()) {
                                            ?>
                                                <option value="<?php echo $units->unit_id; ?>"><?php echo $units->unit_code . " " . $units->unit_name; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Allocated Class</label>
                                        <select class="select2 form-control" name="teaching_allocation_class_name" style="width: 100%;">
                                            <option><?php echo $allocated->teaching_allocation_class_name; ?></option>
                                            <option>Class 1</option>
                                            <option>Class 2</option>
                                            <option>Class 3</option>
                                        </select>
                                    </div>
                            </fieldset>
                            <div class="col-12 form-group mg-t-8 text-right">
                                <button name="Update_Allocation" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Allocation</button>
                            </div>
                        </form>
                    </div>
                    <?php require_once '../partials/footer.php'; ?>
                </div>
            <?php
            } ?>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

</html>
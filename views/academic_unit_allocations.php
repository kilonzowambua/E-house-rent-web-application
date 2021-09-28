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
if (isset($_POST['Add_Allocation'])) {
    $teaching_allocation_id = $ID;
    $teaching_allocation_academic_calendar_id = $_POST['teaching_allocation_academic_calendar_id'];
    $teaching_allocation_staff_id = $_POST['teaching_allocation_staff_id'];
    $teaching_allocation_unit_id = $_POST['teaching_allocation_unit_id'];
    $teaching_allocation_class_name = $_POST['teaching_allocation_class_name'];

    /* Prevent Double Entries */
    $sql
        = "SELECT * FROM  Ubc_Teaching_Allocations   
    WHERE teaching_allocation_academic_calendar_id ='$teaching_allocation_academic_calendar_id' 
    AND  teaching_allocation_staff_id = '$teaching_allocation_staff_id' 
    AND teaching_allocation_unit_id = '$teaching_allocation_unit_id'
    AND teaching_allocation_class_name = '$teaching_allocation_class_name'";

    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (
            $teaching_allocation_academic_calendar_id == $row['teaching_allocation_academic_calendar_id'] &&
            $teaching_allocation_staff_id == $row['teaching_allocation_staff_id'] &&
            $teaching_allocation_unit_id == $row['teaching_allocation_unit_id'] &&
            $teaching_allocation_class_name == $row['teaching_allocation_class_name']
        ) {
            $err =
                'A Teacher Has Already Been Allocated';
        }
    } else {


        $query = 'INSERT INTO Ubc_Teaching_Allocations (teaching_allocation_id, teaching_allocation_academic_calendar_id, teaching_allocation_staff_id, teaching_allocation_unit_id, teaching_allocation_class_name) 
        VALUES (?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssss',
            $teaching_allocation_id,
            $teaching_allocation_academic_calendar_id,
            $teaching_allocation_staff_id,
            $teaching_allocation_unit_id,
            $teaching_allocation_class_name
        );
        $stmt->execute();
        if ($stmt) {
            $success = "Teacher Allocated Unit";
        } else {
            $err = 'Please Try Again Or Try Later';
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
        <?php require_once '../partials/academic_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/academic_sidebar.php'; ?>
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
                        <li>Units & Subjects Allocations</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-user-check"></i>
                        Add Allocation
                    </button>
                </div>
                <hr>

                <!-- Add  Modal -->
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
                                        <legend class="w-auto text-primary font-weight-bold">Teacher & Academic Year Details</legend>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Staff Details</label>
                                                <select class="select2 form-control" name="teaching_allocation_staff_id" style="width: 100%;">
                                                    <option>Select Staff Details</option>
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
                                                <select class="select2 form-control" name="teaching_allocation_academic_calendar_id" style="width: 100%;">
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
                                    </fieldset>
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Subject & Class Details</legend>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Subject / Unit Details</label>
                                                <select class="select2 form-control" name="teaching_allocation_unit_id" style="width: 100%;">
                                                    <option>Select Subject / Unit Code</option>
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
                                                    <option>Class 1</option>
                                                    <option>Class 2</option>
                                                    <option>Class 3</option>
                                                </select>
                                            </div>
                                    </fieldset>
                                    <div class="col-12 form-group mg-t-8 text-right">
                                        <button name="Add_Allocation" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Allocation</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add Staf Modal -->

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject / Unit</th>
                                    <th>Allocated Teacher</th>
                                    <th>Academic Year & Term</th>
                                    <th>Allocated Class</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret =
                                    'SELECT * FROM  Ubc_Teaching_Allocations ta
                                     INNER JOIN Ubc_Academic_Calendar ac ON ta.teaching_allocation_academic_calendar_id = ac.academic_calendar_id
                                     INNER JOIN Ubc_Staff s ON  s.staff_id = ta.teaching_allocation_staff_id
                                     INNER JOIN Ubc_Units u ON u.unit_id = ta.teaching_allocation_unit_id
                                     WHERE ac.academic_calendar_status = "Current"
                                    ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($allocated = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td>
                                            Code: <?php echo $allocated->unit_code; ?><br>
                                            Name: <?php echo $allocated->unit_name; ?>
                                        </td>
                                        <td>
                                            Number : <?php echo $allocated->staff_number; ?><br>
                                            Name: <?php echo $allocated->staff_name; ?>
                                        </td>
                                        <td>
                                            Academic Year : <?php echo $allocated->academic_calendar_year; ?><br>
                                            Term : <?php echo $allocated->academic_calendar_term; ?>
                                        </td>
                                        <td>
                                            <?php echo $allocated->teaching_allocation_class_name; ?>
                                        </td>
                                        <td>
                                            <a href="academic_unit_allocation_update?update=<?php echo $allocated->teaching_allocation_id; ?>" class="radius-30 badge badge-primary">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                <?php
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
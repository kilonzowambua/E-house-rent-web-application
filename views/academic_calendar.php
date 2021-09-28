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
/* Add Academic Calendar */
if (isset($_POST['Add_Calendar'])) {
    $academic_calendar_id = $ID;
    $academic_calendar_year = $_POST['academic_calendar_year'];
    $academic_calendar_term = $_POST['academic_calendar_term'];
    $academic_calendar_status = 'Current';
    // check Students academic Term 3

    $query_update =
        "UPDATE Ubc_Academic_Calendar  SET academic_calendar_status ='Past'";
    $query_add =
        'INSERT INTO Ubc_Academic_Calendar (academic_calendar_id,academic_calendar_year,academic_calendar_term,academic_calendar_status) VALUES (?,?,?,?)';

    $stmt_update = $mysqli->prepare($query_update);
    $stmt_add = $mysqli->prepare($query_add);
    $rc = $stmt_add->bind_param(
        'ssss',
        $academic_calendar_id,
        $academic_calendar_year,
        $academic_calendar_term,
        $academic_calendar_status
    );

    $stmt_update->execute();
    $stmt_add->execute();

    if ($stmt_update && $stmt_add) {
        $success =
            'Academic year change to ' .
            $academic_calendar_year .
            '-' .
            $academic_calendar_term;
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }


    /* Update Academic Calendae */
    if (isset($_POST['update_Calendar'])) {
        $academic_calendar_year = $_POST['academic_calendar_year'];
        $academic_calendar_term = $_POST['academic_calendar_term'];
        $academic_calendar_id = $_POST['academic_calendar_id'];
        $query = 'UPDATE Ubc_Academic_Calendar SET academic_calendar_year =?,academic_calendar_term =? WHERE academic_calendar_id =?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss', $academic_calendar_year, $academic_calendar_term, $academic_calendar_id);
        $stmt->execute();

        if ($stmt) {
            $success = $academic_calendar_year . '-' . $academic_calendar_term . " is updated";
        } else {
            //inject alert that task failed
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
                    <h3>Academic Calendars</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="dashboard">Academics</a>
                        </li>
                        <li>Academic Calendars</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-calendar-check"></i>
                        Add Academic Calendars
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
                                <fieldset class="border border-primary p-2">
                                    <legend class="w-auto text-primary font-weight-bold">Academic Calendar Details</legend>
                                    <form method="post" enctype="multipart/form-data" class="new-added-form">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Academic Year</label>
                                                <input type="text" name="academic_calendar_year" required class="form-control">
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Terms</label>
                                                <select class="form-control select2" name="academic_calendar_term">
                                                    <option value="Term 1">Term 1</option>
                                                    <option Value="Term 2">Term 2</option>
                                                    <option value="Term 3">Term 3</option>
                                                </select>
                                            </div>
                                            <div class="col-12 form-group mg-t-8 text-right">
                                                <button name="Add_Calendar" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Academic Calendar</button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add Staf Modal -->

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Academic Year</th>
                                    <th>Term</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM  Ubc_Academic_Calendar ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($calendar = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $calendar->academic_calendar_year; ?></td>
                                        <td><?php echo $calendar->academic_calendar_term; ?></td>
                                        <td>
                                            <?php if ($calendar->academic_calendar_status == 'Current') { ?>
                                                <a href="#edit-<?php echo $calendar->academic_calendar_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                            <?php } ?>
                                            <!-- Edit Staff Modal -->
                                            <div class="modal left-slide-modal fade" id="edit-<?php echo $calendar->academic_calendar_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update <?php echo $calendar->academic_calendar_term .
                                                                                                '- ' .
                                                                                                $calendar->academic_calendar_term; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset class="border border-primary p-2">
                                                                <legend class="w-auto text-primary font-weight-bold">Academic Calendar Details</legend>
                                                                <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                    <div class="row">
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Academic Year</label>
                                                                            <input type="text" name="academic_calendar_id" value="<?php echo $calendar->academic_calendar_id; ?>" required class="form-control">
                                                                            <input type="text" name="academic_calendar_year" value="<?php echo $calendar->academic_calendar_year; ?>" required class="form-control">
                                                                        </div>

                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Terms</label>
                                                                            <select class="form-control select2" name="academic_calendar_term">
                                                                                <option selected value="<?php echo $calendar->academic_calendar_term; ?>"><?php echo $calendar->academic_calendar_term; ?></option>
                                                                                <option Value="Term 1">Term 1</option>
                                                                                <option Value="Term 2">Term 2</option>
                                                                                <option value="Term 3">Term 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 form-group mg-t-8 text-right">
                                                                            <button name="update_Calendar" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Academic Calendar</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </fieldset>
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
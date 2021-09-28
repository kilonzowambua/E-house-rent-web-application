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
/* Add Break To Time Table */
if (isset($_POST['Add_Break'])) {
    $timetable_id = $ID;
    $timetable_class_time = $_POST['timetable_class_time'];
    $timetable_day = $_POST['timetable_day'];
    $timetable_break = $_POST['timetable_break'];

    /* Prevent Double Entries */
    $sql
        = "SELECT * FROM  Ubc_Timetable   
    WHERE timetable_class_time ='$timetable_class_time' 
    AND  timetable_day = '$timetable_day'";

    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (
            $timetable_class_time == $row['timetable_class_time'] &&
            $timetable_day == $row['timetable_day']
            
        ) {
            $err =
                'Break Already In Time Table';
        }
    } else {


        $query = 'INSERT INTO Ubc_Timetable (timetable_id, timetable_class_time, timetable_day,timetable_break) 
        VALUES (?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'ssss',
            $timetable_id,
            $timetable_class_time,
            $timetable_day,
            $timetable_break
        );
        $stmt->execute();
        if ($stmt) {
            $success = "Break Added To TimeTable";
        } else {
            $err = 'Please Try Again Or Try Later';
        }
    }
} 
/*Delete Break*/
if (isset($_GET['delete'])) {
    $error = 0;
    $timetable_id = $_GET['delete'];
    if (!$error) {
        $sql = "DELETE FROM Ubc_Timetable  WHERE timetable_id ='$timetable_id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Break is Removed ";
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
                    <h3>Teaching Time Table - Breaks</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="dashboard">Time Table</a>
                        </li>
                        <li>Add Breaks</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-book-open"></i>
                        Add Break
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
                                        <legend class="w-auto text-primary font-weight-bold">Time & Day </legend>
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Time</label>
                                                <select class="select2 form-control" name="timetable_class_time" style="width: 100%;">
                                                    <option value="3">10:00 - 10:30 AM</option>
                                                    <option value="4">10:30 - 10:55 AM</option>
                                                    <option value="7">1:00 - 1:55 PM</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Day</label>
                                                <select class="select2 form-control" name="timetable_day" style="width: 100%;">
                                                    <option>Monday</option>
                                                    <option>Tuesday</option>
                                                    <option>Wednesday</option>
                                                    <option>Thursday</option>
                                                    <option>Friday</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Break</label>
                                                <select class="select2 form-control" name="timetable_break" style="width: 100%;">
                                                    <option>Chapel</option>
                                                    <option>Tea Break</option>
                                                    <option>Lunch</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-12 form-group mg-t-8 text-right">
                                        <button name="Add_Break" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Break</button>
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
                                    <th>Time</th>
                                    <th>Day</th>
                                    <th>Break</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM Ubc_Timetable WHERE timetable_break != "" ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($timetable = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($timetable->timetable_class_time == '3') {
                                                echo "10:00 - 10:30 AM";
                                            } elseif ($timetable->timetable_class_time == '4') {
                                                echo "10:30 - 10:55 AM";
                                            } elseif ($timetable->timetable_class_time == '7') {
                                                echo "1:00 - 1:55 PM";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $timetable->timetable_day; ?>
                                        </td>
                                        <td>
                                            <?php echo $timetable->timetable_break; ?>
                                        </td>
                                        <td>
                                            <a href="#delete-<?php echo $timetable->timetable_id; ?>" data-toggle="modal" class="radius-30 badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete Staff Confirmation -->
                                            <div class="modal fade" id="delete-<?php echo $timetable->timetable_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete ? </h4>
                                                            <p>Heads Up, You are about to delete timetable entry. This action is irrevisble.</p>
                                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                                            <a href="timetable_add_break?delete=<?php echo $timetable->timetable_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
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
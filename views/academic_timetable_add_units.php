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

/* Add Units To Time Table */
if (isset($_POST['Add_Unit_To_Time_Table'])) {
    $timetable_id = $ID;
    $timetable_class_time = $_POST['timetable_class_time'];
    $timetable_day = $_POST['timetable_day'];
    $timetable_allocation_id = $_POST['timetable_allocation_id'];

    /* Prevent Double Entries */
    $sql
        = "SELECT * FROM  Ubc_Timetable   
    WHERE timetable_class_time ='$timetable_class_time' 
    AND  timetable_day = '$timetable_day' 
    AND timetable_allocation_id = '$timetable_allocation_id'";

    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (
            $timetable_class_time == $row['timetable_class_time'] &&
            $timetable_day == $row['timetable_day'] &&
            $timetable_allocation_id == $row['timetable_allocation_id']
        ) {
            $err =
                'Unit Already In Time Table';
        }
    } else {


        $query = 'INSERT INTO Ubc_Timetable (timetable_id, timetable_class_time, timetable_day, timetable_allocation_id) 
        VALUES (?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'ssss',
            $timetable_id,
            $timetable_class_time,
            $timetable_day,
            $timetable_allocation_id
        );
        $stmt->execute();
        if ($stmt) {
            $success = "Unit Added To TimeTable";
        } else {
            $err = 'Please Try Again Or Try Later';
        }
    }
}
/* Delete*/
if (isset($_GET['delete'])) {
    $error = 0;
    $timetable_id = $_GET['delete'];
    if (!$error) {
        $sql = "DELETE FROM Ubc_Timetable  WHERE timetable_id ='$timetable_id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Unit/Subject is Removed ";
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
                    <h3>Teaching Time Table - Add Units</h3>
                    <ul>
                        <li>
                            <a href="academic_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="academic_dashboard">Time Table</a>
                        </li>
                        <li>Add Units / Subjects</li>
                    </ul>
                </div>
                <div class="text-right">
                    <a class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" href="academic_timetable_download">
                        <i class="fas fa-file-download"></i>
                        Download Timetable
                    </a>
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-book-open"></i>
                        Add Subject To Time Table
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
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Time</label>
                                                <select class="select2 form-control" name="timetable_class_time" style="width: 100%;">
                                                    <option value="1">8:00 - 8:55 AM</option>
                                                    <option value="2">9:00 - 9:55 AM</option>
                                                    <option value="5">11:00 - 11:55 AM</option>
                                                    <option value="6">12:00 - 12:55 PM</option>
                                                    <option value="8">2:00 - 2:55 PM</option>
                                                    <option value="9">3:00 - 3:55 PM</option>
                                                    <option value="10">4:00 - 4:55 PM</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Day</label>
                                                <select class="select2 form-control" name="timetable_day" style="width: 100%;">
                                                    <option>Monday</option>
                                                    <option>Tuesday</option>
                                                    <option>Wednesday</option>
                                                    <option>Thursday</option>
                                                    <option>Friday</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Unit / Subject & Teacher Information</legend>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label> Unit / Subject Details & Allocated Teacher</label>
                                                <select class="select2 form-control" name="timetable_allocation_id" style="width: 100%;">
                                                    <?php
                                                    $ret =
                                                        'SELECT * FROM  Ubc_Teaching_Allocations ta
                                                     INNER JOIN Ubc_Academic_Calendar ac ON ta.teaching_allocation_academic_calendar_id = ac.academic_calendar_id
                                                     INNER JOIN Ubc_Staff s ON  s.staff_id = ta.teaching_allocation_staff_id
                                                     INNER JOIN Ubc_Units u ON u.unit_id = ta.teaching_allocation_unit_id
                                                    ';
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($allocated = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $allocated->teaching_allocation_id; ?>">
                                                            <?php echo $allocated->unit_code . ' ' . $allocated->unit_name . ' Allocated To  ' . $allocated->staff_name . ' - ' . $allocated->teaching_allocation_class_name . ''; ?>
                                                        </option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-12 form-group mg-t-8 text-right">
                                        <button name="Add_Unit_To_Time_Table" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Subject / Unit</button>
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
                                    <th>Class</th>
                                    <th>Unit Details</th>
                                    <th>Teacher</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret =
                                    'SELECT * FROM Ubc_Timetable t INNER JOIN Ubc_Teaching_Allocations a ON a.teaching_allocation_id = t.timetable_allocation_id
                                    INNER JOIN Ubc_Academic_Calendar ac ON a.teaching_allocation_academic_calendar_id = ac.academic_calendar_id
                                     INNER JOIN Ubc_Staff s ON  s.staff_id = a.teaching_allocation_staff_id
                                     INNER JOIN Ubc_Units u ON u.unit_id = a.teaching_allocation_unit_id 
                                     ORDER BY t.timetable_class_time ASC 
                                    ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($timetable = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($timetable->timetable_class_time == '1') {
                                                echo "8:00 - 8:55 AM";
                                            } elseif ($timetable->timetable_class_time == '2') {
                                                echo "9:00 - 9:55 AM";
                                            } elseif ($timetable->timetable_class_time == '5') {
                                                echo "11:00 - 11:55 AM";
                                            } elseif ($timetable->timetable_class_time == '6') {
                                                echo "12:00 - 12:55 PM";
                                            } elseif ($timetable->timetable_class_time == '8') {
                                                echo "2:00 - 2:55 PM";
                                            } elseif ($timetable->timetable_class_time == '9') {
                                                echo "3:00 - 3:55 PM";
                                            } elseif ($timetable->timetable_class_time == '10') {
                                                echo "4:00 - 4:55 PM";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $timetable->timetable_day; ?>
                                        </td>
                                        <td>
                                            <?php echo $timetable->teaching_allocation_class_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $timetable->unit_code . ' ' . $timetable->unit_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $timetable->staff_name; ?>
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
                                                            <a href="timetable_add_units?delete=<?php echo $timetable->timetable_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
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
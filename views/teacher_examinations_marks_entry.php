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
staff_checklogin();


/* Add Student Marks */
if (isset($_POST['Add_Marks'])) {
    $marks_id = $ID;
    $marks_allocation_id = $_POST['marks_allocation_id'];
    $marks_midterm_exam = $_POST['marks_midterm_exam'];
    $marks_assignments = $_POST['marks_assignments'];
    $marks_final = $_POST['marks_final'];
    $marks_student_id = $_POST['marks_student_id'];

    /* Persist Marks */
    $query = 'INSERT INTO  Ubc_Student_Marks (marks_id, marks_allocation_id ,marks_midterm_exam,  marks_assignments, marks_final, marks_student_id) VALUES(?,?,?,?,?,?);';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssssss',
        $marks_id,
        $marks_allocation_id,
        $marks_midterm_exam,
        $marks_assignments,
        $marks_final,
        $marks_student_id
    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Student Marks Posted';
    } else {
        $err = 'Please Try Again Or Try Later';
    }
}
/* Update Marks */
if (isset($_POST['Update_Marks'])) {
    $marks_id = $_POST['marks_id'];
    $marks_midterm_exam = $_POST['marks_midterm_exam'];
    $marks_assignments = $_POST['marks_assignments'];
    $marks_final = $_POST['marks_final'];
    $query = "UPDATE Ubc_Student_Marks  SET  marks_midterm_exam =? ,marks_assignments =? ,marks_final=? WHERE marks_id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssss',
        $marks_midterm_exam,
        $marks_assignments,
        $marks_final,
        $marks_id

    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Marks Updated';
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}
/* Delete Marks */
if (isset($_GET['delete'])) {
    $error = 0;
    $marks_id = $_GET['delete'];
    if (!$error) {
        $sql = "DELETE FROM  Ubc_Student_Marks  WHERE marks_id ='$marks_id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Deleted" && header("refresh:1; url=examinations_marks_entry");
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
        <?php require_once '../partials/teacher_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/teacher_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Marks Entries</h3>
                    <ul>
                        <li>
                            <a href="teacher_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Examinations</a>
                        </li>
                        <li>Marks Entry</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-file-medical"></i>
                        Add Marks
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
                                        <legend class="w-auto text-primary font-weight-bold">Allocated Subject & Student Details</legend>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Select Subject</label>
                                                <select class="select2 form-control" name="marks_allocation_id" style="width: 100%;">
                                                    <?php
                                                    $staff_id = $_SESSION['staff_id'];
                                                    $ret =
                                                        "SELECT * FROM  Ubc_Teaching_Allocations ta
                                                     INNER JOIN Ubc_Academic_Calendar ac ON ta.teaching_allocation_academic_calendar_id = ac.academic_calendar_id
                                                     INNER JOIN Ubc_Staff s ON  s.staff_id = ta.teaching_allocation_staff_id
                                                     INNER JOIN Ubc_Units u ON u.unit_id = ta.teaching_allocation_unit_id
                                                     WHERE ta.teaching_allocation_staff_id = '$staff_id' AND  ac.academic_calendar_status = 'Current'";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($allocated = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $allocated->teaching_allocation_id; ?>">
                                                            <?php echo $allocated->unit_code . ' ' . $allocated->unit_name  ?>
                                                        </option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Select Student</label>
                                                <select class="select2 form-control" name="marks_student_id" style="width: 100%;">
                                                    <?php
                                                    $ret =
                                                        "SELECT * FROM Ubc_Student where student_account_status ='Active'";
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
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Marks Attained</legend>
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Mid Term Exam Marks</label>
                                                <input type="text" name="marks_midterm_exam" class="form-control">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Term Assignments Marks</label>
                                                <input type="text" name="marks_assignments" class="form-control">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Final Term Exam Marks</label>
                                                <input type="text" name="marks_final" class="form-control">
                                            </div>

                                        </div>
                                    </fieldset>
                                    <br>
                                    <div class="col-12 form-group mg-t-8 text-right">
                                        <button name="Add_Marks" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Marks</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Details</th>
                                    <th>Subject</th>
                                    <th>Mid Term </th>
                                    <th>Assignments</th>
                                    <th>Final Exam </th>
                                    <th>Total Marks</th>
                                    <th>Grade</th>
                                    <th>Grade Point</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM  Ubc_Student_Marks m
                                INNER JOIN Ubc_Student s ON m.marks_student_id = s.student_id 
                                INNER JOIN  Ubc_Teaching_Allocations ta ON m.marks_allocation_id = ta.teaching_allocation_id
                                INNER JOIN Ubc_Units u ON ta.teaching_allocation_unit_id = u.unit_id
                                WHERE ta.teaching_allocation_staff_id = '$staff_id'";

                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($marks = $res->fetch_object()) {
                                    /* Total Marks */
                                    $total_marks = (int)$marks->marks_midterm_exam + (int)$marks->marks_assignments + (int)$marks->marks_final;
                                    /* Compute Average */
                                    // $avg = round(($total_marks / 3), 0);
                                    /* Get Grade */

                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $marks->student_admission_no; ?><br>
                                            <?php echo $marks->student_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->unit_code; ?> <br>
                                            <?php echo $marks->unit_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->marks_midterm_exam; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->marks_assignments; ?>
                                        </td>
                                        <td>
                                            <?php echo $marks->marks_final; ?>
                                        </td>

                                        <td>
                                            <?php echo $total_marks; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($total_marks <= 100 && $total_marks >= 95) {
                                                $grade = 'A';
                                                $gp = '12';
                                            } else if ($total_marks <= 94 && $total_marks >= 90) {
                                                $grade = 'A-';
                                                $gp = '11.25';
                                            } else if ($total_marks <= 89 && $total_marks >= 87) {
                                                $grade = 'B+';
                                                $gp = '10.5';
                                            } else if ($total_marks <= 86 && $total_marks >= 84) {
                                                $grade = 'B';
                                                $gp = '9';
                                            } else if ($total_marks <= 83 && $total_marks >= 80) {
                                                $grade = 'B-';
                                                $gp = '8.25';
                                            } else if ($total_marks <= 79 && $total_marks >= 77) {
                                                $grade = 'C+';
                                                $gp = '7.5';
                                            } else if ($total_marks <= 76 && $total_marks >= 74) {
                                                $grade = 'C';
                                                $gp = '6';
                                            } else if ($total_marks <= 73 && $total_marks >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($total_marks <= 73 && $total_marks >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($total_marks <= 69 && $total_marks >= 67) {
                                                $grade = 'D+';
                                                $gp = '4.5';
                                            } else if ($total_marks <= 66 && $total_marks >= 64) {
                                                $grade = 'D';
                                                $gp = '3.75';
                                            } else if ($total_marks <= 63 && $total_marks >= 60) {
                                                $grade = 'D-';
                                                $gp = '2.25';
                                            } else {
                                                $grade = 'E';
                                                $gp = '0';
                                            }
                                            echo
                                            $grade; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($total_marks <= 100 && $total_marks >= 95) {
                                                $grade = 'A';
                                                $gp = '12';
                                            } else if ($total_marks <= 94 && $total_marks >= 90) {
                                                $grade = 'A-';
                                                $gp = '11.25';
                                            } else if ($total_marks <= 89 && $total_marks >= 87) {
                                                $grade = 'B+';
                                                $gp = '10.5';
                                            } else if ($total_marks <= 86 && $total_marks >= 84) {
                                                $grade = 'B';
                                                $gp = '9';
                                            } else if ($total_marks <= 83 && $total_marks >= 80) {
                                                $grade = 'B-';
                                                $gp = '8.25';
                                            } else if ($total_marks <= 79 && $total_marks >= 77) {
                                                $grade = 'C+';
                                                $gp = '7.5';
                                            } else if ($total_marks <= 76 && $total_marks >= 74) {
                                                $grade = 'C';
                                                $gp = '6';
                                            } else if ($total_marks <= 73 && $total_marks >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($total_marks <= 73 && $total_marks >= 70) {
                                                $grade = 'C-';
                                                $gp = '5.25';
                                            } else if ($total_marks <= 69 && $total_marks >= 67) {
                                                $grade = 'D+';
                                                $gp = '4.5';
                                            } else if ($total_marks <= 66 && $total_marks >= 64) {
                                                $grade = 'D';
                                                $gp = '3.75';
                                            } else if ($total_marks <= 63 && $total_marks >= 60) {
                                                $grade = 'D-';
                                                $gp = '2.25';
                                            } else {
                                                $grade = 'E';
                                                $gp = '0';
                                            }
                                            echo
                                            $gp; ?>
                                        </td>

                                        <td>
                                            <a href="#edit-<?php echo $marks->marks_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                <i class="fas fa-edit"></i>
                                                Update
                                            </a>
                                            <div class="modal left-slide-modal fade" id="edit-<?php echo $marks->marks_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Upate <?php echo $marks->student_name . '  ' . $marks->unit_name; ?> Marks Entry</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                <fieldset class="border border-primary p-2">
                                                                    <legend class="w-auto text-primary font-weight-bold">Marks Attained</legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Mid Term Exam Marks</label>
                                                                            <input type="text" name="marks_midterm_exam" value="<?php echo $marks->marks_midterm_exam; ?>" class="form-control">
                                                                            <input type="text" hidden name="marks_id" value="<?php echo $marks->marks_id; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Term Assignments Marks</label>
                                                                            <input type="text" name="marks_assignments" value="<?php echo $marks->marks_assignments; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Final Term Exam Marks</label>
                                                                            <input type="text" name="marks_final" value="<?php echo $marks->marks_final; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <br>
                                                                <div class="col-12 form-group mg-t-8 text-right">
                                                                    <button name="Update_Marks" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Marks</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                            <a href="#delete-<?php echo $marks->marks_id; ?>" data-toggle="modal" class="radius-30 badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete  -->
                                            <div class="modal fade" id="delete-<?php echo $marks->marks_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <p>Heads Up, You are about to delete student marks entry. This action is irrevisble.</p>
                                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                                            <a href="examinations_marks_entry?delete=<?php echo $marks->marks_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Delete -->
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
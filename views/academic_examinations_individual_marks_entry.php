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
            $allocation = $_GET['allocation'];
            $ret = "SELECT * FROM Ubc_Teaching_Allocations ta 
            INNER JOIN  Ubc_Academic_Calendar ac ON ta.teaching_allocation_academic_calendar_id = ac.academic_calendar_id
            INNER JOIN Ubc_Units u ON ta.teaching_allocation_unit_id = u.unit_id 
            WHERE ac.academic_calendar_status = 'Current' AND ta.teaching_allocation_id = '$allocation' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($subjects = $res->fetch_object()) {
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3><?php echo $subjects->unit_code . ' ' . $subjects->unit_name; ?></h3>
                        <ul>
                            <li>
                                <a href="academic_dashboard">Home</a>
                            </li>
                            <li>
                                <a href="">Examinations</a>
                            </li>
                            <li>
                                <a href="">Marks Entry</a>
                            </li>
                            <li><?php echo  $subjects->unit_code . '' . $subjects->unit_name; ?> Marks Entry</li>
                        </ul>
                    </div>
                    <hr>
                    <div class="card card-body">
                        <div class="text-center">
                            <h3><?php echo $subjects->teaching_allocation_class_name . '<br>' . $subjects->unit_code . ' ' . $subjects->unit_name; ?></h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Admn No</th>
                                        <th>Full Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $class = $_GET['class'];
                                    $ret = "SELECT * FROM Ubc_Student 
                                    WHERE student_academic_level ='$class' ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($student = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $student->student_admission_no; ?>
                                            </td>
                                            <td>
                                                <?php echo $student->student_name; ?>
                                            </td>
                                           
                                            <td>
                                                <a href="#add-marks-<?php echo $student->student_id; ?>" data-toggle="modal" class="radius-30 badge badge-success">
                                                    <i class="fas fa-edit"></i>
                                                    Add Marks
                                                </a>
                                                <!-- Add Marks Modal -->
                                                <div class="modal left-slide-modal fade" id="add-marks-<?php echo $student->student_id; ?>" role="dialog">
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
                                                                        <legend class="w-auto text-primary font-weight-bold">Marks Attained</legend>
                                                                        <div class="row">
                                                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                                                <label>Mid Term Exam Marks</label>
                                                                                <input type="text" name="marks_midterm_exam" class="form-control">
                                                                                <!-- Hidden Values -->
                                                                                <input type="hidden" name="marks_allocation_id" value="<?php echo $allocation; ?>" class="form-control">
                                                                                <input type="hidden" name="marks_student_id" value="<?php echo  $student->student_id; ?>" class="form-control">
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
            <?php
            } ?>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

</html>
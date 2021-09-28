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
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
require_once '../config/DataSource.php';
require_once '../vendor/autoload.php';
superadmin_check_login();
/* Add Student */
if (isset($_POST['Add_Student'])) {
    $student_phone_no = $_POST['student_phone_no'];
    $student_email = $_POST['student_email'];
    $sql = "SELECT * FROM  Ubc_Student   WHERE student_phone_no ='$student_phone_no' || student_email = '$student_email' ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (
            $student_phone_no == $row['student_phone_no'] ||
            $student_email == $row['student_email']
        ) {
            $err = 'Account With That Phone Number Or Email  Already Exists';
        }
    } else {
        $student_id = $ID;
        $student_admission_no = $admission_no;
        $student_name = $_POST['student_name'];
        $student_email = $_POST['student_email'];
        $student_password = sha1(md5($_POST['student_national_id']));
        $student_phone_no = $_POST['student_phone_no'];
        $student_gender = $_POST['student_gender'];
        $student_dob = $_POST['student_dob'];
        $student_area = $_POST['student_area'];
        $student_region = $_POST['student_region'];
        $student_dcc = $_POST['student_dcc'];
        $student_local_church = $_POST['student_local_church'];
        $student_residential_type = $_POST['student_residential_type'];
        $student_address = $_POST['student_address'];
        $student_national_id = $_POST['student_national_id'];
        $temp = explode('.', $_FILES['student_profile']['name']);
        $newfilename = 'Student' . (round(microtime(true)) . '.' . end($temp));
        move_uploaded_file(
            $_FILES['student_profile']['tmp_name'],
            '../public/img/studentavatars/' . $newfilename
        );
        $student_father_name  = $_POST['student_father_name'];
        $student_father_national_id = $_POST['student_father_national_id'];
        $student_father_phone  = $_POST['student_father_phone'];
        $student_mother_name   = $_POST['student_mother_name'];
        $student_mother_phone = $_POST['student_mother_phone'];
        $student_mother_idno   = $_POST['student_mother_idno'];
        $student_academic_level = $_POST['student_academic_level'];
        $student_date_admitted   = $_POST['student_date_admitted'];
        $student_academic_caledar_id   = $_POST['student_academic_caledar_id'];
        $query =
            'INSERT INTO Ubc_Student (
            student_id,
            student_admission_no,
            student_name,
            student_email,
            student_password,
            student_phone_no,
            student_gender,
            student_dob,
            student_area,
            student_region,
            student_dcc,
            student_local_church,
            student_residential_type,
            student_address,
            student_national_id,
            student_profile,
            student_father_name,
            student_father_national_id,
            student_father_phone,
            student_mother_name,
            student_mother_phone,
            student_mother_idno,
            student_academic_level,
            student_date_admitted,
            student_academic_caledar_id
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssssssssssssssssssssssss',
            $student_id,
            $student_admission_no,
            $student_name,
            $student_email,
            $student_password,
            $student_phone_no,
            $student_gender,
            $student_dob,
            $student_area,
            $student_region,
            $student_dcc,
            $student_local_church,
            $student_residential_type,
            $student_address,
            $student_national_id,
            $newfilename,
            $student_father_name,
            $student_father_national_id,
            $student_father_phone,
            $student_mother_name,
            $student_mother_phone,
            $student_mother_idno,
            $student_academic_level,
            $student_date_admitted,
            $student_academic_caledar_id

        );
        $stmt->execute();
        /* Mail User */
        require_once '../mailers/New_student.php';
        if ($stmt && $mail->send()) {
            $success = 'Student Account Created';
        } else {
            //inject alert that task failed
            $err = 'Please Try Again Or Try Later';
        }
    }
}

/* Update Student */
if (isset($_POST['Update_Student'])) {

    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];
    $student_phone_no = $_POST['student_phone_no'];
    $student_gender = $_POST['student_gender'];
    $student_dob = $_POST['student_dob'];
    $student_area = $_POST['student_area'];
    $student_region = $_POST['student_region'];
    $student_dcc = $_POST['student_dcc'];
    $student_local_church = $_POST['student_local_church'];
    $student_residential_type = $_POST['student_residential_type'];
    $student_address = $_POST['student_address'];
    $student_national_id = $_POST['student_national_id'];
    $student_father_name  = $_POST['student_father_name'];
    $student_father_national_id = $_POST['student_father_national_id'];
    $student_father_phone  = $_POST['student_father_phone'];
    $student_mother_name   = $_POST['student_mother_name'];
    $student_mother_phone = $_POST['student_mother_phone'];
    $student_mother_idno   = $_POST['student_mother_idno'];
    $student_academic_level = $_POST['student_academic_level'];
    $student_date_admitted   = $_POST['student_date_admitted'];
    $student_admission_no = $_POST['student_admission_no'];
    $query =
        "UPDATE  Ubc_Student SET
    student_name =?,
    student_email =?,
    student_phone_no =?,
    student_gender =?,
    student_dob =?,
    student_area =?,
    student_region =?,
    student_dcc =?,
    student_local_church =?,
    student_residential_type =?,
    student_address =?,
    student_national_id =?,
    student_father_name =?,
    student_father_national_id =?,
    student_father_phone =?,
    student_mother_name =?,
    student_mother_phone =?,
    student_mother_idno =?,
    student_academic_level =?,
    student_date_admitted =?
    WHERE
    student_admission_no=?";


    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssssssssssssssssssss',

        $student_name,
        $student_email,
        $student_phone_no,
        $student_gender,
        $student_dob,
        $student_area,
        $student_region,
        $student_dcc,
        $student_local_church,
        $student_residential_type,
        $student_address,
        $student_national_id,
        $student_father_name,
        $student_father_national_id,
        $student_father_phone,
        $student_mother_name,
        $student_mother_phone,
        $student_mother_idno,
        $student_academic_level,
        $student_date_admitted,
        $student_admission_no
    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Student Account Updated';
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}


/* Delete Student */
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];
    $student_account_status = "Delete";
    $query ="UPDATE  Ubc_Student SET
    student_account_status =?
    WHERE
    student_id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ss',
        $student_account_status,
        $id
    );
    $stmt->execute();

    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=students_management");
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Bulk Import Students Partial */
require_once('../functions/bulk_import_students.php');

require_once('../partials/head.php');
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once('../partials/header.php'); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once('../partials/sidebar.php'); ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>Students</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="modal-trigger btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#bulk_import">
                        <i class="fas fa-file-import"></i>
                        Bulk Import Students
                    </button>
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-user-graduate"></i>
                        Add Students
                    </button>
                </div>
                <hr>
                <!-- Bulk Import Modals -->
                <div class="modal left-slide-modal fade" id="bulk_import" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Bulk Import Students</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Allowed File Types: XLS, XLSX. Please, <a class="text-danger" href="../public/Data/system_data/xls_templates/Students_Template.xlsx">Download</a> A Template File. </legend>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputFile">Select File</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input required name="file" accept=".xls,.xlsx" type="file" class="custom-file-input">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="upload" class="radius-30 btn-fill-lg btn-gradient-yellow">Upload File</button>
                                        </div>
                                        <br>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Bulk Import -->

                <!-- Add Student Modal -->
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
                                        <legend class="w-auto text-primary font-weight-bold">Student Personal Information</legend>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="student_name" required class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Email Address</label>
                                                <input type="email" name="student_email" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Phone Number</label>
                                                <input type="text" name="student_phone_no" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>National ID Number</label>
                                                <input type="text" name="student_national_id" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Date Of Birth</label>
                                                <input type="text" placeholder="DD-MM-YYYY" name="student_dob" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Address</label>
                                                <textarea type="text" rows="5" name="student_address" class="form-control"></textarea>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Gender</label>
                                                <select class="select2 form-control" name="student_gender" style="width: 100%;">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-4 form-group">
                                                <label>Student Passport</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" required name="student_profile" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Parent`s Information</legend>
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Father's Name</label>
                                                <input type="text" name="student_father_name" class="form-control">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Father's ID Number</label>
                                                <input type="text" name="student_father_national_id" class="form-control">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Father's Phone Number</label>
                                                <input type="text" name="student_father_phone" class="form-control">
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Mother's Name</label>
                                                <input type="text" name="student_mother_name" class="form-control">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Mother's ID Number</label>
                                                <input type="text" name="student_mother_idno" class="form-control">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Mother's Phone Number</label>
                                                <input type="text" name="student_mother_phone" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset class="border border-primary p-3">
                                        <legend class="w-auto text-primary font-weight-bold">Church Information</legend>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Area</label>
                                                <input type="text" name="student_area" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Region</label>
                                                <input type="text" name="student_region" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>DCC</label>
                                                <input type="text" name="student_dcc" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Local Church</label>
                                                <input type="text" required name="student_local_church" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Academics Information</legend>
                                        <div class="row">

                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Date Admitted </label>
                                                <input type="date" placeholder="dd/mm/yyyy" name="student_date_admitted" class="form-control air-datepicker" data-position='bottom right'>
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Residential Type</label>
                                                <select class="select2 form-control" name="student_residential_type" style="width: 100%;">
                                                    <option value="Boarder">Boarder</option>
                                                    <option value="Day Scholar">Day Scholar</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Current Academic Year & Term</label>
                                                <select class="select2 form-control" name="student_academic_caledar_id" style="width: 100%;">
                                                    <?php
                                                    $ret = 'SELECT * FROM  Ubc_Academic_Calendar WHERE academic_calendar_status = "Current"';
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($academic_year_details = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $academic_year_details->academic_calendar_id; ?>"><?php echo $academic_year_details->academic_calendar_year . ' - ' . $academic_year_details->academic_calendar_term; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                <label>Academic Level</label>
                                                <select class="select2 form-control" name="student_academic_level" style="width: 100%;">
                                                    <option>Class 1</option>
                                                    <option>Class 2</option>
                                                    <option>Class 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <div class="col-12 form-group mg-t-8 text-right">
                                        <button name="Add_Student" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Student</button>
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
                                    <th>Admission No</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>ID No</th>
                                    <th>Contacts</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM  Ubc_Student WHERE student_account_status != 'Delete' ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($students = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td><a href="student_profile?view=<?php echo $students->student_id; ?>"><?php echo $students->student_admission_no; ?></a></td>
                                        <td><?php echo $students->student_name; ?></td>
                                        <td><?php echo $students->student_gender; ?></td>
                                        <td><?php echo $students->student_national_id; ?></td>
                                        <td>
                                            Phone: <?php echo $students->student_phone_no; ?><br>
                                            Email: <?php echo $students->student_email; ?>
                                        </td>
                                        <td>
                                            <a href="#edit-<?php echo $students->student_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                <i class="fas fa-user-edit"></i>
                                                Edit
                                            </a>
                                            <!-- Edit Staff Modal -->
                                            <div class="modal left-slide-modal fade" id="edit-<?php echo $students->student_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update <?php echo $students->student_name; ?> Profile</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                <fieldset class="border border-primary p-2">
                                                                    <legend class="w-auto text-primary font-weight-bold">Student Personal Information</legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Full Name</label>
                                                                            <input type="text" name="student_name" value="<?php echo $students->student_name; ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Email Address</label>
                                                                            <input type="email" name="student_email" value="<?php echo $students->student_email; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Phone Number</label>
                                                                            <input type="text" name="student_phone_no" value="<?php echo $students->student_phone_no; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>National ID Number</label>
                                                                            <input type="text" name="student_national_id" value="<?php echo $students->student_national_id; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Date Of Birth</label>
                                                                            <input type="text" placeholder="DD-MM-YYYY" name="student_dob" value="<?php echo $students->student_dob; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Address</label>
                                                                            <textarea type="text" rows="5" name="student_address" class="form-control"><?php echo $students->student_address; ?></textarea>
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Gender</label>
                                                                            <select class="select2 form-control" name="student_gender" style="width: 100%;">
                                                                                <option selected value="<?php echo $students->student_gender; ?>"><?php echo $students->student_gender; ?></option>
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="border border-primary p-2">
                                                                    <legend class="w-auto text-primary font-weight-bold">Parent`s Information</legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                                            <label>Father's Name</label>
                                                                            <input type="text" name="student_father_name" value="<?php echo $students->student_father_name; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                                            <label>Father's ID Number</label>
                                                                            <input type="text" name="student_father_national_id" value="<?php echo $students->student_father_national_id; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                                            <label>Father's Phone Number</label>
                                                                            <input type="text" name="student_father_phone" value="<?php echo $students->student_father_phone; ?>" class="form-control">
                                                                        </div>

                                                                        <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                                            <label>Mother's Name</label>
                                                                            <input type="text" name="student_mother_name" value="<?php echo $students->student_mother_name; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                                            <label>Mother's ID Number</label>
                                                                            <input type="text" name="student_mother_idno" value="<?php echo $students->student_mother_idno; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-4 col-lg-4 col-12 form-group">
                                                                            <label>Mother's Phone Number</label>
                                                                            <input type="text" name="student_mother_phone" value="<?php echo $students->student_mother_phone; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="border border-primary p-3">
                                                                    <legend class="w-auto text-primary font-weight-bold">Church Information</legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Area</label>
                                                                            <input type="text" name="student_area" value="<?php echo $students->student_area; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Region</label>
                                                                            <input type="text" name="student_region" value="<?php echo $students->student_region; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>DCC</label>
                                                                            <input type="text" name="student_dcc" value="<?php echo $students->student_dcc; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Local Church</label>
                                                                            <input type="text" required name="student_local_church" value="<?php echo $students->student_local_church ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="border border-primary p-2">
                                                                    <legend class="w-auto text-primary font-weight-bold">Academics Information</legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Admission Number</label>
                                                                            <input readonly type="text" name="student_admission_no" value="<?php echo $students->student_admission_no ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Date Admitted </label>
                                                                            <input type="date" placeholder="dd/mm/yyyy" name="student_date_admitted" value="<?php echo $students->student_date_admitted ?>" class="form-control air-datepicker" data-position='bottom right'>
                                                                            <i class="far fa-calendar-alt"></i>
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Residential Type</label>
                                                                            <select class="select2 form-control" name="student_residential_type" style="width: 100%;">
                                                                                <option selected value="<?php echo $students->student_residential_type ?>"><?php echo $students->student_residential_type ?></option>
                                                                                <option value="Boarder">Boarder</option>
                                                                                <option value="Day Scholar">Day Scholar</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Academic Level</label>
                                                                            <select class="select2 form-control" name="student_academic_level" style="width: 100%;">
                                                                                <option><?php echo $students->student_academic_level ?></option>
                                                                                <option>Class 1</option>
                                                                                <option>Class 2</option>
                                                                                <option>Class 3</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <br>
                                                                <div class="col-12 form-group mg-t-8 text-right">
                                                                    <button name="Update_Student" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Student</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->

                                            <a href="#delete-<?php echo $students->student_id; ?>" data-toggle="modal" class="radius-30 badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete Staff Confirmation -->
                                            <div class="modal fade" id="delete-<?php echo $students->student_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete <?php echo $students->student_name; ?> Student Account ? </h4>
                                                            <p>Heads Up, You are about to delete <?php echo $students->student_name; ?> details. This action is irrevisble.</p>
                                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                                            <a href="students_management?delete=<?php echo $students->student_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
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
                <?php require_once('../partials/footer.php'); ?>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>
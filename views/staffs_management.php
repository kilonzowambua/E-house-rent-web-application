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
require_once '../config/DataSource.php';
require_once '../vendor/autoload.php';
superadmin_check_login();
/* Add Staff */
if (isset($_POST['Add_Staff'])) {
    $staff_phone_no = $_POST['staff_phone_no'];
    $staff_email = $_POST['staff_email'];
    $sql = "SELECT * FROM  Ubc_Staff   WHERE staff_phone_no ='$staff_phone_no' || staff_email = '$staff_email' ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (
            $staff_phone_no == $row['staff_phone_no'] ||
            $staff_email == $row['staff_email']
        ) {
            $err = 'Account With That Phone Number Or Email  Already Exists';
        }
    } else {
        $staff_id = $ID;
        $staff_number = $_POST['staff_number'];
        $staff_name = $_POST['staff_name'];
        $staff_email = $_POST['staff_email'];
        $staff_phone_no = $_POST['staff_phone_no'];
        $staff_password = sha1(md5($_POST['staff_idno']));
        $staff_idno = $_POST['staff_idno'];

        $temp = explode('.', $_FILES['staff_profile_image']['name']);
        $newfilename = 'Staff' . (round(microtime(true)) . '.' . end($temp));
        move_uploaded_file(
            $_FILES['staff_profile_image']['tmp_name'],
            '../public/img/staff avatars/' . $newfilename
        );

        $staff_access_level = $_POST['staff_access_level'];

        $query =
            'INSERT INTO Ubc_Staff (staff_id,staff_number, staff_name,staff_email,staff_password, staff_phone_no,staff_idno,staff_profile_image,staff_access_level) VALUES (?,?,?,?,?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssssssss',
            $staff_id,
            $staff_number,
            $staff_name,
            $staff_email,
            $staff_password,
            $staff_phone_no,
            $staff_idno,
            $newfilename,
            $staff_access_level
        );
        $stmt->execute();
        /* Mail User */
        require_once '../mailers/New_staff.php';
        if ($stmt && $mail->send()) {
            $success = 'Staff Account  created';
        } else {
            //inject alert that task failed
            $err = 'Please Try Again Or Try Later';
        }
    }
}

/* Update Staff  */
if (isset($_POST['Update_Staff'])) {
    $staff_number = $_POST['staff_number'];
    $staff_name = $_POST['staff_name'];
    $staff_email = $_POST['staff_email'];
    $staff_phone_no = $_POST['staff_phone_no'];
    $staff_idno = $_POST['staff_idno'];
    $staff_access_level = $_POST['staff_access_level'];
    $query = "UPDATE Ubc_Staff  SET  staff_name =? ,staff_email =? ,staff_phone_no=? ,staff_idno =? , staff_access_level=? WHERE staff_number =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssssss',
        $staff_name,
        $staff_email,
        $staff_phone_no,
        $staff_idno,
        $staff_access_level,
        $staff_number
    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Staff Account Updated';
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Delete Staff */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $staff_status = "Delete";
    $adn = "UPDATE Ubc_Staff SET  staff_status=? WHERE staff_id =?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('ss', $staff_status, $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=staffs_management");
    } else {
        //inject alert that task failed
        $info = "Please Try Again Or Try Later";
    }
}

/* Bulk Import Staff */
require_once('../functions/bulk_import_teachers.php');

/* Load Head */
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
                    <h3>Staffs</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>Staffs</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="modal-trigger btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#bulk_import">
                        <i class="fas fa-file-import"></i>
                        Bulk Import Staff
                    </button>
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-user-plus"></i>
                        Add Staff
                    </button>
                </div>
                <hr>
                <!-- Bulk Import Modals -->
                <div class="modal left-slide-modal fade" id="bulk_import" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Bulk Import Staffs</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Allowed File Types: XLS, XLSX. Please, <a href="../public/Data/system_data/xls_templates/Staffs_Template.xlsx" class="text-danger">Download</a> A Template File. </legend>
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

                <!-- Add Staff Modal -->
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
                                    <legend class="w-auto text-primary font-weight-bold">Staff Information</legend>
                                    <form method="post" enctype="multipart/form-data" class="new-added-form">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Staff Number</label>
                                                <input readonly value="<?php echo $staff_number; ?>" type="text" name="staff_number" required class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Staff Name</label>
                                                <input type="text" name="staff_name" required class="form-control">
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Email Address</label>
                                                <input type="email" name="staff_email" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Phone Number</label>
                                                <input type="text" name="staff_phone_no" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>National ID Number</label>
                                                <input type="text" name="staff_idno" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Staff Passport</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" required name="staff_profile_image" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Staff Access levels</label>
                                                <select class="form-control select2" name="staff_access_level">
                                                    <option selected>Select Staff Access Levels</option>
                                                    <option value="Finance">Finance</option>
                                                    <option Value="Academic">Academic</option>
                                                    <option value="Library">Library</option>
                                                    <option value="Teacher">Teacher</option>
                                                </select>
                                            </div>
                                            <div class="col-12 form-group mg-t-8 text-right">
                                                <button name="Add_Staff" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Staff</button>
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
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Contacts</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM  Ubc_Staff WHERE staff_status != "Delete" ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($staff = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><a href="staff_profile?view=<?php echo $staff->staff_id; ?>"><?php echo $staff->staff_number; ?></a></td>
                                        <td><?php echo $staff->staff_name; ?></td>
                                        <td><?php echo $staff->staff_idno; ?></td>
                                        <td>
                                            Phone: <?php echo $staff->staff_phone_no; ?><br>
                                            Email: <?php echo $staff->staff_email; ?>
                                        </td>
                                        <td>
                                            <a href="#edit-<?php echo $staff->staff_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                <i class="fas fa-user-edit"></i>
                                                Edit
                                            </a>
                                            <!-- Edit Staff Modal -->
                                            <div class="modal left-slide-modal fade" id="edit-<?php echo $staff->staff_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update <?php echo $staff->staff_name; ?> Profile</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset class="border border-primary p-2">
                                                                <legend class="w-auto text-primary font-weight-bold">Staff Information</legend>
                                                                <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                    <div class="row">
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Staff Name</label>
                                                                            <input type="text" name="staff_name" value="<?php echo $staff->staff_name; ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Email Address</label>
                                                                            <input type="email" name="staff_email" value="<?php echo $staff->staff_email; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Phone Number</label>
                                                                            <input type="text" name="staff_phone_no" value="<?php echo $staff->staff_phone_no; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>National ID Number</label>
                                                                            <input type="text" name="staff_idno" value="<?php echo $staff->staff_idno; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Staff Number</label>
                                                                            <input readonly type="text" value="<?php echo $staff->staff_number; ?>" name="staff_number" required class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Staff Access levels</label>
                                                                            <select class="form-control select2" name="staff_access_level">
                                                                                <option value="Finance">Finance</option>
                                                                                <option Value="Academic">Academic</option>
                                                                                <option value="Library">Library</option>
                                                                                <option value="Teacher">Teacher</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 form-group mg-t-8 text-right">
                                                                            <button name="Update_Staff" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Staff</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->

                                            <a href="#delete-<?php echo $staff->staff_id; ?>" data-toggle="modal" class="radius-30 badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete Staff Confirmation -->
                                            <div class="modal fade" id="delete-<?php echo $staff->staff_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete <?php echo $staff->staff_name; ?> Staff Account ? </h4>
                                                            <p>Heads Up, You are about to delete <?php echo $staff->staff_name; ?> details. This action is irrevisble.</p>
                                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                                            <a href="staffs_management?delete=<?php echo $staff->staff_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
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
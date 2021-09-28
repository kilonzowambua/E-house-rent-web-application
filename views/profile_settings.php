<?php
/*
 * Created on Wed Aug 25 2021
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
superadmin_check_login();

/* Update Profile */
if (isset($_POST['Update_Profile'])) {

    $staff_id = $_SESSION['staff_id'];
    $staff_name = $_POST['staff_name'];
    $staff_email = $_POST['staff_email'];
    $staff_phone_no = $_POST['staff_phone_no'];
    $staff_idno = $_POST['staff_idno'];
    $temp = explode(".", $_FILES["staff_profile_image"]["name"]);
    $newfilename = 'UBC_STAFF_IMG_' . (round(microtime(true)) . '.' . end($temp));
    move_uploaded_file($_FILES["staff_profile_image"]["tmp_name"], "../public/img/staff avatars/" . $newfilename);

    $query = "UPDATE Ubc_Staff SET staff_name = ?, staff_email =?, staff_phone_no = ?, staff_idno = ?,  staff_profile_image =? WHERE staff_id = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssssss', $staff_name, $staff_email, $staff_phone_no, $staff_idno, $newfilename, $staff_id);
    $stmt->execute();
    if ($stmt) {
        $success = "$staff_name Profile Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

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
            <?php require_once('../partials/sidebar.php');
            $staff_id = $_SESSION['staff_id'];
            $ret = "SELECT * FROM  Ubc_Staff WHERE staff_id = '$staff_id' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($super_admin = $res->fetch_object()) {
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3><?php echo $super_admin->staff_name; ?> Profile Settings</h3>
                        <ul>
                            <li>
                                <a href="dashboard">Home</a>
                            </li>
                            <li>Profile Settings</li>
                        </ul>
                    </div>
                    <!-- Breadcubs Area End Here -->
                    <div class="row">
                        <div class="col-12-xxxl col-xl-12">
                            <div class="card account-settings-box">
                                <div class="card-body">
                                    <div class="user-details-box">
                                        <form method="post" enctype="multipart/form-data" class="new-added-form">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                    <label>Full Name*</label>
                                                    <input type="text" name="staff_name" required value="<?php echo $super_admin->staff_name; ?>" class="form-control">
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                    <label>Email Address *</label>
                                                    <input type="email" name="staff_email" value="<?php echo $super_admin->staff_email; ?>" class="form-control">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                    <label>Phone Number *</label>
                                                    <input type="text" name="staff_phone_no" value="<?php echo $super_admin->staff_phone_no; ?>" class="form-control">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                    <label>National ID Number *</label>
                                                    <input type="text" name="staff_idno" value="<?php echo $super_admin->staff_idno; ?>" class="form-control">
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                    <label>Staff Passport</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" required accept=".png, .jpeg, .jpg" required name="staff_profile_image" class="custom-file-input" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group mg-t-8 text-right">
                                                    <button name="Update_Profile" type="submit" class="btn-fill-lg btn-gradient-yellow ">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Account Settings Area End Here -->
                    <?php require_once('../partials/footer.php'); ?>
                </div>
            <?php
            } ?>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once('../partials/scripts.php'); ?>

</body>


</html>
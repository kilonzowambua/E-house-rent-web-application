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

/* Update Staff Profile */
if (isset($_POST['Update_Profile_Pic'])) {
    $view = $_GET['view'];
    $temp = explode(".", $_FILES["staff_profile_image"]["name"]);
    $newfilename = 'Staff' . (round(microtime(true)) . '.' . end($temp));
    move_uploaded_file($_FILES["staff_profile_image"]["tmp_name"], "../public/img/staff avatars/" . $newfilename);

    $query = 'UPDATE Ubc_Staff SET  staff_profile_image=? WHERE staff_id =?  ';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ss', $newfilename, $view);
    $stmt->execute();
    if ($stmt) {
        $success = "Staff Profile Picture Updated";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/*Update Staff Profile */
if (isset($_POST['Change_Password'])) {
    $mailed_password = $_POST['new_password'];
    $hashed_password = sha1(md5($mailed_password));
    $user_email = $_POST['user_email'];
    $view = $_GET['view'];

    $query = 'UPDATE Ubc_Staff SET  staff_password=? WHERE staff_id =?  ';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ss', $hashed_password, $view);
    $stmt->execute();
    /* Mail User */
    require_once('../mailers/update_password_mailer.php');
    if ($stmt && $mail->send()) {
        $success = "Staff Password Reset";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
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
            $view = $_GET['view'];
            $ret = "SELECT * FROM  Ubc_Staff WHERE staff_id = '$view' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($super_admin = $res->fetch_object()) {
                /* Passport */
                if ($super_admin->staff_profile_image != '') {
                    $dir = "../public/img/staff avatars/$super_admin->staff_profile_image";
                } else {
                    $dir = "../public/Data/user_data/images/no-profile.png";
                }
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3><?php echo $super_admin->staff_name; ?> Profile</h3>
                        <ul>
                            <li>
                                <a href="dashboard">Home</a>
                            </li>
                            <li>
                                <a href="staffs_management">Staffs </a>
                            </li>
                            <li>Profile</li>
                        </ul>
                    </div>
                    <!-- Breadcubs Area End Here -->
                    <div class="row">

                        <div class="col-12 col-xl-6 col-3-xxxl">
                            <div class="card account-settings-box">
                                <div class="card-body">
                                    <div class="heading-layout1 mg-b-20">
                                        <div class="item-title">
                                            <h3></h3>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="staffs_management"><i class="fas fa-user-edit text-dark-pastel-green"></i>Edit</a>
                                                <button id="print" onclick="printContent('Print_Details');" class="dropdown-item"><i class="fas fa-print text-orange-peel"></i>Print</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="Print_Details">
                                        <div class="user-details-box">
                                            <div class="item-img text-center">
                                                <img src="<?php echo $dir; ?>" alt="user">
                                            </div>
                                            <br>
                                            <div class="item-content">
                                                <div class="info-table table-responsive">
                                                    <table class="table text-nowrap">
                                                        <tbody>
                                                            <tr>
                                                                <td>Full Name:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $super_admin->staff_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>User Type:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $super_admin->staff_access_level; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>E-mail:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $super_admin->staff_email; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Staff Number:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $super_admin->staff_number; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mobile Phone No:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $super_admin->staff_phone_no; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>National ID No :</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $super_admin->staff_idno; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-6 col-3-xxxl">
                            <div class="card account-settings-box">
                                <div class="card-body">
                                    <div class="heading-layout1 mg-b-20">
                                        <div class="item-title">
                                            <h3>Change Password</h3>
                                        </div>
                                    </div>
                                    <div class="user-details-box">
                                        <div class="item-content">
                                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                        <label>New Password</label>
                                                        <input type="text" name="new_password" value="<?php echo $super_admin->staff_idno; ?>" required class="form-control">
                                                        <input type="hidden" name="user_email" value="<?php echo $super_admin->staff_email; ?>" required class="form-control">

                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="text" name="confirm_password" value="<?php echo $super_admin->staff_idno; ?>" required class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8 text-right">
                                                        <button name="Change_Password" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Change Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <hr>
                                            <div class="item-title">
                                                <h3>Change Profile Picture</h3>
                                                <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" required name="staff_profile_image" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 form-group mg-t-8 text-right">
                                                            <button name="Update_Profile_Pic" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Profile</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Account Settings Area End Here -->
                    <?php require_once('../partials/footer.php'); ?>
                </div>
            <?php } ?>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once('../partials/scripts.php'); ?>

</body>


</html>
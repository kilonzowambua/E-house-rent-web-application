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
/* Change Password */
if (isset($_POST['Change_Password'])) {

    $staff_id = $_SESSION['staff_id'];
    $old_password = sha1(md5($_POST['old_password']));
    $new_password = sha1(md5($_POST['new_password']));
    $confirm_password = sha1(md5($_POST['confirm_password']));

    $sql = "SELECT * FROM Ubc_Staff   WHERE staff_id = '$staff_id'";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($old_password != $row['staff_password']) {
            $err =  "Please Enter Correct Old Password";
        } else if ($new_password != $confirm_password) {
            $err = "Confirmation Password Does Not Match";
        } else {
            $query = "UPDATE Ubc_Staff SET staff_password =? WHERE staff_id =?";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ss', $new_password, $staff_id);
            $stmt->execute();
            if ($stmt) {
                $success = "Password Updated";
            } else {
                $err = "Please Try Again Or Try Later";
            }
        }
    } else {
        $err = "Kindly log out and login again";
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
        <?php require_once('../partials/principal_header.php'); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once('../partials/principal_sidebar.php'); ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Change Password</h3>
                    <ul>
                        <li>
                            <a href="principal_dashboard">Dashboard</a>
                        </li>
                        <li>Update Password</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="row">

                    <div class="col-12-xxxl col-xl-12">
                        <div class="card account-settings-box">
                            <div class="card-body">
                                <div class="user-details-box">
                                    <form method="post" class="new-added-form">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Old Password *</label>
                                                <input type="password" name="old_password" required placeholder="" class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>New Password *</label>
                                                <input type="password" name="new_password" required placeholder="" class="form-control">
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Confirm Password *</label>
                                                <input type="password" name="confirm_password" required placeholder="" class="form-control">
                                            </div>
                                            <div class="col-12 form-group mg-t-8 text-right">
                                                <button name="Change_Password" type="submit" class="btn-fill-lg btn-gradient-yellow ">Update Password</button>
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
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once('../partials/scripts.php'); ?>

</body>


</html>
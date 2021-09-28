<?php
/*
 * Created on Tue Aug 24 2021
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

/*  Login */
session_start();
require_once('../config/config.php');

if (isset($_POST['Login'])) {
    /* Post Auth Values */
    $staff_email = trim($_POST['staff_email']);
    $staff_password = trim(sha1(md5($_POST['staff_password'])));

    /* Prepare SQL */
    $stmt = $mysqli->prepare("SELECT staff_number, staff_email, staff_password, staff_id, staff_access_level 
    FROM Ubc_Staff  WHERE (staff_number =? || staff_email = ?)  AND staff_password =?");

    /* Bind Auth Params */
    $stmt->bind_param('sss', $staff_email, $staff_email, $staff_password);
    $stmt->execute();

    /* Fetch Results */
    $stmt->bind_result($staff_number, $staff_email, $staff_password, $staff_id, $staff_access_level);
    $rs = $stmt->fetch();

    /* Persist Sessions */
    $_SESSION['staff_id'] = $staff_id;
    $_SESSION['staff_access_level'] = $staff_access_level;

    if ($rs && $staff_access_level == 'Super Admin') {
        header("location:dashboard");
    } elseif ($rs && $staff_access_level == 'Academic') {

        header("location:academic_dashboard");
    } elseif ($rs && $staff_access_level == 'Teacher') {

        header("location:teacher_dashboard");
    } elseif ($rs && $staff_access_level == 'Principal') {

        header("location:principal_dashboard");
    } elseif ($rs && $staff_access_level == 'Finance') {

        header("location:finance_dashboard");
    } else {
        $err = 'Incorrect Staff Number Or Password';
    }
}
require_once('../partials/head.php');
?>

<body>
    <div id="preloader"></div>
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <img src="../public/img/logo_preloader.png" height="150" width="150" alt="logo">
                </div>
                <form method="POST" class="login-form">
                    <div class="form-group">
                        <label>Staff Number</label>
                        <input type="text" name="staff_email" required class="form-control">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="staff_password" required class="form-control">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <a href="reset_password" class="forgot-btn">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="Login" class="login-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Page End Here -->
    <?php require_once('../partials/scripts.php'); ?>

</body>



</html>
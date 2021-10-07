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

//user_check_login();
/* Create account */
if (isset($_POST['register'])) {
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $sql = "SELECT * FROM  user  WHERE user_phone ='$user_phone' || user_email = '$user_email' ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (
            $user_phone == $row['user_phone'] ||
            $user_email == $row['user_email']
        ) {
            $err = 'Account With That Phone Number Or Email  Already Exists';
        }
    } else {
        $user_id = $ID;
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_phone = $_POST['user_phone'];
        $user_password = sha1(md5($_POST['user_password']));
        

        $query =
            'INSERT INTO user (user_id,user_name,user_email,user_phone,user_password) VALUES (?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssss',
            $user_id,
            $user_name,
            $user_email,
            $user_phone,
            $user_password
            
        );
        $stmt->execute();
     
        
        if ($stmt) {
            $success = 'User Account  created';
        } else {
            //inject alert that task failed
            $err = 'Please Try Again Or Try Later';
        }
    }
}
?>
<!doctype html>

<html class="no-js" lang="en">
<?php 
include('../partials/head.php');
?>
<body class="bg-white">
<div class="bg-img">

<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    <h1 class="align-content">Rental system </h1>
                </a>
            </div>
            <div class="login-form">
            <form method="post">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" name="user_name" required>
                        </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="tel"  name="user_phone" pattern="[+]{1}[0-9]{11,14}" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label>Email address</label>
                                <input type="email"  name="user_email" class="form-control">
                        </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control"  name="user_password">
                        </div>
                                    
                                    <button type="submit" name="register" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                    <div class="social-login-content">
                                        <div class="social-button">
                                            <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Register with facebook</button>
                                            <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Register with twitter</button>
                                        </div>
                                    </div>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="#"> Sign in</a></p>
                                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include('../partials/script.php'); ?>
</body>

</html>

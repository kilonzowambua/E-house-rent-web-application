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


/* Create account */
if (isset($_POST['login'])) {
    $user_email = $_POST['user_email'];
    $user_password = sha1(md5($_POST['user_password']));
    $stmt = $mysqli->prepare("SELECT user_email,user_password FROM user WHERE user_email=? and user_password=? ");
    $stmt->bind_param('ss', $user_email, $user_password);
    $stmt->execute();
    $stmt->bind_result($user_email, $user_password);
    $rs = $stmt->fetch();
  
    if ($rs) {
      $_SESSION['user_email'] = $user_email;
      header("location:user_home");
    } else {
      $err = "Access Denied Please Check Your Email Or Password";
      
    }
  }
//create using twitter
//create using Google

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
                                <label>Email address</label>
                                <input type="email"  name="user_email" class="form-control">
                        </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control"  name="user_password">
                        </div>
                                    
                                    <button type="submit" name="login" class="btn btn-primary btn-flat m-b-30 m-t-30">Login</button>
                                    <div class="social-login-content">
                                        <div class="social-button">
                                            <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Login with facebook</button>
                                            <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Login with twitter</button>
                                        </div>
                                    </div>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="index"> Sign up</a></p>
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

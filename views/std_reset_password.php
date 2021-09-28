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
require_once('../config/config.php');
require_once('../config/codeGen.php');

/* Reset Password */
if (isset($_POST['Reset_Password'])) {
    //prevent posting blank value for email
    if (isset($_POST['student_email']) && !empty($_POST['student_email'])) {
        $student_email = mysqli_real_escape_string($mysqli, trim($_POST['student_email']));
    } else {
        $error = 1;
        $err = "Enter your E-mail";
    }
    $query = mysqli_query($mysqli, "SELECT * from `Ubc_Student` WHERE student_email='" . $student_email . "'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows > 0) {
        $password = $generated_password; /* Find This @config/codeGen.php */
        /* Mail User Plain Password */
        $new_password = substr($password, 0, 10);
        /* Hash Password  */
        $hashed_password = sha1(md5($new_password));
        $query = "UPDATE Ubc_Student SET  student_password=? WHERE  student_email =?";
        $stmt = $mysqli->prepare($query);
        //bind paramaters
        $rc = $stmt->bind_param('ss', $hashed_password, $student_email);
        $stmt->execute();
        /* Load Mailer */
        require_once('../mailers/update_password_mailer.php');
        if ($stmt && $mail->send()) {
            $success = "Password Reset Instructions Sent To Your Mail";
            header('Location:index');
        } else {
            $err = "Password Reset Failed!, Try again $mail->ErrorInfo";
        }
    }
    /* User Does Not Exist */ else {
        $err = "Sorry, User Account With That Email Does Not Exist";
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
                        <label>Email Address</label>
                        <input type="email" name="student_email" class="form-control">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <a href="std_login" class="forgot-btn">Remembered Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="Reset_Password" class="login-btn">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Page End Here -->
    <?php require_once('../partials/scripts.php'); ?>

</body>



</html>
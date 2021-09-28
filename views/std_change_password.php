<?php
/*
 * Created on Fri Aug 27 2021
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
student_checklogin();


/* Update Student Password*/
if (isset($_POST['Change_Password'])) {

    $student_email = $_POST['student_email'];
    $student_id = $_SESSION['student_id'];

    /* Check Password Match */
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password != $confirm_password) {
        $err = "Passwords Do Not Match";
    } else {
        /* Hash Passwords */
        $new_password = $_POST['new_password'];
        $hashed_password = sha1(md5($new_password));

        $query = 'UPDATE Ubc_Student SET  student_password =? WHERE student_id =?  ';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $hashed_password, $student_id);
        $stmt->execute();
        /* Mail User */
        require_once('../mailers/update_password_mailer.php');
        if ($stmt && $mail->send()) {
            $success = "Student Password Reset";
        } else {
            //inject alert that task failed
            $err = 'Please Try Again Or Try Later';
        }
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
        <?php require_once('../partials/student_header.php'); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once('../partials/student_sidebar.php');
            $student_id = $_SESSION['student_id'];;
            // $_SESSION['student_id'];
            $ret = "SELECT * FROM  Ubc_Student s
            INNER JOIN Ubc_Academic_Calendar ac ON s.student_academic_caledar_id = ac.academic_calendar_id
             WHERE s.student_id = '$student_id' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($student = $res->fetch_object()) {
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3><?php echo $student->student_name; ?> Profile</h3>
                        <ul>
                            <li>
                                <a href="std_dashboard">Home</a>
                            </li>
                            <li>Profile</li>
                        </ul>
                    </div>
                    <!-- Breadcubs Area End Here -->
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card account-settings-box">
                                <div class="card-body">
                                    <div class="heading-layout1 mg-b-20">
                                        <div class="item-title">
                                            <h3>Change Your Student Portal Password</h3>
                                        </div>
                                    </div>

                                    <div class="user-details-box">
                                        <div class="item-content">
                                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password" required class="form-control">
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="password" name="confirm_password" required class="form-control">
                                                        <input type="hidden" readonly name="student_email" value="<?php echo $student->student_email; ?>" required class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8 text-right">
                                                        <button name="Change_Password" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Change Password</button>
                                                    </div>
                                                </div>
                                            </form>
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
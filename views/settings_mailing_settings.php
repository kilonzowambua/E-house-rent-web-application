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
require_once '../config/config.php';
require_once '../config/checklogin.php';
require_once '../config/codeGen.php';
superadmin_check_login();

/* Update System Settings - Mailing Settings */
if (isset($_POST['Update_Settings'])) {

    $mailer_host = $_POST['mailer_host'];
    $mailer_port = $_POST['mailer_port'];
    $mailer_protocol = $_POST['mailer_protocol'];
    $mailer_username = $_POST['mailer_username'];
    $mailer_mail_from_name  = $_POST['mailer_mail_from_name'];
    $mailer_mail_from_email = $_POST['mailer_mail_from_email'];
    $mailer_password = $_POST['mailer_password'];


    $query = 'UPDATE Ubc_Mailer_Settings SET mailer_host =?, mailer_port =?, mailer_protocol =?, mailer_username =?, mailer_mail_from_name =?, mailer_mail_from_email =?, mailer_password =?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssssss',
        $mailer_host,
        $mailer_port,
        $mailer_protocol,
        $mailer_username,
        $mailer_mail_from_name,
        $mailer_mail_from_email,
        $mailer_password
    );
    $stmt->execute();

    if ($stmt) {
        $success = "Mailer Settings Updated";
    } else {
        $err = 'Please Try Again Or Try Later';
    }
}

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
            <?php
            require_once '../partials/sidebar.php';
            $ret = 'SELECT * FROM  Ubc_Mailer_Settings ';
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($mailer = $res->fetch_object()) {
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3>Mailing Configurations</h3>
                        <ul>
                            <li>
                                <a href="dashboard">Home</a>
                            </li>
                            <li>
                                <a href="">Settings</a>
                            </li>
                            <li>Mailer</li>
                        </ul>
                    </div>



                    <div class="card card-body">
                        <fieldset class="border border-primary p-2">
                            <legend class="w-auto text-primary font-weight-bold">STMP Mailer Configurations</legend>
                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                        <label>Host</label>
                                        <input type="text" required name="mailer_host" value="<?php echo $mailer->mailer_host; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Port</label>
                                        <input type="text" required name="mailer_port" required value="<?php echo $mailer->mailer_port; ?>" class="form-control">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Protocol</label>
                                        <input type="text" required name="mailer_protocol" value="<?php echo $mailer->mailer_protocol; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Username</label>
                                        <input type="text" required name="mailer_username" value="<?php echo $mailer->mailer_username; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Password</label>
                                        <input type="password" required name="mailer_password" value="<?php echo $mailer->mailer_password; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Mail From </label>
                                        <input type="text" required name="mailer_mail_from_name" value="<?php echo $mailer->mailer_mail_from_name; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Mail From Email</label>
                                        <input type="text" required name="mailer_mail_from_email" value="<?php echo $mailer->mailer_mail_from_email; ?>" required class="form-control">
                                    </div>
                                    <br>
                                    <div class="col-12 form-group mg-t-8 text-right">
                                        <button name="Update_Settings" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Save</button>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                    <?php require_once '../partials/footer.php'; ?>
                </div>
            <?php
            } ?>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

</html>
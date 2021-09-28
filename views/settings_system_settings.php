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

/* Update System Settings */
if (isset($_POST['Update_Settings'])) {

    $Ubc_System_Setting_system_name = $_POST['Ubc_System_Setting_system_name'];
    $Ubc_System_Setting_po_box = $_POST['Ubc_System_Setting_po_box'];
    $Ubc_System_Setting_contact = $_POST['Ubc_System_Setting_contact'];
    $Ubc_System_Setting_mail  = $_POST['Ubc_System_Setting_mail'];
    $Ubc_System_Setting_website  = $_POST['Ubc_System_Setting_website'];

    $query = 'UPDATE Ubc_System_Settings SET Ubc_System_Setting_system_name =?, Ubc_System_Setting_po_box =?, Ubc_System_Setting_contact =?, Ubc_System_Setting_mail =?, Ubc_System_Setting_website =?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssss',
        $Ubc_System_Setting_system_name,
        $Ubc_System_Setting_po_box,
        $Ubc_System_Setting_contact,
        $Ubc_System_Setting_mail,
        $Ubc_System_Setting_website
    );
    $stmt->execute();

    if ($stmt) {
        $success = "System Settings Updated";
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
            $ret = 'SELECT * FROM  Ubc_System_Settings ';
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($system_settings = $res->fetch_object()) {
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3>MIS Core Configurations</h3>
                        <ul>
                            <li>
                                <a href="dashboard">Home</a>
                            </li>
                            <li>
                                <a href="">Settings</a>
                            </li>
                            <li>System Settings</li>
                        </ul>
                    </div>


                    <div class="card card-body">
                        <fieldset class="border border-primary p-2">
                            <legend class="w-auto text-primary font-weight-bold">MIS Configurations</legend>
                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                        <label>System Name</label>
                                        <input type="text" required name="Ubc_System_Setting_system_name" value="<?php echo $system_settings->Ubc_System_Setting_system_name; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                        <label>P.O Box</label>
                                        <input type="text" required name="Ubc_System_Setting_po_box" required value="<?php echo $system_settings->Ubc_System_Setting_po_box; ?>" class="form-control">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                        <label>Contacts</label>
                                        <input type="text" required name="Ubc_System_Setting_contact" value="<?php echo $system_settings->Ubc_System_Setting_contact; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                        <label>Email Address</label>
                                        <input type="text" required name="Ubc_System_Setting_mail" value="<?php echo $system_settings->Ubc_System_Setting_mail; ?>" required class="form-control">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                                        <label>Website</label>
                                        <input type="text" required name="Ubc_System_Setting_website" value="<?php echo $system_settings->Ubc_System_Setting_website; ?>" required class="form-control">
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
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
require_once('../partials/head.php');
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once('../partials/academic_header.php'); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once('../partials/academic_sidebar.php');
            $staff_id = $_SESSION['staff_id'];
            $ret = "SELECT * FROM  Ubc_Staff WHERE staff_id = '$staff_id' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($academic = $res->fetch_object()) {
                /* Passport */
                if ($academic->staff_profile_image != '') {
                    $dir = "../public/img/staff avatars/$academic->staff_profile_image";
                } else {
                    $dir = "../public/Data/user_data/images/no-profile.png";
                }
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3><?php echo $academic->staff_name; ?> Profile</h3>
                        <ul>
                            <li>
                                <a href="academic_dashboard">Home</a>
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
                                            <h3></h3>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>
                                            <div class="dropdown-menu dropdown-menu-right">
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
                                                                <td class="font-medium text-dark-medium"><?php echo $academic->staff_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>User Type:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $academic->staff_access_level; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>E-mail:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $academic->staff_email; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Staff Number:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $academic->staff_number; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mobile Phone No:</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $academic->staff_phone_no; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>National ID No :</td>
                                                                <td class="font-medium text-dark-medium"><?php echo $academic->staff_idno; ?></td>
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
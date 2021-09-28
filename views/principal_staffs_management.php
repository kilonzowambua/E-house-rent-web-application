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
superadmin_check_login();
/* Load Head */
require_once '../partials/head.php';
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once '../partials/principal_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/principal_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Staffs</h3>
                    <ul>
                        <li>
                            <a href="principal_dashboard">Home</a>

                        </li>
                        <li>Staffs</li>
                    </ul>
                </div>
                <div class="text-right">
                    <a href="principal_download_staff_records" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                        <i class="fas fa-file-download"></i>
                        Download Staff Records
                    </a>
                </div>
                <hr>
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Contacts</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM  Ubc_Staff WHERE staff_status != "Delete" ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($staff = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $staff->staff_number; ?></td>
                                        <td><?php echo $staff->staff_name; ?></td>
                                        <td><?php echo $staff->staff_idno; ?></td>
                                        <td>
                                            Phone: <?php echo $staff->staff_phone_no; ?><br>
                                            Email: <?php echo $staff->staff_email; ?>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php require_once '../partials/footer.php'; ?>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

</html>
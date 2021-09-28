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
/* Load System Settings Here */
$ret = 'SELECT * FROM  Ubc_System_Settings ';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($system_settings = $res->fetch_object()) {
?>
    <!doctype html>
    <html class="no-js" lang="">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $system_settings->Ubc_System_Setting_system_name; ?> | Staffs</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="../public/img/logo_preloader.png">
        <!-- Normalize CSS -->
        <link rel="stylesheet" href="../public/css/normalize.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="../public/css/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="../public/css/all.min.css">
        <!-- Flaticon CSS -->
        <link rel="stylesheet" href="../public/fonts/flaticon.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="../public/css/animate.min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../public/css/style.css">
        <!-- Modernize js -->
        <script src="../public/js/modernizr-3.6.0.min.js"></script>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="../public/css/animate.min.css">
        <!-- Alert Js -->
        <link rel="stylesheet" href="../public/plugins/iziToast/iziToast.min.css">
        <!-- Select 2 Css -->
        <link rel="stylesheet" href="../public/css/select2.min.css">
        <!-- Date Picker CSS -->
        <link rel="stylesheet" href="../public/css/datepicker.min.css">
        <!-- Responsive Data Tables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
        <!-- Export Data Tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    </head>
<?php } ?>

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
            <?php require_once '../partials/sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Reports</a>
                        </li>
                        <li>Students</li>
                    </ul>
                </div>

                <hr>


                <div class="card card-body">
                    <div class="table-responsive">
                        <table id="export-data-table">
                            <thead>
                                <tr>
                                    <th>Student idno</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Gender</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM  Ubc_Student WHERE student_account_status != "Delete"';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($student = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><a href="student_profile?view=<?php echo $student->student_id; ?>"><?php echo $student->student_admission_no;?></a></td>
                                        <td><?php echo $student->student_name; ?></td>
                                       
                                        <td>
                                        <?php echo $student->student_academic_level; ?>
                                        </td>
                                        <td>
                                        <?php echo $student->student_gender; ?>   
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
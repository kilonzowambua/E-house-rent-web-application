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
require_once '../partials/head.php';
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once '../partials/finance_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/finance_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Previous Student Fee Billing </h3>
                    <ul>
                        <li>
                            <a href="finance_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Finances</a>
                        </li>
                        <li>Billings</li>
                    </ul>
                </div>
                <!-- Bill Students -->
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Academic Calendar</th>
                                    <th>Billed Amount</th>
                                    <th>Description</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT DISTINCT academic_calendar_id, billing_academic_calendar_id, billing_amount, billing_desc, academic_calendar_year, academic_calendar_term FROM  Ubc_Billings b 
                                INNER JOIN  Ubc_Academic_Calendar ac ON b.billing_academic_calendar_id = ac.academic_calendar_id
                                WHERE ac.academic_calendar_status != "Current"';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($billings = $res->fetch_object()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $billings->academic_calendar_year; ?><br>
                                            <?php echo $billings->academic_calendar_term; ?><br>
                                        </td>
                                        <td>
                                            Ksh <?php echo $billings->billing_amount; ?><br>
                                        </td>
                                        <td>
                                            <?php echo $billings->billing_desc; ?><br>
                                        </td>
                                        <td>
                                            <a href="finance_download_previous_term_billing?academic_calendar=<?php echo $billings->academic_calendar_id; ?>" class="radius-30 badge badge-warning">
                                                <i class="fas fa-download"></i>
                                                Download
                                            </a>
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
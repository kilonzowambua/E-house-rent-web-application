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
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../partials/analytics.php');
superadmin_check_login();
require_once('../partials/head.php');
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once('../partials/header.php'); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once('../partials/sidebar.php'); ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Super Administrator Dashboard</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>Dashboard</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">

                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Class 1 Students</div>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $class_1; ?>"><?php echo $class_1; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Class 2 Students</div>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $class_2; ?>"><?php echo $class_2; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Class 3 Students</div>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $class_3; ?>"><?php echo $class_3; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Students</div>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $total_students; ?>"><?php echo $total_students; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green">
                                        <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Staffs</div>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $total_staffs; ?>"><?php echo $total_staffs; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Dashboard summery End Here -->
                <!-- Dashboard Content Start Here -->
                <div class="row gutters-20">
                    <div class="col-12 col-xl-6 col-3-xxxl">
                        <div class="card dashboard-card-three pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Students Gender Ratio</h3>
                                    </div>
                                </div>
                                <div class="doughnut-chart-wrap">
                                    <canvas id="student-gender-ratio" width="100" height="300"></canvas>
                                </div>
                                <div class="student-report">
                                    <div class="student-count pseudo-bg-blue">
                                        <h4 class="item-title">Female Students</h4>
                                        <div class="item-number"><?php echo $female_students; ?></div>
                                    </div>
                                    <div class="student-count pseudo-bg-pink">
                                        <h4 class="item-title">Male Students</h4>
                                        <div class="item-number"><?php echo $male_students; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 col-3-xxxl">
                        <div class="card dashboard-card-three pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Students Per Classes</h3>
                                    </div>
                                </div>
                                <div class="doughnut-chart-wrap">
                                    <canvas id="student-per-classes" width="100" height="300"></canvas>
                                </div>
                                <div class="student-report">
                                    <div class="student-count pseudo-bg-dark">
                                        <h4 class="item-title">Class 1</h4>
                                        <div class="item-number"><?php echo $class_1; ?></div>
                                    </div>
                                    <div class="student-count pseudo-bg-blue">
                                        <h4 class="item-title">Class 2</h4>
                                        <div class="item-number"><?php echo $class_2; ?></div>
                                    </div>
                                    <div class="student-count pseudo-bg-pink">
                                        <h4 class="item-title">Class 3</h4>
                                        <div class="item-number"><?php echo $class_3; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xl-12 col-4-xxxl">
                        <div class="card dashboard-card-six pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1 mg-b-17">
                                    <div class="item-title">
                                        <h3>Notice Board</h3>
                                    </div>
                                </div>
                                <div class="notice-box-wrap">
                                    <!-- Load Notices -->
                                    <?php
                                    $ret = 'SELECT * FROM  Ubc_Notices n INNER JOIN Ubc_Staff s ON n.notice_posted_by_id = s.staff_id  ORDER BY n.notice_posted_at DESC ';
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($notice = $res->fetch_object()) {
                                    ?>
                                        <div class="notice-list">
                                            <div class="post-date bg-primary"><?php echo date('d, M Y g:ia', strtotime($notice->notice_posted_at)); ?></div>
                                            <p>
                                                <?php echo $notice->notice_details; ?>
                                            </p>
                                            <div class="entry-meta"><b>Posted By: <?php echo $notice->staff_name; ?></b></div>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard Content End Here -->
                <!-- Footer Area Start Here -->
                <?php require_once('../partials/footer.php'); ?>
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <?php require_once('../partials/scripts.php'); ?>

</body>



</html>
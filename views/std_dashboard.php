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
require_once '../config/config.php';
require_once '../config/checklogin.php';
require_once '../partials/std_analytics.php';
student_checklogin();
require_once '../partials/head.php';
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once '../partials/student_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/student_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Student Dashboard</h3>
                    <ul>
                        <li>
                            <a href="std_dashboard">Home</a>
                        </li>
                        <li>Dashboard</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">

                    <div class="col-xl-6 col-sm-12 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="">
                                        <i class="fas fa-swatchbook fa-3x text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-number">Attempted Subjects</div>
                                        <div class="item-title"><span class="counter" data-num="<?php echo $attempted_units; ?>"><?php echo $attempted_units; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="">
                                        <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-number">Current Class</div>
                                        <div class="item-title"><span class="counter"><?php echo $student_class; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="">
                                        <i class="fas fa-hand-holding-usd fa-3x text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-number">Fee Payment</div>
                                        <div class="item-title">
                                            Total Fee Billed = Ksh <?php echo $total_billed; ?> <br>
                                            Total Fee Paid = Ksh <?php echo $total_paid; ?> <br>
                                            Fee Balance = Ksh <?php echo $fee_balance; ?> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard summery End Here -->
                <!-- Dashboard Content Start Here -->
                <div class="row gutters-20">
                    <div class="col-lg-12 col-xl-12 col-4-xxxl">
                        <div class="card dashboard-card-six pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1 mg-b-17">
                                    <div class="item-title">
                                        <h3>UBC Student Notice Board</h3>
                                    </div>
                                </div>
                                <div class="notice-box-wrap">
                                    <!-- Load Notices -->
                                    <?php
                                    $ret = "SELECT * FROM  Ubc_Notices n 
                                    INNER JOIN Ubc_Staff s ON n.notice_posted_by_id = s.staff_id 
                                    WHERE notice_to != 'Staff' 
                                    ORDER BY n.notice_posted_at DESC ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($notice = $res->fetch_object()) { ?>
                                        <div class="notice-list">
                                            <div class="post-date bg-primary">
                                                <?php echo date(
                                                    'd, M Y g:ia',
                                                    strtotime(
                                                        $notice->notice_posted_at
                                                    )
                                                ); ?>
                                            </div>
                                            <p>
                                                <?php echo $notice->notice_details; ?>
                                            </p>
                                            <div class="entry-meta"><b>Posted By: <?php echo $notice->staff_name; ?></b></div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard Content End Here -->
                <!-- Footer Area Start Here -->
                <?php require_once '../partials/footer.php'; ?>
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <?php require_once '../partials/scripts.php'; ?>

</body>



</html>
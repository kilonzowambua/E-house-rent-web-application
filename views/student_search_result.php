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
                    <h3>Search Results For : <?php echo $_GET['query']; ?> </h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>Search Results</li>
                    </ul>
                </div>
                <hr>

                <div class="card ">
                    <?php
                    $query = htmlspecialchars($_GET['query']);
                    $min_length = 0;
                    if (strlen($query) >= $min_length) {
                        $query = mysqli_real_escape_string($mysqli, $query);
                        $raw_results = mysqli_query($mysqli, "SELECT * FROM Ubc_Student WHERE (`student_admission_no` LIKE '%" . $query . "%') || (`student_name` LIKE '%" . $query . "%')  ");
                        if (mysqli_num_rows($raw_results) > 0) {
                            while ($results = mysqli_fetch_array($raw_results)) {
                                /* Load Profile Picture */
                                if ($results['student_profile'] == '') {
                                    $dir = "../public/img/studentavatars/default.png";
                                } else {
                                    $dir = "../public/img/studentavatars/" . $results['student_profile'];
                                } ?>
                                <a href="student_profile?view=<?php echo $results['student_id']; ?>">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="item-icon bg-light-green ">
                                                    <div class="item-img text-center">
                                                        <img src="<?php echo $dir; ?>" alt="user">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="item-content">
                                                    <div class="item-title"><?php echo $results['student_name'] ?></div>
                                                    <div class="item-number">
                                                        <span><?php echo $results['student_admission_no']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php }
                        } else { ?>
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-green ">
                                            <div class="item-img text-center">
                                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">No Search Results For:</div>
                                            <div class="item-number">
                                                <span><?php echo $_GET['query']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php }
                    } else {
                        ?>
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <div class="item-img text-center">
                                            <i class="fas fa-warning text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Minimum Search Querry Length Is <?php echo  $min_length; ?> Characters</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
                <?php require_once '../partials/footer.php'; ?>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

</html>
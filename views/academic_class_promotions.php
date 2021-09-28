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

/* Promote Class 1 To Class 2 */
if (isset($_GET['class_one'])) {
    $class_one = $_GET['class_one'];
    $sql = "UPDATE  Ubc_Student SET student_academic_level = '$class_one' WHERE student_academic_level = 'Class 1' ";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    if ($stmt) {
        $success = "Class Promoted" && header("refresh:1; url=academic_class_promotions");;
    } else {
        $err = "Please Try Again Or Try Later";
    }
}


/* Promote Class 2 To Class 3 */
if (isset($_GET['class_two'])) {
    $class_two = $_GET['class_two'];
    $sql = "UPDATE  Ubc_Student SET student_academic_level = '$class_two' WHERE student_academic_level = 'Class 2' ";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    if ($stmt) {
        $success = "Class Promoted" && header("refresh:1; url=academic_class_promotions");;
    } else {
        $err = "Please Try Again Or Try Later";
    }
}


/* Promote Class 3 To Graduates */
if (isset($_GET['class_three'])) {
    $class_three = $_GET['class_three'];
    $sql = "UPDATE  Ubc_Student SET student_academic_level = '$class_three' WHERE student_academic_level = 'Class 3' ";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    if ($stmt) {
        $success = "Class Promoted" && header("refresh:1; url=academic_class_promotions");;
    } else {
        $err = "Please Try Again Or Try Later";
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
            <?php require_once '../partials/sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Students Promotions</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Academics</a>
                        </li>
                        <li>Student Class Promotions</li>
                    </ul>
                </div>
                <hr>
                <fieldset class="border border-primary p-2">
                    <legend class="w-auto text-primary font-weight-bold">Click On Any Class To Promote</legend>
                    <div class="card card-body">
                        <div class="d-flex justify-content-center">
                            <button data-target="#promote_class_1" data-toggle="modal" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Promote Class 1
                            </button>

                            <!-- Promote Class 1 Students To Class 2 -->
                            <div class="modal fade" id="promote_class_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM PROMOTION</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center text-danger">
                                            <h4>Promote All Class 1 To Class 2 </h4>
                                            <p>Heads Up, <br> You are about to promote all class 1 students to class 2.</p>
                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                            <a href="academic_class_promotions?class_one=Class 2" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
                                                Yes Promote To Class 2
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End M -->

                            <button data-target="#promote_class_2" data-toggle="modal" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Promote Class 2
                            </button>

                            <!-- Promote Class 2 To Class 3 -->
                            <div class="modal fade" id="promote_class_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM PROMOTION</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center text-danger">
                                            <h4>Promote All Class 2 To Class 3 </h4>
                                            <p>Heads Up, <br> You are about to promote all class 2 students to class 3.</p>
                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                            <a href="academic_class_promotions?class_two=Class 3" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
                                                Yes Promote To Class 3
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button data-target="#promote_class_3" data-toggle="modal" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Promote Class 3
                            </button>
                            <!-- Promote Class 3 To Graduated -->
                            <div class="modal fade" id="promote_class_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM PROMOTION</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center text-danger">
                                            <h4>Promote All Class 3 To Graduates </h4>
                                            <p>Heads Up, <br> You are about to promote all class 3 students to Graduates.</p>
                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                            <a href="academic_class_promotions?class_three=Graduated" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
                                                Yes Promote To Graduated
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <?php require_once '../partials/footer.php'; ?>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once '../partials/scripts.php'; ?>

</body>

</html>
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
        <?php require_once '../partials/academic_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/academic_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Student Results</h3>
                    <ul>
                        <li>
                            <a href="academics_ashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Examinations</a>
                        </li>
                        <li>Student Results</li>
                    </ul>
                </div>
                <form method="post" enctype="multipart/form-data" class="new-added-form">
                    <fieldset class="border border-primary p-2">
                        <legend class="w-auto text-primary font-weight-bold">Class Details</legend>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                <select class="select2 form-control" name="class" style="width: 100%;">
                                    <option>
                                        Select Class Name
                                    </option>
                                    <option>
                                        Class 1
                                    </option>
                                    <option>
                                        Class 2
                                    </option>
                                    <option>
                                        Class 3
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 form-group mg-t-8 text-right">
                                <button name="SeachStudentResults" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">
                                    Search
                                </button>
                            </div>
                        </div>
                    </fieldset>

                </form>
                <hr>
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Admission Number</th>
                                    <th>Student Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['SeachStudentResults'])) {
                                    $class = $_POST['class'];
                                    $ret = "SELECT * FROM  Ubc_Student WHERE student_academic_level = '$class'";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($student = $res->fetch_object()) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $student->student_admission_no; ?><br>
                                            </td>
                                            <td>
                                                <?php echo $student->student_name; ?> <br>
                                            </td>
                                            <td>
                                                <a href="academic_examinations_download_student_result?student=<?php echo $student->student_id; ?>" class="radius-30 badge badge-success">
                                                    <i class="fas fa-cloud-download-alt"></i>
                                                    Download Results
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
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
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
/* Add Academic Calendar */
if (isset($_POST['Add_Calendar'])) {
    $academic_calendar_id = $ID;
    $academic_calendar_year = $_POST['academic_calendar_year'];
    $academic_calendar_term = $_POST['academic_calendar_term'];
    $academic_calendar_status = 'Current';
    // check Students academic Term 3

    $query_update =
        "UPDATE Ubc_Academic_Calendar  SET academic_calendar_status ='Past'";
    $query_add =
        'INSERT INTO Ubc_Academic_Calendar (academic_calendar_id,academic_calendar_year,academic_calendar_term,academic_calendar_status) VALUES (?,?,?,?)';

    $stmt_update = $mysqli->prepare($query_update);
    $stmt_add = $mysqli->prepare($query_add);
    $rc = $stmt_add->bind_param(
        'ssss',
        $academic_calendar_id,
        $academic_calendar_year,
        $academic_calendar_term,
        $academic_calendar_status
    );

    $stmt_update->execute();
    $stmt_add->execute();

    if ($stmt_update && $stmt_add) {
        $success =
            'Academic year change to ' .
            $academic_calendar_year .
            '-' .
            $academic_calendar_term;
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }


    /* Update Academic Calendae */
    if (isset($_POST['update_Calendar'])) {
        $academic_calendar_year = $_POST['academic_calendar_year'];
        $academic_calendar_term = $_POST['academic_calendar_term'];
        $academic_calendar_id = $_POST['academic_calendar_id'];
        $query = 'UPDATE Ubc_Academic_Calendar SET academic_calendar_year =?,academic_calendar_term =? WHERE academic_calendar_id =?  ';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss', $academic_calendar_year, $academic_calendar_term, $academic_calendar_id);
        $stmt->execute();

        if ($stmt) {
            $success = $academic_calendar_year . '-' . $academic_calendar_term . " is updated";
        } else {
            //inject alert that task failed
            $err = 'Please Try Again Or Try Later';
        }
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
                    <h3>Class Lists</h3>
                    <ul>
                        <li>
                            <a href="academic_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="academic_dashboard">Academics</a>
                        </li>
                        <li>Class Lists</li>
                    </ul>
                </div>
                <hr>
                <fieldset class="border border-primary p-2">
                    <legend class="w-auto text-primary font-weight-bold">Click On Any Class To Print Class Lists</legend>
                    <div class="card card-body">
                        <div class="d-flex justify-content-center">
                            <a href="academic_print_class_list?class=Class 1" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Class 1 List
                            </a>

                            <a href="academic_print_class_list?class=Class 2" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Class 2 List
                            </a>

                            <a href="academic_print_class_list?class=Class 3" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                                <i class="fas fa-file-download"></i>
                                Class 3 List
                            </a>
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
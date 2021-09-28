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
/* Post Notice */
if (isset($_POST['post_notice'])) {
    $notice_id = $ID;
    $notice_posted_by_id = $_POST['notice_posted_by_id'];
    $notice_details = $_POST['notice_details'];
    $notice_to = $_POST['notice_to'];
    $query =
        'INSERT INTO Ubc_Notices  (notice_id,notice_posted_by_id,notice_details,notice_to ) VALUES (?,?,?,?)';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssss',
        $notice_id,
        $notice_posted_by_id,
        $notice_details,
        $notice_to
    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Notice Posted';
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Update Notice */
if (isset($_POST['update_notice'])) {
    $notice_details = $_POST['notice_details'];
    $notice_to = $_POST['notice_to'];
    $notice_id = $_POST['notice_id'];
    $query =
        'UPDATE  Ubc_Notices  SET notice_details=?, notice_to=? WHERE notice_id =?  ';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sss', $notice_details, $notice_to, $notice_id);
    $stmt->execute();

    if ($stmt) {
        $success = 'Notice Updated';
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Delete Notice */
if (isset($_GET['delete'])) {
    $error = 0;
    $notice_id = $_GET['delete'];
    if (!$error) {
        $sql = "DELETE FROM  Ubc_Notices  WHERE notice_id ='$notice_id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Deleted" && header("refresh:1; url=academic_notices");
        } else {
            $err = "Please Try Again Or Try Later";
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
                    <h3>Notices</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="dashboard">Academics</a>
                        </li>
                        <li>Academic Notices</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-comment-dots"></i>
                        Post Notice
                    </button>
                </div>
                <hr>
                <!-- Add  Modal -->
                <div class="modal left-slide-modal fade" id="add_modal" role="dialog">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Fill All Fields</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="post" enctype="multipart/form-data" class="new-added-form">
                                    <fieldset class="border border-primary p-2">

                                        <legend class="w-auto text-primary font-weight-bold">Notice Details</legend>
                                        <div class="row">
                                            <input type="text" name="notice_posted_by_id" hidden value="<?php
                                                                                                        $staff_id = $_SESSION['staff_id'];
                                                                                                        echo $staff_id;
                                                                                                        ?>" required class="form-control">
                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Audience</label>
                                                <select class="form-control select2" name="notice_to">
                                                    <option Value="Students">Students</option>
                                                    <option value="Staffs">Staffs</option>
                                                    <option value="All">All</option>
                                                </select>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                <label>Message</label>
                                                <textarea type="text" name="notice_details" required rows="10" class="form-control"></textarea>
                                            </div>
                                            <div class="col-12 form-group mg-t-8 text-right">
                                                <button name="post_notice" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Post Notice</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add Staf Modal -->

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Posted By</th>
                                    <th>Posted To</th>
                                    <th>Notice Details</th>
                                    <th>Date Posted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM  Ubc_Notices n
                                 INNER JOIN Ubc_Staff s ON n.notice_posted_by_id = s.staff_id';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($notice = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $notice->staff_number .
                                                ' ' .
                                                $notice->staff_name; ?></td>
                                        <td><?php echo $notice->notice_to; ?></td>
                                        <td><?php echo /* If Long We Truncate */ $notice->notice_details; ?></td>
                                        <td><?php echo date('d, M Y g:ia', strtotime($notice->notice_posted_at)); ?></td>
                                        <td>
                                            <a href="#edit-<?php echo $notice->notice_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <!-- Edit  Modal -->
                                            <div class="modal left-slide-modal fade" id="edit-<?php echo $notice->notice_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Posted Notice</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                <fieldset class="border border-primary p-2">

                                                                    <legend class="w-auto text-primary font-weight-bold">Notice Details</legend>
                                                                    <div class="row">
                                                                        <input type="text" name="notice_id" hidden value="<?php echo $notice->notice_id; ?>" required class="form-control">
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Audience</label>
                                                                            <select class="form-control select2" name="notice_to">
                                                                                <option selected Value="<?php echo $notice->notice_to; ?>"><?php echo $notice->notice_to; ?></option>
                                                                                <option Value="Students">Students</option>
                                                                                <option value="Staffs">Staffs</option>
                                                                                <option value="All">All</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Message</label>
                                                                            <textarea type="text" name="notice_details" required rows="10" class="form-control"><?php echo $notice->notice_details; ?></textarea>
                                                                        </div>
                                                                        <div class="col-12 form-group mg-t-8 text-right">
                                                                            <button name="update_notice" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Notice</button>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->

                                            <a href="#delete-<?php echo $notice->notice_id; ?>" data-toggle="modal" class="radius-30 badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete Staff Confirmation -->
                                            <div class="modal fade" id="delete-<?php echo $notice->notice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete Notice </h4>
                                                            <br>
                                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                                            <a href="academic_notices?delete=<?php echo $notice->notice_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
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
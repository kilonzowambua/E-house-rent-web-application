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
require_once('../config/DataSource.php');
require_once('../vendor/autoload.php');
superadmin_check_login();

/* Add Units */
if (isset($_POST['Add_Unit'])) {

    $unit_id = $ID;
    $unit_code = $_POST['unit_code'];
    $unit_name = $_POST['unit_name'];

    $query =
        'INSERT INTO Ubc_Units (unit_id,unit_code,unit_name) VALUES (?,?,?)';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sss',
        $unit_id,
        $unit_code,
        $unit_name

    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Unit Added';
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Update Units */
if (isset($_POST['Update_Unit'])) {

    $unit_code = $_POST['unit_code'];
    $unit_name = $_POST['unit_name'];
    $unit_id = $_POST['unit_id'];
    $query = 'UPDATE Ubc_Units SET  unit_code=?,unit_name=? WHERE unit_id =?  ';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sss', $unit_code, $unit_name, $unit_id);
    $stmt->execute();

    if ($stmt) {
        $success = "Unit Updated";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Delete Units */
if (isset($_GET['delete'])) {
    $error = 0;
    $unit_id = $_GET['delete'];
    if (!$error) {
        $sql = "DELETE FROM  Ubc_Units  WHERE unit_id ='$unit_id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Unit Removed " && header("refresh:1; url=academic_units");;
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }
}

/* Bulk Import Units */
require_once('../functions/bulk_import_subjects.php');

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
                    <h3>Units / Subjects</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="dashboard">Academics</a>
                        </li>
                        <li>Subjects</li>
                    </ul>
                </div>
                <div class="text-right">
                    <button type="button" class="modal-trigger btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#bulk_import">
                        <i class="fas fa-file-import"></i>
                        Bulk Import Subjects
                    </button>
                    <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue" data-toggle="modal" data-target="#add_modal">
                        <i class="fas fa-book-open"></i>
                        Add Subject
                    </button>
                </div>
                <hr>
                <!-- Bulk Import Modals -->
                <div class="modal left-slide-modal fade" id="bulk_import" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Bulk Import Units</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-bold">Allowed File Types: XLS, XLSX. Please, <a class="text-danger" href="../public/Data/system_data/xls_templates/Units_Template.xlsx">Download</a> A Template File. </legend>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputFile">Select File</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input required name="file" accept=".xls,.xlsx" type="file" class="custom-file-input">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="upload" class="radius-30 btn-fill-lg btn-gradient-yellow">Upload File</button>
                                        </div>
                                        <br>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Bulk Import -->

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
                                <fieldset class="border border-primary p-2">
                                    <legend class="w-auto text-primary font-weight-bold">Unit / Subject Information</legend>
                                    <form method="post" enctype="multipart/form-data" class="new-added-form">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Subject / Unit Code</label>
                                                <input type="text" name="unit_code" required class="form-control">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                <label>Subject Name</label>
                                                <input type="text" name="unit_name" required class="form-control">
                                            </div>
                                            <div class="col-12 form-group mg-t-8 text-right">
                                                <button name="Add_Unit" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Subject / Unit</button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add Staf Modal -->

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>Unit / Subject Code</th>
                                    <th>Unit / Subject Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM  Ubc_Units ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($units = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $units->unit_code; ?></td>
                                        <td><?php echo $units->unit_name; ?></td>
                                        <td>
                                            <a href="#edit-<?php echo $units->unit_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <!-- Edit Staff Modal -->
                                            <div class="modal left-slide-modal fade" id="edit-<?php echo $units->unit_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update <?php echo $units->unit_name; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset class="border border-primary p-2">
                                                                <legend class="w-auto text-primary font-weight-bold">Unit / Subject Information</legend>
                                                                <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Subject / Unit Code</label>
                                                                            <input type="text" name="unit_code" value="<?php echo $units->unit_code; ?>" required class="form-control">
                                                                            <input type="text" hidden name="unit_id" value="<?php echo $units->unit_id; ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                                            <label>Subject Name</label>
                                                                            <input type="text" name="unit_name" value="<?php echo $units->unit_name; ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="col-12 form-group mg-t-8 text-right">
                                                                            <button name="Update_Unit" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Update Subject / Unit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->

                                            <a href="#delete-<?php echo $units->unit_id; ?>" data-toggle="modal" class="radius-30 badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete Staff Confirmation -->
                                            <div class="modal fade" id="delete-<?php echo $units->unit_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete <?php echo $units->unit_code .
                                                                            '-' .
                                                                            $units->unit_name; ?> ? </h4>
                                                            <p>Heads Up, You are about to delete <?php echo $units->unit_code .
                                                                                                        '-' .
                                                                                                        $units->unit_name; ?> details. This action is irrevisble.</p>
                                                            <button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green" data-dismiss="modal">No</button>
                                                            <a href="academic_units?delete=<?php echo $units->unit_id; ?>" class="text-center btn-fill-lmd radius-30 text-light shadow-red bg-red">
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
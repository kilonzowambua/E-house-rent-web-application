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


/* Add Existing Fee */
if (isset($_POST['Add_Exisiting_Fee'])) {

    $student_id = $_POST['student_id'];
    $student_additional_fee = str_replace(',', '', ($_POST['student_additional_fee']));


    $query = 'UPDATE  Ubc_Student SET student_additional_fee = ? WHERE student_id =?  ';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ss',
        $student_additional_fee,
        $student_id
    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Existing Fee Added';
    } else {
        $err = 'Please Try Again Or Try Later';
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
                    <h3>Finances</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Finances</a>
                        </li>
                        <li>Existing Fee </li>
                    </ul>
                </div>

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Admission No</th>
                                    <th>Academic Level</th>
                                    <th>Existing Fee Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM  Ubc_Student ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($students = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td>
                                            <a href="student_profile?view=<?php echo $students->student_id; ?>">
                                                <?php echo $students->student_admission_no; ?>
                                            </a>
                                            <br>
                                            <?php echo $students->student_name; ?>
                                        </td>
                                        <td><?php echo $students->student_academic_level; ?></td>
                                        <td>
                                            <?php
                                            if ($students->student_additional_fee != '') {
                                                echo "KSh " . $students->student_additional_fee;
                                            } else {
                                                echo "Ksh 0";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="#additional-<?php echo $students->student_id; ?>" data-toggle="modal" class="radius-30 badge badge-warning">
                                                <i class="fas fa-user-edit"></i>
                                                Add Existing Fees
                                            </a>
                                            <div class="modal left-slide-modal fade" id="additional-<?php echo $students->student_id; ?>" role="dialog">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Add Existing Fee To : <?php echo $students->student_name; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data" class="new-added-form">
                                                                <fieldset class="border border-primary p-2">
                                                                    <legend class="w-auto text-primary font-weight-bold">Existing Fee Balances </legend>
                                                                    <div class="row">
                                                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                                            <label>Existing / Additional Fee Amount (Ksh)</label>
                                                                            <input type="text" required name="student_additional_fee" value="<?php echo $students->student_additional_fee; ?>" required class="form-control">
                                                                            <input type="hidden" required name="student_id" value="<?php echo $students->student_id; ?>" required class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <div class="col-12 form-group mg-t-8 text-right">
                                                                    <button name="Add_Exisiting_Fee" type="submit" class="radius-30 btn-fill-lg btn-gradient-yellow">Add Existing Fee</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                        </td>
                                    </tr>
                                <?php
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
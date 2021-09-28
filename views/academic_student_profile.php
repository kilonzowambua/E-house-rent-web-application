<?php
/*
 * Created on Fri Aug 27 2021
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
superadmin_check_login();
/* Update Student Profile Picture  */

/* Update Student Password*/
if (isset($_POST['Change_Password'])) {
    $mailed_password = $_POST['new_password'];
    $hashed_password = sha1(md5($mailed_password));
    $user_email = $_POST['user_email'];
    $view = $_GET['view'];

    $query = 'UPDATE Ubc_Student SET  student_password =? WHERE student_id =?  ';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ss', $hashed_password, $view);
    $stmt->execute();
    /* Mail User */
    require_once('../mailers/update_password_mailer.php');
    if ($stmt && $mail->send()) {
        $success = "Student Password Reset";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}
require_once('../partials/head.php');


/*Update student profile */
if (isset($_POST['Update_Profile_Pic'])) {

    $temp = explode('.', $_FILES['student_profile']['name']);
    $newfilename = 'Student' . (round(microtime(true)) . '.' . end($temp));
    move_uploaded_file(
        $_FILES['student_profile']['tmp_name'],
        '../public/img/studentavatars/' . $newfilename
    );
    $student_admission_no = $_POST['student_admission_no'];

    $query =
        "UPDATE  Ubc_Student SET
 
 student_profile =?
    
    WHERE
    student_admission_no=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ss',

        $newfilename,
        $student_admission_no
    );
    $stmt->execute();

    if ($stmt) {
        $success = 'Students profile image update';
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}



?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once('../partials/academic_header.php'); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once('../partials/academic_sidebar.php');
            $view = $_GET['view'];
            $ret = "SELECT * FROM  Ubc_Student s
            INNER JOIN Ubc_Academic_Calendar ac ON s.student_academic_caledar_id = ac.academic_calendar_id
             WHERE s.student_id = '$view' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($student = $res->fetch_object()) {
                /* Passport */
                if ($student->student_profile != '') {
                    $dir = "../public/img/studentavatars/$student->student_profile";
                } else {
                    $dir = "../public/img/studentavatars/default.png";
                }
            ?>
                <!-- Sidebar Area End Here -->
                <div class="dashboard-content-one">
                    <!-- Breadcubs Area Start Here -->
                    <div class="breadcrumbs-area">
                        <h3><?php echo $student->student_name; ?> Profile</h3>
                        <ul>
                            <li>
                                <a href="academic_dashboard">Home</a>
                            </li>
                            <li>Search Result</li>
                        </ul>
                    </div>
                    <!-- Breadcubs Area End Here -->
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card account-settings-box">
                                <div class="card-body">
                                    <div class="heading-layout1 mg-b-20">
                                        <div class="item-title">
                                            <h3></h3>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button id="print" onclick="printContent('Print_Details');" class="dropdown-item"><i class="fas fa-print text-orange-peel"></i>Print</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="Print_Details">
                                        <div class="user-details-box">
                                            <div class="item-img text-center">
                                                <img src="<?php echo $dir; ?>" alt="user">
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="item-content">
                                                        <fieldset class="border border-primary p-3">
                                                            <legend class="w-auto text-primary font-weight-bold"><?php echo $student->student_name; ?> Personal Information</legend>
                                                            <div class="info-table table-responsive">
                                                                <table class="table text-nowrap">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Full Name:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Gender:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_gender; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>D.O.B:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_dob; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>National ID No:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_national_id; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Mobile Phone No:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_phone_no; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_email; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Address:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_address; ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="item-content">
                                                        <fieldset class="border border-primary p-3">
                                                            <legend class="w-auto text-primary font-weight-bold"><?php echo $student->student_name; ?> Parent's Information</legend>
                                                            <div class="info-table table-responsive">
                                                                <table class="table text-nowrap">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Father Name:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_father_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Father Contacts:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_father_phone; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Father ID No:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_father_national_id; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Mother Name:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_mother_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Mother Contacts:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_mother_phone; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Mother ID No:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_mother_idno; ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="item-content">
                                                        <fieldset class="border border-primary p-3">
                                                            <legend class="w-auto text-primary font-weight-bold"><?php echo $student->student_name; ?> Church Information</legend>
                                                            <div class="info-table table-responsive">
                                                                <table class="table text-nowrap">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Area:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_area; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Region:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_region; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>DCC:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_dcc; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Local Church:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_local_church; ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="item-content">
                                                        <fieldset class="border border-primary p-3">
                                                            <legend class="w-auto text-primary font-weight-bold"><?php echo $student->student_name; ?> Academic Details</legend>
                                                            <div class="info-table table-responsive">
                                                                <table class="table text-nowrap">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Admission Number:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_admission_no; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Date Admitted:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo date('d M Y', strtotime($student->student_date_admitted)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Academic Year & Term Admitted:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->academic_calendar_year . ' - ' . $student->academic_calendar_term; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Academic Level:</td>
                                                                            <td class="font-medium text-dark-medium"><?php echo $student->student_academic_level; ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Account Settings Area End Here -->
                    <?php require_once('../partials/footer.php'); ?>
                </div>
            <?php } ?>
        </div>
        <!-- Page Area End Here -->
    </div>
    <?php require_once('../partials/scripts.php'); ?>

</body>


</html>
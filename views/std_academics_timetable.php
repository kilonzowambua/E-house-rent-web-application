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
                    <h3>Academics</h3>
                    <ul>
                        <li>
                            <a href="std_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="">Academic</a>
                        </li>
                        <li>Timetable</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="text-right">
                    <a href="std_academics_timetable_download" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">
                        <i class="fas fa-file-download"></i>
                        Download Time Table
                    </a>
                </div>
                <hr>

                <!-- Dashboard Content Start Here -->
                <div class="row gutters-20">
                    <div class="col-lg-12 col-xl-12 col-4-xxxl">
                        <div class="card dashboard-card-six pd-b-20">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Time</th>
                                                <th>Unit Details</th>
                                                <th>Teacher</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $student_id  = $_SESSION['student_id'];
                                            $ret =
                                                "SELECT * FROM Ubc_Timetable t INNER JOIN Ubc_Teaching_Allocations a ON a.teaching_allocation_id = t.timetable_allocation_id
                                        INNER JOIN Ubc_Academic_Calendar ac ON a.teaching_allocation_academic_calendar_id = ac.academic_calendar_id
                                        INNER JOIN Ubc_Staff s ON  s.staff_id = a.teaching_allocation_staff_id
                                        INNER JOIN Ubc_Units u ON u.unit_id = a.teaching_allocation_unit_id 
                                        INNER JOIN Ubc_Student st ON st.student_academic_level = a.teaching_allocation_class_name 
                                        WHERE st.student_id = '$student_id'  AND ac.academic_calendar_status = 'Current'
                                        ORDER BY t.timetable_class_time ASC ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($timetable = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $timetable->timetable_day; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($timetable->timetable_class_time == '1') {
                                                            echo "8:00 - 8:55 AM";
                                                        } elseif ($timetable->timetable_class_time == '2') {
                                                            echo "9:00 - 9:55 AM";
                                                        } elseif ($timetable->timetable_class_time == '5') {
                                                            echo "11:00 - 11:55 AM";
                                                        } elseif ($timetable->timetable_class_time == '6') {
                                                            echo "12:00 - 12:55 PM";
                                                        } elseif ($timetable->timetable_class_time == '8') {
                                                            echo "2:00 - 2:55 PM";
                                                        } elseif ($timetable->timetable_class_time == '9') {
                                                            echo "3:00 - 3:55 PM";
                                                        } elseif ($timetable->timetable_class_time == '10') {
                                                            echo "4:00 - 4:55 PM";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $timetable->unit_code . ' ' . $timetable->unit_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $timetable->staff_name; ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
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
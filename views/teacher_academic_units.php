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
staff_checklogin();



require_once '../partials/head.php';
?>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once '../partials/teacher_header.php'; ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once '../partials/teacher_sidebar.php'; ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Units / Subjects Allocated</h3>
                    <ul>
                        <li>
                            <a href="teacher_dashboard">Home</a>
                        </li>
                        <li>
                            <a href="teacher_dashboard">Academics</a>
                        </li>
                        <li>Subjects allocated</li>
                    </ul>
                </div>
                
                <hr>


               

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>Unit / Subject Code</th>
                                    <th>Unit / Subject Name</th>
                                    <th>Class</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $staff_id = $_SESSION['staff_id'];
                                $ret = "SELECT * FROM  Ubc_Teaching_Allocations ta
                                INNER JOIN Ubc_Units u ON u.unit_id = ta.teaching_allocation_unit_id
                                INNER JOIN Ubc_Academic_Calendar ac ON ac.academic_calendar_id = ta.teaching_allocation_academic_calendar_id
                                INNER JOIN Ubc_Staff st ON st.staff_id = ta.teaching_allocation_staff_id
                                WHERE st.staff_id ='$staff_id' AND ac.academic_calendar_status ='Current'
                                 ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($units = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $units->unit_code; ?></td>
                                        <td><?php echo $units->unit_name; ?></td>
                                        <td><?php echo $units->teaching_allocation_class_name; ?></td>
                                       
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
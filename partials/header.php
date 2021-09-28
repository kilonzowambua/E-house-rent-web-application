<?php
/*
 * Created on Wed Aug 25 2021
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

$staff_id = $_SESSION['staff_id'];
$ret = "SELECT * FROM  Ubc_Staff WHERE staff_id = '$staff_id' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($super_admin = $res->fetch_object()) {
    /* Passport */
    if ($super_admin->staff_profile_image != '') {
        $dir = "../public/img/staff avatars/$super_admin->staff_profile_image";
    } else {
        $dir = "../public/Data/user_data/images/no-profile.png";
    }
?>
    <div class="navbar navbar-expand-md header-menu-one bg-light">
        <div class="nav-bar-header-one">
            <div class="header-logo">
                <a href="dashboard">
                    <img src="../public/img/logo_preloader.png" width="70" height="70" alt="logo">
                </a>
            </div>
            <div class="toggle-button  sidebar-toggle">
                <button type="button" class=" item-link">
                    <span class=" btn-icon-wrap">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="d-md-none mobile-nav-bar">
            <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                <i class="far fa-arrow-alt-circle-down"></i>
            </button>
            <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
            <ul class="navbar-nav">
                <form method="get" action="student_search_result">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" name="query" class="form-control" placeholder="Enter Student Admission . . .">
                        </div>
                    </li>
                </form>
            </ul>
            <ul class="navbar-nav">


                <li class="navbar-item dropdown header-notification">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                        <span>1</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">01 Notifiacations</h6>
                        </div>
                        <div class="item-content">
                            <div class="media">
                                <div class="item-icon bg-skyblue">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="media-body space-sm">
                                    <div class="post-title">Complete Today Task</div>
                                    <span>1 Mins ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="navbar-item dropdown header-admin">
                    <a class="navbar-nav-link " href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <div class="admin-title">
                            <h5 class="item-title"><?php echo $super_admin->staff_name; ?></h5>
                            <span><?php echo $super_admin->staff_number; ?></span>
                        </div>
                        <div class="admin-img">
                            <img height="50" width="50" src="<?php echo $dir; ?>" alt="Admin">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">Hello, <?php echo $super_admin->staff_name; ?></h6>
                        </div>
                        <div class="item-content">
                            <ul class="settings-list">
                                <li><a href="profile"><i class="flaticon-user"></i>My Profile</a></li>
                                <li><a href="profile_settings"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                <li><a href="change_password"><i class="flaticon-settings-work-tool"></i>Change Password</a></li>
                                <li><a href="logout"><i class="flaticon-turn-off"></i>Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>
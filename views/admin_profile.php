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
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/admin_analytics.php');

user_check_login();
?>
<!doctype html>

<html class="no-js" lang="en">
<?php 
include('../partials/head.php');
?>
<body>
<!-- Left Panel -->
<?php 
include('../partials/Left Panel.php');
?>
<?php 
include('../partials/Right Panel.php');

?>
<?php
$user_email = $_SESSION['user_email'];
  $ret = "SELECT * FROM user WHERE user_email ='$user_email'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($row = $res->fetch_object()) {
   
    if ($row->user_profile != '') {
        $url = "../public/images/avatar/$row->user_profile";
    } else {
        $url = "../public/images/avatar/no-profile.png";
    }

  ?>
     <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <div class="animated fadeIn">
        <div class="row">
        <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" src="<?php echo $url ?>" alt="Card image cap">
                                    <h5 class="text-sm-center mt-2 mb-1"><?php echo $row->user_name ?></h5>
                                    <div class="location text-sm-center"><i class="fa fa-suitcase"></i> <?php echo $row->user_access ?></div>
                                </div>
                                <hr>
                                
                                <div class="card-text text-sm-center">
                                <strong class="card-title mb-3">Generate StaffID</strong>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                   
                   
                    </div><!-- .row -->
            </div><!-- .animat
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <?php 
}
include('../partials/script.php');

?>
</body>

</html>
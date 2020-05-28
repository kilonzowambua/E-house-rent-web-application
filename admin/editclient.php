<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>
<div class="main-content">
<?php
$cid=$_GET['cid'];
				if(isset($_POST['update'])){
							include 'includes/config.php';
							$fname = $_POST['fname'];
							$mname = ($_POST['mname']);
							$lname= $_POST['lname'];
							$age= ($_POST['age']);
						  $email = $_POST['email'];
                          $query="update client set fname=?,mname=?,lname=?, age=?, email=? where cid=?";
                          $stmt = $conn->prepare($query);
                          $rc=$stmt->bind_param('sssssi', $fname,$lname,$mname, $age, $email , $cid);
                          $stmt->execute();
                          echo"<script>alert('Client detail  Has Been Updated Successfully');</script>";
                          }
                          ?>	
							
							
							

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       
                    <?php	

$ret="select * from client where cid=?";

$stmt= $conn->prepare($ret) ;
 $stmt->bind_param('i',$cid);
 $stmt->execute() ;//ok
 $res=$stmt->get_result();
 //$cnt=1;
   while($row=$res->fetch_object())
   {
       ?>
                                <div class="card">
                                    <div class="card-header">User update Form</div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">First name</div>
                                                    <input type="text" value="<?php echo $row->fname;?>" id="username3" name="fname" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Middlename</div>
                                                    <input type="text" value="<?php echo $row->mname;?>"id="username3" name="mname" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Last name</div>
                                                    <input type="text" id="username3"value="<?php echo $row->lname;?>" name="lname" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Age</div>
                                                    <input type="date" id="username3" value="<?php echo $row->age;?>" name="age" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Email</div>
                                                    <input type="email" id="email3" value="<?php echo $row->email;?>"name="email" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="form-actions form-group">
                                                <input type="submit" class="btn btn-primary btn-sm" value="Update" name="update" data-toggle="modal" data-target="#mediumModal">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
   <?php } ?>
                          
                            <div class="copyright">
                                    <p>Copyright © 2019 E-house rental. All rights reserved. System by <a href="https://Kilonzowambua.github.io">Kilodev</a>.</p>
                                </div>
                            </div>
                    

                               <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->

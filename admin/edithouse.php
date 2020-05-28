<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>
<div class="main-content">
<?php
$hid=$_GET['hid'];
				if(isset($_POST['update'])){
							include 'includes/config.php';
							$housename = $_POST['housename'];
							$housetype = ($_POST['housetype']);
							$location= $_POST['location'];
                            $cost= ($_POST['cost']);
                            $image=$_FILES["image"]["name"];
                            move_uploaded_file($_FILES["image"]["tmp_name"],"../client/images/".$_FILES["image"]["name"]);
						 
                          $query="update house set housename=?,housetype=?,location=?, cost=?, image=? where hid=?";
                          $stmt = $conn->prepare($query);
                          $rc=$stmt->bind_param('sssssi', $housename,$housetype,$location, $cost, $image , $hid);
                          $stmt->execute();
                          echo"<script>alert('House detail  Has Been Updated Successfully');</script>";
                          }
                          ?>	
							
							
							

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       
                    <?php	

$ret="select * from house where hid=?";

$stmt= $conn->prepare($ret) ;
 $stmt->bind_param('i',$hid);
 $stmt->execute() ;//ok
 $res=$stmt->get_result();
 //$cnt=1;
   while($row=$res->fetch_object())
   {
       ?>
                                <div class="card">
                                    <div class="card-header">House update Form</div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">House name</div>
                                                    <input type="text" value="<?php echo $row->housename;?>" id="username3" name="housename" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">House type</div>
                                                    <input type="text" value="<?php echo $row->housetype;?>"id="username3" name="housetype" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Location</div>
                                                    <input type="text" id="username3"value="<?php echo $row->location;?>" name="location" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Cost</div>
                                                    <input type="text" id="username3" value="<?php echo $row->cost;?>" name="cost" class="form-control">
                                                    <div class="input-group-addon">
                                                    <i class="fa fa-usd" aria-hidden="true"></i>

  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-multiple-input" class=" form-control-label">House image</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-multiple-input" name="image" multiple="" class="form-control-file">
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

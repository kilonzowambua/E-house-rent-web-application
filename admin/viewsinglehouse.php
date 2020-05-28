       <?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>
<div class="main-content">
<?php	
$hid=$_GET['hid'];
$ret="select * from house where hid=?";

$stmt= $conn->prepare($ret) ;
 $stmt->bind_param('i',$hid);
 $stmt->execute() ;//ok
 $res=$stmt->get_result();
 //$cnt=1;
   while($row=$res->fetch_object())
   {
       ?>
      <img src="../client/images/<?php echo $row->image;?>" class="rounded mx-auto d-block" alt="Responsive image">
   
   <h1>      House name:<?php echo $row->housename;?>
         <br>
         Location:<?php echo $row->location;?>
         <br>
         Cost:Ksh <?php echo $row->cost;?></h1>
         <?php } ?>
                                <!-- END DATA TABLE-->
                            </div>
                                            </div>

                                       

                                    </section>
                                </aside>
                            </div>

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
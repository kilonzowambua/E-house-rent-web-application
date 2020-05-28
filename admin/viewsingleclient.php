       <?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>
<div class="main-content">
<?php	
$cid=$_GET['cid'];
$ret="select * from client where cid=?";

$stmt= $conn->prepare($ret) ;
 $stmt->bind_param('i',$cid);
 $stmt->execute() ;//ok
 $res=$stmt->get_result();
 //$cnt=1;
   while($row=$res->fetch_object())
   {
       ?>
         <div class="col-lg-12">
                                <aside class="profile-nav alt">
                                    <section class="card">
                                        <div class="card-header user-header alt bg-dark">
                                            <div class="media">
                                                <a href="#">
                                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="../client/images/<?php echo $row->photo;?>">
                                                </a>
                                                <div class="media-body">
                                                    <h2 class="text-light display-6"><?php echo $row->fname;?> <?php echo $row->lname;?></h2>
                                                    <p>E-mail:<?php echo $row->email;?></p>
                                                </div>
                                            </div>
                                        </div>
   <?php } ?>
                                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                   <h1> Current house rented records</h1>
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>House name</th>
                                                <th>House type</th>
                                                <th>Cost</th>
                                                <th>Rented no</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	

$ret="select * from request where userid=?";

$stmt= $conn->prepare($ret) ;
 $stmt->bind_param('i',$cid);
 $stmt->execute() ;//ok
 $res=$stmt->get_result();
 //$cnt=1;
   while($row=$res->fetch_object())
   {
       ?>
                                                                                    <tr>
                                                <td><?php echo $row->housename;?></td>
                                                <td><?php echo $row->housetype;?></td>
                                                <td><?php echo $row->cost;?></td>
                                                <td><?php echo $row->rdate;?></td>
                                               
    </tr>
            
   <?php } ?>                             
                                         
                                        </tbody>
                                    </table>
                                </div>
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
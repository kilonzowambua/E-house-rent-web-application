<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>House image</th>
                                                <th>House name</th>
                                                <th>House type</th>
                                                <th>Location</th>
                                                <th>Cost</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	

	$ret="select * from house";
	
	$stmt= $conn->prepare($ret) ;
	 //$stmt->bind_param('i',$cid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
       {
           ?>
                                            <tr>
                                                <td><div class="image img-cir img-40">
                                                    <img src="../client/images/<?php echo $row->image;?>" alt="Diane Myers" />
                                                </div></td>
                                                <td><?php echo $row->housename;?></td>
                                                <td><?php echo $row->housetype;?></td>
                                                <td><?php echo $row->location;?></td>
                                                <td><?php echo $row->cost;?></td>
                                                
                                            </tr>
       <?php } ?>     
                                           
                                         
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="copyright">
                                    <p>Copyright © 2019 E-house rental. All rights reserved. System by <a href="https://Kilonzowambua.github.io">Kilodev</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

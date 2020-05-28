<?php include('includes/header.php');?>
<?php
if(isset($_POST['book']))
{
	$cid=$_SESSION['cid'];
    $hid=$_GET['hid'];
	$housename=$_POST['housename'];
	$housetype=$_POST['housetype'];
	$cost=$_POST['cost'];
    $location=$_POST['location'];
          $query="insert into request (userid,houseid ,housename, housetype,cost ,location) values(?,?,?,?,?,?)";
	  $stmt = $conn->prepare($query);
	  $rc=$stmt->bind_param('ssssss',$cid,$hid,$housename,$housetype,$cost,$location);
	  $stmt->execute();
	  echo"<script>alert('Successfully rentaled!!Wait for approval');</script>";
	  }
	  ?> 
<?php include('includes/navbar.php');?>




    

        <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
  		<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="index.php">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Book rental house</span>
				</h2>
		    </div>
		<!--//banner-->
		<!--content-->
		<div class="content-top">
        <div class="grid-form">
 		<div class="grid-form1">
		 <h3 id="forms-example" class="">House detail</h3>
		 
 		
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
		  <form role="form" method="post" enctype="multipart/form-data"> 
  <div class="form-group">
  <img src="images/<?php echo $row->image;?>" class="img-circle" alt="Responsive image">
    <label for="exampleInputEmail1">House name:</label>
    <input type="text" name="housename" class="form-control" id="exampleInputEmail1" value="<?php echo $row->housename;?>">
  </div>
  <div class="form-group">
 
    <label for="exampleInputEmail1">House type:</label>
    <input type="text" name="housetype" class="form-control" id="exampleInputEmail1" value="<?php echo $row->housetype;?>">
  </div>
  <div class="form-group">
  
    <label for="exampleInputEmail1">Locations:</label>
    <input type="text" name="location" class="form-control" id="exampleInputEmail1" value="<?php echo $row->location;?>">
  </div>
  <div class="form-group">
  
    <label for="exampleInputEmail1">Cost:</label>
    <input type="text" name="cost" class="form-control" id="exampleInputEmail1" value="<?php echo $row->cost;?>">
  </div>
  <input type="submit" name="book" value="Rental now" class="btn btn-primary">
  
  <?php } ?>
</form>
</div>
 	 	</div>
 	 
 	 	
 	 	 <div class="clearfix"> </div>
 	 </div>
	<!--//gallery-->
		<!---->
<div class="copy">
            <p> &copy; 2019 e-house rental. All Rights Reserved | Design by <a href="https://kilonzowambua.github.io" target="_blank">Kilodev</a> </p>	    </div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     
<!---->
<link rel="stylesheet" href="css/swipebox.css">
	<script src="js/jquery.swipebox.min.js"></script> 
	    <script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
</script>
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
</body>
</html>
			

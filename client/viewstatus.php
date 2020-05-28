<?php include('includes/header.php');?>

<?php include('includes/navbar.php');?>




    

        <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
  		<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="index.php">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Book rental status</span>
				</h2>
		    </div>
		<!--//banner-->
		<!--content-->
		<div  id='printTable'>
		<h1 class="text-center"><u><b>E-house rental system<b></u></h1>
			<h2><i>Recite for your rental</u></h2>
		<table class="table">
		<thead class="thead-dark">
  <span class="border border-light">
  <tr class="thead-dark">
	   
	  <th scope="col">Date/time rental</th>
      <th scope="col">Housecode</th>
      <th scope="col">Clientid</th>
	  <th scope="col">status</th>
	  <th scope="col">Print</th>
    </tr>
  </thead>
  <tbody>
     <?php	
	$userid=$_SESSION['cid'];
	$ret="select * from request where userid=?";
	
	$stmt= $conn->prepare($ret) ;
	 $stmt->bind_param('i',$userid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
       {
           ?>
     <tr class="bg-warning">
	  <td><?php echo $row->rdate;?></td>
      <td><?php echo $row->houseid;?></td>
      <td><?php echo $row->userid;?></td>
      <td><?php echo $row->status;?></td>
      <td><a href="#null" onclick="printContent('printTable')">Click to print recite</a></td>
      <td>
    </tr>
	<?php }?>
  </tbody>
	   </span>
	   
</table>
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
	<script type="text/javascript">
<!--
function printContent(id){
str=document.getElementById(id).innerHTML
newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
newwin.document.write('<HTML>\n<HEAD>\n')
newwin.document.write('<TITLE>Print Page</TITLE>\n')
newwin.document.write('<script>\n')
newwin.document.write('function chkstate(){\n')
newwin.document.write('if(document.readyState=="complete"){\n')
newwin.document.write('window.close()\n')
newwin.document.write('}\n')
newwin.document.write('else{\n')
newwin.document.write('setTimeout("chkstate()",2000)\n')
newwin.document.write('}\n')
newwin.document.write('}\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('chkstate();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write(str)
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}
//-->
</script>
	<!--//scrolling js-->
	
</body>
</html>
			

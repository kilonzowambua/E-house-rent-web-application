<?php include('includes/header.php');?>
<body>
<div id="wrapper">

        <nav class="navbar-default navbar-static-top" role="navigation">
		<?php	
	$cid=$_SESSION['cid'];
	$ret="select * from client where cid=?";
	
	$stmt= $conn->prepare($ret) ;
	 $stmt->bind_param('i',$cid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
       {
           ?>
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.php">E-house rental</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section>
			<form class=" navbar-left-right">
              <input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
              <input type="submit" value="" class="fa fa-search">
            </form>
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="drop-men" >
		        <!--    <ul class=" nav_1">
		           
		    		<li class="dropdown at-drop">
		              <a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i class="fa fa-globe"></i> <span class="number">5</span></a>
		              <ul class="dropdown-menu menu1 " role="menu">
		                <li><a href="#">
		               
		                	<div class="user-new">
		                	<p>New user registered</p>
		                	<span>40 seconds ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-user-plus"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                	</a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>Someone special liked this</p>
		                	<span>3 minutes ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-heart"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>John cancelled the event</p>
		                	<span>4 hours ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-times"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>The server is status is stable</p>
		                	<span>yesterday at 08:30am</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-info"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>New comments waiting approval</p>
		                	<span>Last Week</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-rss"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#" class="view">View all messages</a></li>
		              </ul>
		            </li>-->
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo $row->fname;?><i class="caret"></i></span><img src="images/<?php echo $row->photo;?>"></a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="profile.php"><i class="fa fa-user"></i>Edit Profile</a></li>
		                <li><a href="calendar.html"><i class="fa fa-calendar"></i>Calender</a></li>
		                <li><a href="logout.php"><i class="fa fa-close"></i>Quit</a></li>
		              </ul>
		            </li>
		           
		        </ul>
		     </div><!-- /.navbar-collapse -->
			<div class="clearfix">
       
     </div>
	  
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
				
                    <li>
                        <a href="index.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                    </li>
                    <li>
                        <a href="profile.php" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon "></i><span class="nav-label">Profile</span> </a>
                    </li>
                    <li>
                        <a href="house.php" class=" hvr-bounce-to-right"><i class="fa fa-home nav_icon"></i> <span class="nav-label">All House</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="house.php" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>rental house</a></li>
                            
                   <li><a href="viewstatus.php" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>View rental status</a></li>
			
					<!--	<li><a href="typography.html" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Typography</a></li>-->

					   </ul>
                    </li>
					       <!--  <li>
                        <a href="inbox.html" class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> <span class="nav-label">Inbox</span> </a>
                    </li>
                    
                    <li>
                        <a href="gallery.html" class=" hvr-bounce-to-right"><i class="fa fa-picture-o nav_icon"></i> <span class="nav-label">Gallery</span> </a>
                    </li>
                     <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-desktop nav_icon"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="404.html" class=" hvr-bounce-to-right"> <i class="fa fa-info-circle nav_icon"></i>Error 404</a></li>
                            <li><a href="faq.html" class=" hvr-bounce-to-right"><i class="fa fa-question-circle nav_icon"></i>FAQ</a></li>
                            <li><a href="blank.html" class=" hvr-bounce-to-right"><i class="fa fa-file-o nav_icon"></i>Blank</a></li>
                       </ul>
                    </li>
                     <li>
                        <a href="layout.html" class=" hvr-bounce-to-right"><i class="fa fa-th nav_icon"></i> <span class="nav-label">Grid Layouts</span> </a>
                    </li>
                   
                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-list nav_icon"></i> <span class="nav-label">Forms</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="forms.html" class=" hvr-bounce-to-right"><i class="fa fa-align-left nav_icon"></i>Basic forms</a></li>
                            <li><a href="validation.html" class=" hvr-bounce-to-right"><i class="fa fa-check-square-o nav_icon"></i>Validation</a></li>
                        </ul>
                    </li>
                   
                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="signin.htl" class=" hvr-bounce-to-right"><i class="fa fa-sign-in nav_icon"></i>Signin</a></li>
                            <li><a href="signup.html" class=" hvr-bounce-to-right"><i class="fa fa-sign-in nav_icon"></i>Singup</a></li>
                        </ul>
                    </li>-->
                </ul>
            </div>
			</div>
	   <?php } ?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
  		<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="index.php">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Dashboard</span>
				</h2>
		    </div>
		<!--//banner-->
		<!--content-->
		<div class="content-top">
			
			
			<div class="col-md-4 ">
				<div class="content-top-1">
				<div class="col-md-6 top-content">
				<h5>Our client</h5>
				<?php

				$sql = $conn->query("SELECT COUNT(*) FROM client");
$row = $sql->fetch_row();
$count = $row[0];
?>	
					
					<label><?php echo $count ;?></label>
				
				
				</div>
				
				 <div class="clearfix"> </div>
				</div>
				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>House available</h5>
					<?php

				$sql = $conn->query("SELECT COUNT(*) FROM house where status='Vacant'");
$row = $sql->fetch_row();
$count1 = $row[0];
?>	
					<label><?php echo $count1 ; ?></label>
				</div>
				<div class="col-md-6 top-content1">	
				<?php

$sql = $conn->query("SELECT COUNT(*) FROM house");
$row = $sql->fetch_row();
$count2 = $row[0];
?>	
<?php 
$precent=$count1/$count2*100;
	?>				
<div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $precent; ?>"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
				<!--<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Cards</h5>
					<label>3401</label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-3" class="pie-title-center" data-percent="75"> <span class="pie-value"></span> </div>
				</div>-->
				 <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-8 content-top-2">
				<!---start-chart---->
				<!----->
				<div class="content-graph">
				<div class="content-color">
					<div class="content-ch"><p><i></i>Chrome </p><span>100%</span>
					<div class="clearfix"> </div>
					</div>
					<div class="content-ch1"><p><i></i>Safari</p><span> 50%</span>
					<div class="clearfix"> </div>
					</div>
				</div>
				<!--graph-->
		<link rel="stylesheet" href="css/graph.css">
		<!--//graph-->
							<script src="js/jquery.flot.js"></script>
									<script>
									$(document).ready(function () {
									
										// Graph Data ##############################################
										var graphData = [{
												// Visits
												data: [ [6, 1300], [7, 1600], [8, 1900], [9, 2100], [10, 2500], [11, 2200], [12, 2000], [13, 1950], [14, 1900], [15, 2000] ],
												color: '#999999'
											}, {
												// Returning Visits
												data: [ [6, 500], [7, 600], [8, 550], [9, 600], [10, 800], [11, 900], [12, 800], [13, 850], [14, 830], [15, 1000] ],
												color: '#999999',
												points: { radius: 4, fillColor: '#7f8c8d' }
											}
										];
									
										// Lines Graph #############################################
										$.plot($('#graph-lines'), graphData, {
											series: {
												points: {
													show: true,
													radius: 5
												},
												lines: {
													show: true
												},
												shadowSize: 0
											},
											grid: {
												color: '#7f8c8d',
												borderColor: 'transparent',
												borderWidth: 20,
												hoverable: true
											},
											xaxis: {
												tickColor: 'transparent',
												tickDecimals: 2
											},
											yaxis: {
												tickSize: 1000
											}
										});
									
										// Bars Graph ##############################################
										$.plot($('#graph-bars'), graphData, {
											series: {
												bars: {
													show: true,
													barWidth: .9,
													align: 'center'
												},
												shadowSize: 0
											},
											grid: {
												color: '#7f8c8d',
												borderColor: 'transparent',
												borderWidth: 20,
												hoverable: true
											},
											xaxis: {
												tickColor: 'transparent',
												tickDecimals: 2
											},
											yaxis: {
												tickSize: 1000
											}
										});
									
										// Graph Toggle ############################################
										$('#graph-bars').hide();
									
										$('#lines').on('click', function (e) {
											$('#bars').removeClass('active');
											$('#graph-bars').fadeOut();
											$(this).addClass('active');
											$('#graph-lines').fadeIn();
											e.preventDefault();
										});
									
										$('#bars').on('click', function (e) {
											$('#lines').removeClass('active');
											$('#graph-lines').fadeOut();
											$(this).addClass('active');
											$('#graph-bars').fadeIn().removeClass('hidden');
											e.preventDefault();
										});
									
										// Tooltip #################################################
										function showTooltip(x, y, contents) {
											$('<div id="tooltip">' + contents + '</div>').css({
												top: y - 16,
												left: x + 20
											}).appendTo('body').fadeIn();
										}
									
										var previousPoint = null;
									
										$('#graph-lines, #graph-bars').bind('plothover', function (event, pos, item) {
											if (item) {
												if (previousPoint != item.dataIndex) {
													previousPoint = item.dataIndex;
													$('#tooltip').remove();
													var x = item.datapoint[0],
														y = item.datapoint[1];
														showTooltip(item.pageX, item.pageY, y + ' visitors at ' + x + '.00h');
												}
											} else {
												$('#tooltip').remove();
												previousPoint = null;
											}
										});
									
									});
									</script>
				<div class="graph-container">
									
									<div id="graph-lines"> </div>
									<div id="graph-bars"> </div>
								</div>
	
		</div>
		</div>
		<div class="clearfix"> </div>
		</div>
		<!---->
	
  
		<div class="content-mid">
			
			<div class="col-md-5">
					 <div class="cal1 cal_2"><div class="clndr"><div class="clndr-controls"><div class="clndr-control-button"><p class="clndr-previous-button">previous</p></div><div class="month">July 2015</div><div class="clndr-control-button rightalign"><p class="clndr-next-button">next</p></div></div><table class="clndr-table" border="0" cellspacing="0" cellpadding="0"><thead><tr class="header-days"><td class="header-day">S</td><td class="header-day">M</td><td class="header-day">T</td><td class="header-day">W</td><td class="header-day">T</td><td class="header-day">F</td><td class="header-day">S</td></tr></thead><tbody><tr><td class="day adjacent-month last-month calendar-day-2015-06-28"><div class="day-contents">28</div></td><td class="day adjacent-month last-month calendar-day-2015-06-29"><div class="day-contents">29</div></td><td class="day adjacent-month last-month calendar-day-2015-06-30"><div class="day-contents">30</div></td><td class="day calendar-day-2015-07-01"><div class="day-contents">1</div></td><td class="day calendar-day-2015-07-02"><div class="day-contents">2</div></td><td class="day calendar-day-2015-07-03"><div class="day-contents">3</div></td><td class="day calendar-day-2015-07-04"><div class="day-contents">4</div></td></tr><tr><td class="day calendar-day-2015-07-05"><div class="day-contents">5</div></td><td class="day calendar-day-2015-07-06"><div class="day-contents">6</div></td><td class="day calendar-day-2015-07-07"><div class="day-contents">7</div></td><td class="day calendar-day-2015-07-08"><div class="day-contents">8</div></td><td class="day calendar-day-2015-07-09"><div class="day-contents">9</div></td><td class="day calendar-day-2015-07-10"><div class="day-contents">10</div></td><td class="day calendar-day-2015-07-11"><div class="day-contents">11</div></td></tr><tr><td class="day calendar-day-2015-07-12"><div class="day-contents">12</div></td><td class="day calendar-day-2015-07-13"><div class="day-contents">13</div></td><td class="day calendar-day-2015-07-14"><div class="day-contents">14</div></td><td class="day calendar-day-2015-07-15"><div class="day-contents">15</div></td><td class="day calendar-day-2015-07-16"><div class="day-contents">16</div></td><td class="day calendar-day-2015-07-17"><div class="day-contents">17</div></td><td class="day calendar-day-2015-07-18"><div class="day-contents">18</div></td></tr><tr><td class="day calendar-day-2015-07-19"><div class="day-contents">19</div></td><td class="day calendar-day-2015-07-20"><div class="day-contents">20</div></td><td class="day calendar-day-2015-07-21"><div class="day-contents">21</div></td><td class="day calendar-day-2015-07-22"><div class="day-contents">22</div></td><td class="day calendar-day-2015-07-23"><div class="day-contents">23</div></td><td class="day calendar-day-2015-07-24"><div class="day-contents">24</div></td><td class="day calendar-day-2015-07-25"><div class="day-contents">25</div></td></tr><tr><td class="day calendar-day-2015-07-26"><div class="day-contents">26</div></td><td class="day calendar-day-2015-07-27"><div class="day-contents">27</div></td><td class="day calendar-day-2015-07-28"><div class="day-contents">28</div></td><td class="day calendar-day-2015-07-29"><div class="day-contents">29</div></td><td class="day calendar-day-2015-07-30"><div class="day-contents">30</div></td><td class="day calendar-day-2015-07-31"><div class="day-contents">31</div></td><td class="day adjacent-month next-month calendar-day-2015-08-01"><div class="day-contents">1</div></td></tr></tbody></table></div></div>
			  <!----Calender -------->
			<link rel="stylesheet" href="css/clndr.css" type="text/css" />
			<script src="js/underscore-min.js" type="text/javascript"></script>
			<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
			<script src="js/clndr.js" type="text/javascript"></script>
			<script src="js/site.js" type="text/javascript"></script>
			<!----End Calender -------->
			</div>
			<div class="col-md-7 mid-content-top">
				<div class="middle-content">
					<h3>Our Lastest house</h3>
					<div id="owl-demo" class="owl-carousel text-center">
			<div class="item">
				<img class="lazyOwl img-responsive" data-src="images/apart1.jpg" alt="name">
			</div>
			<div class="item">
				<img class="lazyOwl img-responsive" data-src="images/apart2.jpg" alt="name">
			</div>
			<div class="item">
				<img class="lazyOwl img-responsive" data-src="images/villa1.jpg" alt="name">
			</div>
			<div class="item">
				<img class="lazyOwl img-responsive" data-src="images/villa2.jpg" alt="name">
			</div>
			<div class="item">
				<img class="lazyOwl img-responsive" data-src="images/house1.jpeg" alt="name">
			</div>
			<div class="item">
				<img class="lazyOwl img-responsive" data-src="images/apart3.jpg" alt="name">
			</div>
			<div class="item">
				<img class="lazyOwl img-responsive" data-src="images/house2.jpeg" alt="name">
			</div>
		</div>
		</div>
		<!--//sreen-gallery-cursual---->
		<!-- requried-jsfiles-for owl -->
		<link href="css/owl.carousel.css" rel="stylesheet">
		<script src="js/owl.carousel.js"></script>
			<script>
				$(document).ready(function() {
					$("#owl-demo").owlCarousel({
						items : 3,
						lazyLoad : true,
						autoPlay : true,
						pagination : true,
						nav:true,
					});
				});
			</script>
		<!-- //requried-jsfiles-for owl -->
			</div>
			<div class="clearfix"> </div>
		</div>
		<!----->
		<div class="content-bottom">
			<div class="col-md-6 post-top">
				<div class="post">
					<form class="text-area">
						<textarea   required="" > What are you doing...</textarea>
					</form>
					<div class="post-at">
						<ul class="icon">
							
							
							<div  class="post-file">
							<i class="fa fa-location-arrow"></i>
							<input id="input-1" name="input1[]" type="file" multiple="" class="">
							</div>
							<div  class="post-file">
							<i class="fa fa-camera"></i>
							<input id="input-2" name="input2[]" type="file" multiple="" class="">
							</div>
							<div  class="post-file">
							<i class="fa fa-video-camera"></i>
							<input id="input-3" name="input3[]" type="file" multiple="" class="">
							</div>
							<div  class="post-file">
							<i class="fa fa-microphone"></i>
							<input id="input-4" name="input4[]" type="file" multiple="" class="">
							</div>
							
							<script>
							$(document).on('ready', function() {
								$("#input-1").fileinput({showCaption: false});
							});
							</script>
							<script>
							$(document).on('ready', function() {
								$("#input-2").fileinput({showCaption: false});
							});
							</script>
							<script>
							$(document).on('ready', function() {
								$("#input-3").fileinput({showCaption: false});
							});
							</script>
							<script>
							$(document).on('ready', function() {
								$("#input-4").fileinput({showCaption: false});
							});
							</script>
						</ul>
						<form class="text-sub">
							<input type="submit" value="post">
						</form>
						<div class="clearfix"> </div>
					</div>
				</div>
			<div class="post-bottom">
				<div class="post-bottom-1">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<p>15k <label>Likes</label></p>
				</div>
				<div class="post-bottom-2">
					<a href="#"><i class="fa fa-twitter"></i></a>
					<p>20M <label>Followers</label></p>
				</div>
				<div class="clearfix"> </div>
			</div>
				
			</div>
			<div class="col-md-6">
				<div class="weather">
					<div class="weather-top">
						<div class="weather-top-left">
							<div class="degree">
							<figure class="icons">
								<canvas id="partly-cloudy-day" width="64" height="64">
								</canvas>
							</figure>
							<span>37°</span>
							<div class="clearfix"></div>
							</div>
				<script>
							 var icons = new Skycons({"color": "#1ABC9C"}),
								  list  = [
									"clear-night", "partly-cloudy-day",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
						</script>
							<p>
							<?php
// Return current date from the remote server
$today = date("d/m/Y");
echo $today;
?>	
								</p>
						</div>
						<div class="weather-top-right">
							<p><i class="fa fa-map-marker"></i>Machakos</p>
							<label>Machakos town</label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="weather-bottom">
			<div class="weather-bottom1">
				<div class="weather-head">
				<h4>Cloudy</h4>
				<figure class="icons">
					<canvas id="cloudy" width="58" height="58"></canvas>
				</figure>					
					<script>
							 var icons = new Skycons({"color": "#999"}),
								  list  = [
									"clear-night", "cloudy",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
						</script>
				<h6>20°</h6>
				<div class="bottom-head">
					<p>August 16</p>
					<p>Monday</p>
				</div>
			</div>
			</div>
			<div class="weather-bottom1 ">
				<div class="weather-head">
			<h4>Sunny</h4>
			<figure class="icons">
				<canvas id="clear-day" width="58" height="58">
				</canvas>				
			</figure>					
					<script>
							 var icons = new Skycons({"color": "#999"}),
								  list  = [
									"clear-night", "clear-day",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
						</script>
			<h6>37°</h6>
			<div class="bottom-head">
					<p>August 17</p>
					<p>Tuesday</p>
				</div>
			</div>
			</div>
			<div class="weather-bottom1">
				<div class="weather-head">
				<h4>Rainy</h4>
				<figure class="icons">
					<canvas id="sleet" width="58" height="58">
					</canvas>
				</figure>
				<script>
							 var icons = new Skycons({"color": "#999"}),
								  list  = [
									"clear-night", "clear-day",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
						</script>
		
				<h6>7°</h6>
				<div class="bottom-head">
					<p>August 18</p>
					<p>Wednesday</p>
				</div>
			</div>
			</div>
			<div class="weather-bottom1 ">
				<div class="weather-head">
			<h4>Snowy</h4>
			<figure class="icons">
					<canvas id="snow" width="58" height="58">
					</canvas>
				</figure>
				<script>
							 var icons = new Skycons({"color": "#999"}),
								  list  = [
									"clear-night", "clear-day",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
						</script>
			<h6>-10°</h6>
			<div class="bottom-head">
					<p>August 16</p>
					<p>Thursday</p>
				</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>

				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!--//content-->


	 
		<!---->
<div class="copy">
            <p> &copy; 2019 E-house Rental. All Rights Reserved | Design by <a href="http://kilonzowambua.github.io" target="_blank">Kilodev</a> </p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>


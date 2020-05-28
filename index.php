<?php
			
			session_start();
			include('includes/config.php');
			if(isset($_POST['login']))
			{
			
			$email=$_POST['email'] ;
			$password=$_POST['password'];
			$stmt=$conn->prepare("SELECT email,password,cid FROM client WHERE email=? and password=? ");
							$stmt->bind_param('ss',$email,$password);
							$stmt->execute();
							$stmt -> bind_result($email,$password,$cid);
							$rs=$stmt->fetch();
							$_SESSION['cid']=$cid;
							
							if($rs)
							{
								header("location:client/");
							}
			
							else
							{
								echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
							}
			}
							/*			if(isset($_POST['register'])){
							include 'includes/config.php';
							$fname = $_POST['fname'];
							$mname = ($_POST['mname']);
							$lname= $_POST['lname'];
							$age= ($_POST['age']);
						  $email = $_POST['email'];
							$password = ($_POST['password']);
							
							
							$qry = "INSERT INTO client (fname,mname,lname,age,email,password)
							VALUES('$fname','$mname','$lname','$age','$email','$password')";
							$result = $conn->query($qry);
							if($result == TRUE){
								echo "<script type = \"text/javascript\">
											alert(\"Successfully Joined!!.\");
											
											</script>";
							} else{
								echo "<script type = \"text/javascript\">
											alert(\"Registration Failed. Try Again\");
											
											</script>";
							}
						}
						*/
					  ?>
					 
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>I-House rental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="keywords" content="Vicarage Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet"><!-- //online-fonts -->
</head>
<body>
    <!-- banner -->
    <div class="banner">
        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">
                <h1>
                    <a class="navbar-brand text-white" href="index.php">
                        E-house rental
                    </a>
                </h1>
                <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto text-center">
                        <li class="nav-item active  mr-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item  mr-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="services.php">services</a>
                        </li>
                        <li class="nav-item dropdown mr-3 mt-lg-0 mt-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Other services
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="about.php">About</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="typo.php">Typography</a>
                            </div>
                        </li>
                        <li class="nav-item mr-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="gallery.php">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="admin/login.php">Admin</a>
                        </li>
                        <li>
                            <button type="button" class="btn  ml-lg-2 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#exampleModal">
                                Login
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- //header -->
        <div class="container">
            <!-- banner-text -->
            <div class="banner-text">
                <div class="slider-info">
                    <h3>Find a Home to Suit Your Lifestyle</h3>
                    <a class="btn btn-primary mt-lg-5 mt-3 agile-link-bnr" href="about.php" role="button">View More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- //container -->
    <!-- //banner -->
	<!-- courses -->
	<section class="wthree-row w3-about  py-5">
		<div class="container py-md-4 mt-md-3">
			<h3 class="heading-agileinfo">Our  <span>Properties</span></h3>
			<div class="card-deck mt-md-5 pt-5">
				  <div class="card">
					<img src="images/g1.jpg" class="img-fluid" alt="Card image cap">
					<div class="card-body w3ls-card">
					  <h5 class="card-title">Le Marche Etna House</h5>
					  <p class="card-text mb-3">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
						<div class="ab_button">
							<a class="btn btn-primary btn-lg hvr-underline-from-left" href="about.html" role="button">Read More </a>
						</div>
					</div>
				  </div>
				  <div class="card">
					<img src="images/g2.jpg" class="img-fluid" alt="Card image cap">
					<div class="card-body w3ls-card">
					  <h5 class="card-title">Renovated Family Home</h5>
					   <p class="card-text mb-3 ">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
						<div class="ab_button">
							<a class="btn btn-primary btn-lg hvr-underline-from-left" href="about.html" role="button">Read More </a>
						</div>
					</div>
				  </div>
				  <div class="card">
					<img src="images/g3.jpg" class="img-fluid" alt="Card image cap">
					<div class="card-body w3ls-card">
					  <h5 class="card-title">Southern Lake Villa</h5>
					   <p class="card-text mb-3 ">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
						<div class="ab_button">
							<a class="btn btn-primary btn-lg hvr-underline-from-left" href="about.html" role="button">Read More </a>
						</div>
					</div>
				  </div>
			</div>
        </div>
    </section>
	<!-- //courses -->
	<!-- slide -->
		<section class="slide-bg py-5">
			<div class="container py-md-4 mt-md-3">
				<div class="bg-pricemain mt-md-3 pt-5">
					<h3 class="agile-title text-uppercase text-white">Mauris et justo </h3>
					<h5 class="agile-title text-capitalize pt-4">condimentum interdum </h5>
					<p class="text-light py-4">Aliquam ac est vel nisl condimentum interdum vel eget enim. Curabitur mattis orci sed leo mattis, nec maximus nibh faucibus.
						Mauris et justo vel nibh rhoncus venenatis. Nullal condimentum interdum vel eget enim. Curabitur mattis orci sed le.
					</p>
					<a class="btn btn-primary mt-lg-5 mt-3 agile-link-bnr scroll" href="services" role="button">View More</a></div>
			</div>
		</section>
	<!-- //slide -->
<!-- Clients -->
	<div class="clients py-5">
		<div class="container py-md-4 mt-md-3">
				<h3 class="heading-agileinfo">Customer  <span>Reviews</span></h3>
				<section class="slider mt-md-5 pt-5">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<div class="clients_top row">
								<div class="col-md-3 clients_img">
									<img src="images/t1.jpg" class="img-fluid" alt="" />
								</div>
								<div class="col-md-9 client">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .</p>
									<h5>Gerald Roy</h5>
								</div>
							</div>
						</li>
						<li>
							<div class="clients_top row">
								<div class="col-md-3 clients_img">
									<img src="images/t2.jpg" class="img-fluid" alt="" />
								</div>
								<div class="col-md-9 client">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .</p>
									<h5>Gerald Roy</h5>
								</div>
							</div>
						</li>
						<li>
							<div class="clients_top row">
								<div class="col-md-3 clients_img">
									<img src="images/t3.jpg" class="img-fluid" alt="" />
								</div>
								<div class="col-md-9 client">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .</p>
									<h5>Gerald Roy</h5>
								</div>
							</div>
						</li>
						<li>
							<div class="clients_top row">
								<div class="col-md-3 clients_img">
									<img src="images/t4.jpg" class="img-fluid" alt="" />
								</div>
								<div class="col-md-9 client">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .</p>
									<h5>Gerald Roy</h5>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</section>
		</div>
	</div>
<!-- //Clients -->
 <!-- newsletter-->
    <div class="newsletter text-center py-lg-5">
        <div class="container py-5">
            <h3 class="heading-agileinfo">Get  <span class="text-white">Notified</span></h3>
           <div class="newsletter-inner">
				<p class="text-light py-4">Aliquam ac est vel nisl condimentum interdum vel eget enim. Curabitur mattis orci sed leo mattis, nec maximus nibh faucibus.
						Mauris et justo vel nibh rhoncus venenatis. Nullal condimentum interdum vel eget enim. Curabitur mattis orci sed le.
					</p> 
			</div>					
		   <div class="newsright pt-5">
                    <form action="#" method="post" class="d-flex">
                        <label class="align-self-center">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </label>
                        <input class="form-control" type="email" placeholder="Enter your email..." name="email" required="">
                        <input class="form-control" type="submit" value="Subscribe">
                    </form>
            </div>
            
        </div>
    </div>
    <!-- //newsletter-->

	<!-- video and events -->
	<div class="video-choose-agile py-5">
		<div class="container py-xl-5 py-lg-3">
		<h3 class="heading-agileinfo">Our  <span>News</span></h3>
			<div class="row mt-md-5 pt-5">
				<div class="col-lg-7 video">
					<img src="images/g2.jpg" class="img-fluid" alt="" />
				</div>
				<div class="col-lg-5 events">
					<div class="events-w3ls">
						<div class="d-flex">
							<div class="col-sm-2 col-3 events-up p-2 text-center">
								<h5 class="text-white font-weight-bold">28
									<span class="border-top font-weight-light pt-2 mt-2">Aug</span>
								</h5>
							</div>
							<div class="col-sm-10 col-9 events-right">
								<h4 class="text-dark">Homes as a Housing Option</h4>
								<ul class="list-unstyled">
									<li class="my-2">
										<i class="far fa-clock mr-2"></i>5.00 pm - 7.30 pm</li>
									<li>
										<i class="fas fa-map-marker mr-2"></i>25 Newyork City.</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="d-flex my-4">
						<div class="col-sm-2 col-3 events-up p-2 text-center">
							<h5 class="text-white font-weight-bold">28
								<span class="border-top font-weight-light pt-2 mt-2">Aug</span>
							</h5>
						</div>
						<div class="col-sm-10 col-9 events-right">
							<h4 class="text-dark">Tips for Buying a Home</h4>
							<ul class="list-unstyled">
								<li class="my-2">
									<i class="far fa-clock mr-2"></i>5.00 pm - 7.30 pm</li>
								<li>
									<i class="fas fa-map-marker mr-2"></i>25 Newyork City.</li>
							</ul>
						</div>
					</div>
					<div class="d-flex">
						<div class="col-sm-2 col-3 events-up p-2 text-center">
							<h5 class="text-white font-weight-bold">28
								<span class="border-top font-weight-light pt-2 mt-2">Aug</span>
							</h5>
						</div>
						<div class="col-sm-10 col-9 events-right">
							<h4 class="text-dark">Home Seller’s To-Do Checklist</h4>
							<ul class="list-unstyled">
								<li class="my-2">
									<i class="far fa-clock mr-2"></i>5.00 pm - 7.30 pm</li>
								<li>
									<i class="fas fa-map-marker mr-2"></i>25 Newyork City.</li>
							</ul>
						</div>
					</div>
					<div class="d-flex mt-4">
						<div class="col-sm-2 col-3 events-up p-2 text-center">
							<h5 class="text-white font-weight-bold">28
								<span class="border-top font-weight-light pt-2 mt-2">Aug</span>
							</h5>
						</div>
						<div class="col-sm-10 col-9 events-right">
							<h4 class="text-dark">Homes as a Housing Option</h4>
							<ul class="list-unstyled">
								<li class="my-2">
									<i class="far fa-clock mr-2"></i>5.00 pm - 7.30 pm</li>
								<li>
									<i class="fas fa-map-marker mr-2"></i>25 Newyork City.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //video and events -->
	<!-- Footer -->
		<footer id="footer" class="py-5">
			<div class="container">
				<div class="row  py-lg-5">
					<div class="col-lg-3 col-sm-6 footer-logo">
						<h5>about us</h5>
						<h2>
							<a href="index.html">Real Estate</a>
						</h2>
						<p class="mt-3">Nulla quis lorem ut libermalesuada ultrices posuere cubilia feugiatrice praesent sapien massa</p>
					</div>
					<div class="col-lg-3 col-sm-6 mt-sm-0 mt-4">
						<h5>Quick links</h5>
						<ul class="list-unstyled quick-links">
							<li>
								<a href="index.php">
								<i class="fa fa-angle-double-right"></i>Home</a>
							</li>
							<li>
								<a href="about.php">
									<i class="fa fa-angle-double-right"></i>About</a>
							</li>
							<li>
								<a href="services.php">
									<i class="fa fa-angle-double-right"></i>Services</a>
							</li>
							<li>
								<a href="gallery.php">
									<i class="fa fa-angle-double-right"></i>Gallery</a>
							</li>
							<li>
								<a href="contact.php">
									<i class="fa fa-angle-double-right"></i>Contact</a>
							</li>
						</ul>
					</div>
					<div class="col-lg-3 col-sm-6 mt-lg-0 mt-4">
						<h5>working hours</h5>
						<ul class="list-unstyled quick-links">
							<li>
								Monday - Friday
								<br>
								<span>9.00 - 20.00</span>
							</li>
							<li>
								Saturday
								<br>
								<span> 10.00 - 16.00 </span>
							</li>
							<li>
								Sunday
								<br>
								<span> 9.30 - 18.00 </span>
							</li>
						</ul>
					</div>
					<div class="col-lg-3 col-sm-6 footer_grid1 mt-lg-0 mt-4">
						<h5>Address</h5>
						<div class="fv3-contact">
							<span class="fas fa-envelope-open mr-2"></span>
							<p>
								<a href="mailto:example@email.com">info@example.com</a>
							</p>
						</div>
						<div class="fv3-contact my-2">
							<span class="fas fa-phone-volume mr-2"></span>
							<p>+456 123 7890</p>
						</div>
						<div class="fv3-contact">
							<span class="fas fa-home mr-2"></span>
							<p>+90 nsequursu dsdesdc,
								<br>xxx Street State 34789.</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<div class="cpy-right text-center py-4">
			<p class="text-white">© 2019 E-House rental. All rights reserved | Design by
				<a href="http://kilonzowambua.github.io"> Kilodev.</a>
			</p>
		</div>
	</div>
	<!-- /Footer -->

	<!-- login  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				
                    <form action="#" method="post">
					
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Username or email" name="email"  id="recipient-name" required="">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" placeholder="password" name="password" id="password" required="">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" name="login" class="form-control" value="Login">
                        </div>
                        <div class="row sub-w3l my-3">
                            <div class="col sub-agile">
                                <input type="checkbox" id="brand1" value="">
                                <label for="brand1" class="text-secondary">
                                    <span></span>Remember me?</label>
                            </div>
                            <div class="col forgot-w3l text-right">
                                <a href="#" class="text-secondary">Forgot Password?</a>
                            </div>
                        </div>
                        <p class="text-center dont-do">Don't have an account?
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter2" class="text-dark font-weight-bold">
                                Register Now</a>
								
						</p>
						
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //login -->
	 <!--/Register-->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-hidden="true">
	<?php
				if(isset($_POST['register'])){
							include 'includes/config.php';
							$fname = $_POST['fname'];
							$mname = ($_POST['mname']);
							$lname= $_POST['lname'];
							$age= ($_POST['age']);
						  $email = $_POST['email'];
							$password = ($_POST['password']);
							
							
							$qry = "INSERT INTO client (fname,mname,lname,age,email,password)
							VALUES('$fname','$mname','$lname','$age','$email','$password')";
							$result = $conn->query($qry);
							if($result == TRUE){
								echo "<script type = \"text/javascript\">
											alert(\"Successfully Joined!!.\");
											
											</script>";
							} else{
								echo "<script type = \"text/javascript\">
											alert(\"Registration Failed. Try Again\");
											
											</script>";
							}
						}
				
	?>

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login px-4 mx-auto mw-100">
                        <h5 class="modal-title text-center text-dark mb-4">JOIN NOW</h5>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label class="col-form-label">First name</label>

                                <input type="text" class="form-control" name="fname" id="validationDefault01" placeholder="" required="">
							</div>
							<div class="form-group">
                                <label class="col-form-label">Middle name</label>
                                <input type="text" class="form-control" name="mname" id="validationDefault02" placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Last name</label>
                                <input type="text" class="form-control" name="lname" id="validationDefault02" placeholder="" required="">
                            </div>
							<div class="form-group">
                                <label class="col-form-label">Age</label>
                                <input type="text" class="form-control" name="age" id="validationDefault02" placeholder="" required="">
							</div>
							<div class="form-group">
                                <label class="col-form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" id="validationDefault02" placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label class="mb-2 col-form-label">Password</label>
                                <input type="password" class="form-control"name="password" id="password1" placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password2" placeholder="" required="">
                            </div>
							<div class="reg-w3l">
								<input type="submit" class="form-control submit mb-4" name="register" value="Register">
                           </div>
						   <p class="text-center pb-4">
                                <a href="#" class="text-secondary">By clicking Register, I agree to your terms</a>
                            </p>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--//Register-->

    <!-- //footer -->
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
	<!-- FlexSlider-JavaScript -->
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		
				$(window).load(function(){
				$('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
						$('body').removeClass('loading');
					}
			});
		});
	</script>
<!-- //FlexSlider-JavaScript -->
    <!-- script for password match -->
    <script>
        window.onload = function () {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
    <!-- script for password match -->
    <!-- start-smooth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php	
	$userid=$_SESSION['userid'];
	$ret="select * from user where userid=?";
	
	$stmt= $conn->prepare($ret) ;
	 $stmt->bind_param('i',$userid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
       {
           ?>
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <h1>E-HOUSE RENTAL</h1>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                    <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-account"></i>Clients</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="client.php">View clients</a>
                                </li>
                                <li>
                                    <a href="add client.php">Register</a>
                                </li>
                                <li>
                                    <a href="manageclient.php">Manage clients</a>
                                </li>
                                
                                   

                            </ul>
                        </li>
                     
                      
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-home"></i>House</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="house.php">All house</a>
                                </li>
                                <li>
                                    <a href="add house.php">Add house</a>
                                </li>
                                <li>
                                    <a href="managehouse.php">Manage</a>
                                </li>
                              
                                
                            </ul>
                        </li>
                        <li>
                            <a href="manageorder.php">
                                <i class="far fa-check-square"></i>Rental Order</a>
                        </li>
                       
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                   <h2>E-house Rental</h2>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                          <!--  <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>-->
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Clients</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="client.php">View clients</a>
                                </li>
                                <li>
                                    <a href="add client.php">Register</a>
                                </li>
                                <li>
                                    <a href="manageclient.php">Manage clients</a>
                                </li>
                                <!--<li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>-->
                            </ul>
                        </li>
                     
                      
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-home"></i>House</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="house.php">All house</a>
                                </li>
                                <li>
                                    <a href="add house.php">Add house</a>
                                </li>
                                <li>
                                    <a href="managehouse.php">Manage</a>
                                </li>
                              
                                
                            </ul>
                            <li>
                            <a href="manageorder.php">
                                <i class="far fa-check-square"></i>Rental Order</a>
                        </li>
                       
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                    <?php

$sql = $conn->query("SELECT COUNT(*) FROM request 
WHERE status='Being processed'");
$row = $sql->fetch_row();
$count = $row[0];
?>	  
                                            
                                            
                                    
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"><?php echo $count ;?></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have <?php echo $count ;?> pending orders</p>
                                            </div>
                                            <!--<div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>-->
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p> Solve Pending  orders approval</p>
                                                    
                                                </div>
                                            </div>
                                           <!-- <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>-->
                                            <div class="notifi__footer">
                                                <a href="#">View the orders request</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                <?php	
	$userid=$_SESSION['userid'];
	$ret="select * from user where userid=?";
	
	$stmt= $conn->prepare($ret) ;
	 $stmt->bind_param('i',$userid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
       {
           ?>
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/logo.gif"  />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $row->username;?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/logo.gif" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $row->username;?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $row->email;?></span>
                                                </div>
                                            </div>
       <?php }?>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
       <?php } ?>
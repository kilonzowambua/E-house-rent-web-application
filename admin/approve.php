<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>
<?php	
 $rid=$_GET['rid'];   
$ret="select * from request where rid=?";

$stmt= $conn->prepare($ret) ;
 $stmt->bind_param('i',$rid);
 $stmt->execute() ;//ok
 $res=$stmt->get_result();
 //$cnt=1;
   while($row=$res->fetch_object())
   {
       ?>
<div class="main-content">

<?php

				if(isset($_POST['updateh'])){
							include 'includes/config.php';
                            $status = "occupied";
							$hid ="$row->houseid";
                          $query="update house set status=? where hid=?";
                          $stmt = $conn->prepare($query);
                          $rc=$stmt->bind_param('si', $status, $hid);
                          $stmt->execute();
                          echo"<script>alert('The house Has Been  Successfully Occupied now');</script>";
                          }
                          ?>	

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <?php

				if(isset($_POST['updater'])){
							include 'includes/config.php';
                            $status = "Approved";
							
                          $query="update request set status=? where rid=?";
                          $stmt = $conn->prepare($query);
                          $rc=$stmt->bind_param('si', $status, $rid);
                          $stmt->execute();
                          echo"<script>alert('Request accepted);</script>";
                          }
                          ?>	
     
          
                        <div class="row">
                            <div class=".col-md-6 .offset-md-3">
                                <div class="card">
                                    <div class="card-header">E-house rental</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Approval form</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" novalidate="novalidate">
                                                               
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Client id</label>
                                                <input id="cc-pament" readonly name="cc-payment" type="text" value="<?php echo $row->userid;?>"class="form-control" aria-required="true" aria-invalid="false" value="100.00">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">House code</label>
                                                <input id="cc-name" readonly name="cc-name" value="<?php echo $row->houseid;?>"type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">House name</label>
                                                <input id="cc-number" readonly name="cc-number" type="tel" class="form-control cc-number identified visa" value="<?php echo $row->housename;?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">House type</label>
                                                <input  readonly id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="<?php echo $row->housetype;?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Since</label>
                                                        <input readonly id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" value="<?php echo $row->rdate;?>" data-val="true" data-val-required="Please enter the card expiration"
                                                            
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Cost</label>
                                                    <div class="input-group">
                                                  
                                                        <input id="x_card_code" name="x_card_code" type="tel" readonly class="form-control cc-cvc" value=" Ksh <?php echo $row->cost;?>" data-val="true" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                            <input type="submit" name="updateh" id="payment-button" value="Change house status" class= "btn btn-outline-danger"/>
                                            <input type="submit" name="updater" id="payment-button" value="confirm rent order"  class="btn btn-outline-success"/>
                                            </div>
                                        <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div></div>
                                </div>
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
<!-- end document-->

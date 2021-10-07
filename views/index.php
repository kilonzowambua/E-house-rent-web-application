<!doctype html>

<html class="no-js" lang="en">
<?php 
include('../partials/head.php');
?>
<body class="bg-white">
<div class="bg-img">

<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <h1 class="align-content">Rental system </h1>
                </a>
            </div>
            <div class="login-form">
            <form>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="email" class="form-control" placeholder="User Name" required>
                        </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="tel"  name="phone" pattern="[+]{1}[0-9]{11,14}" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" placeholder="Email">
                        </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password">
                        </div>
                                    <div class="checkbox">
                                        <label>
                                <input type="checkbox"> Agree the terms and policy
                            </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                    <div class="social-login-content">
                                        <div class="social-button">
                                            <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Register with facebook</button>
                                            <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Register with twitter</button>
                                        </div>
                                    </div>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="#"> Sign in</a></p>
                                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include('../partials/script.php'); ?>
</body>

</html>

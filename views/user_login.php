<?php
/*
 * Created on Thu Aug 26 2021
 *
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 Devlan Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
require_once '../config/codeGen.php';
require '../vendor/autoload.php';
require '../vendor/twitteroauth/autoload.php';



/* Create account */
if (isset($_POST['login'])) {
    $user_email = $_POST['user_email'];
    $user_password = sha1(md5($_POST['user_password']));
    $stmt = $mysqli->prepare("SELECT user_email,user_password,user_access FROM user WHERE user_email=? and user_password=? ");
    $stmt->bind_param('ss', $user_email, $user_password);
    $stmt->execute();
    $stmt->bind_result($user_email, $user_password,$user_access);
    $rs = $stmt->fetch();
  
    if ($rs && $user_access =="admin") {
      $_SESSION['user_email'] = $user_email;
      header("location:admin_home");
    } elseif ($rs && $user_access =="staff") {
        $_SESSION['user_email'] = $user_email;
      header("location:staff_home");
    }
    elseif ($rs && $user_access =="user") {
        $_SESSION['user_email'] = $user_email;
      header("location:user_home");
    }
   else {
      $err = "Access Denied Please Check Your Email Or Password";
      
    }
  }
//create using twitter


    
use Abraham\TwitterOAuth\TwitterOAuth;

/*
    if ( isset( $_SESSION['twitter_access_token'] ) && $_SESSION['twitter_access_token'] ) { // we have an access token
        $isLoggedIn = true;    
    } elseif ( isset( $_GET['oauth_verifier'] ) && isset( $_GET['oauth_token'] ) && isset( $_SESSION['oauth_token'] ) && $_GET['oauth_token'] == $_SESSION['oauth_token'] ) { // coming from twitter callback url
        // setup connection to twitter with request token
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));


        // save access token to the session
        $_SESSION['twitter_access_token'] = $access_token;

        // user is logged in
        $isLoggedIn = true;
    } else { // not authorized with our app, show login button
        // connect to twitter with our app creds

        $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET );

        // get a request token from twitter
        $request_token = $connection->oauth( 'oauth/request_token', array( 'oauth_callback' => OAUTH_CALLBACK ) );

        // save twitter token info to the session
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

        // user is logged in
        $isLoggedIn = false;
    }

    if ( $isLoggedIn ) { // logged in
        // get token info from session
        $oauthToken = $_SESSION['twitter_access_token']['oauth_token'];
        $oauthTokenSecret = $_SESSION['twitter_access_token']['oauth_token_secret'];

        // setup connection
        $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, $oauthToken, $oauthTokenSecret );

        // user twitter connection to get user info
        $user = $connection->get( "account/verify_credentials", ['include_email' => 'true'] );

        if ( property_exists( $user, 'errors' ) ) { // errors, clear session so user has to re-authorize with our app
            $_SESSION = array();
            header( 'Refresh:0' );
        } else { // display user info in browser
            ?>
            <img src="<?php echo $user->profile_image_url; ?>" />
            <br />
            <b>User:</b> <?php echo $user->name; ?>
            <br />
            <b>Location:</b> <?php echo $user->location; ?>
            <br />
            <b>Twitter Handle:</b> <?php echo $user->screen_name; ?>
            <br />
            <b>User Created:</b> <?php echo $user->created_at; ?>
            <br />
            <hr />
            <br />
            <h3>User Info</h3>
            <textarea style="height:400px;width:100%"><?php echo print_r( $user, true ); ?></textarea>
            <?php
        }
    } else {  // not logged in, get and display the login with twitter link
        $url = $connection->url( 'oauth/authorize', array( 'oauth_token' => $request_token['oauth_token'] ) );
        ?>
        <a href="<?php echo $url; ?>">Login With Twitter</a>
        <?php

    }

//create using Google
*/
?>
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
                <a href="#">
                    <h1 class="align-content">Rental system </h1>
                </a>
            </div>
            <div class="login-form">
            <form method="post">
                    
                        <div class="form-group">
                                <label>Email address</label>
                                <input type="email"  name="user_email" class="form-control">
                        </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control"  name="user_password">
                        </div>
                                    
                                    <button type="submit" name="login" class="btn btn-primary btn-flat m-b-30 m-t-30">Login</button>
                                    <div class="social-login-content">
                                        <div class="social-button">
                                            <a href="<?php echo $url; ?><button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Login with twitter</button></a>
                                            <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Login with facebook</button>
                                            
                                        </div>
                                    </div>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="index"> Sign up</a></p>
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

<?php
/*
 * Created on Tue Aug 24 2021
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


$dbuser = "root";
$dbpass = "";
$host = "localhost";
$db = "E-HOUSERENTAL";
$mysqli = new mysqli($host, $dbuser, $dbpass, $db);
 // your app consumer key
 define( 'CONSUMER_KEY', 'N5oPLW5b1irfbSi4TJahxLTuP' );

 // your app consumer secret
 define( 'CONSUMER_SECRET', 'K6MhvG6SzdIvGwvMgI9a5TPutnNI4joFd1Ii1qh0MVXRSWpyj7' );

 // your app callback url

 define( 'OAUTH_CALLBACK', 'http://localhost:80/e-houserental/views/user_dashboard' );
 
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



/* Load System Settings Here */
$ret = 'SELECT * FROM  Ubc_System_Settings';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($system_settings = $res->fetch_object()) {
?>
    <!doctype html>
    <html class="no-js" lang="">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $system_settings->Ubc_System_Setting_system_name; ?> | Management Information System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="../public/img/logo_preloader.png">
        <!-- Normalize CSS -->
        <link rel="stylesheet" href="../public/css/normalize.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="../public/css/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="../public/css/all.min.css">
        <!-- Flaticon CSS -->
        <link rel="stylesheet" href="../public/fonts/flaticon.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="../public/css/animate.min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../public/css/style.css">
        <!-- Modernize js -->
        <script src="../public/js/modernizr-3.6.0.min.js"></script>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="../public/css/animate.min.css">
        <!-- Alert Js -->
        <link rel="stylesheet" href="../public/plugins/iziToast/iziToast.min.css">
        <!-- Select 2 Css -->
        <link rel="stylesheet" href="../public/css/select2.min.css">
        <!-- Date Picker CSS -->
        <link rel="stylesheet" href="../public/css/datepicker.min.css">
        <!-- Data Tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
    </head>
<?php } ?>
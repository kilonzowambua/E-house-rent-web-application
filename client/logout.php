<?php
session_start();
unset($_SESSION['cid']);
session_destroy();
header('Location:../index.php');
?>

<?php print_r($_GET); ?>
<?php session_start(); ?>
<?php
$_SESSION['username'] = $_GET['nickname'];
$_SESSION['useremail'] = $_GET['email'];
$_SESSION['login_status'] = 1;
$_SESSION['loginProvider'] = $_GET['loginProvider'];
header("location:index.php");
?>
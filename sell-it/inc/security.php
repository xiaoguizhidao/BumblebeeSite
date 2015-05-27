<?php
if(!isset($_SESSION['login_status']) || $_SESSION['login_status']!=1) {
	if(basename($_SERVER['PHP_SELF'])!="login.php"&&basename($_SERVER['PHP_SELF'])!="signup.php") {
	header("location:login.php");
	}
}
?>
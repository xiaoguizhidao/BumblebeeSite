<?
session_start();
session_unset($_SESSION['login_status']);
session_unset($_SESSION['username']);
header("location: index.php");
?>
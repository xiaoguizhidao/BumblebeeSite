<?php
if(!session_id()) {
session_start();
}
if(!isset($_SESSION['loggedin'])){
header("location:index.php");
}
?>
<?php
session_start();
//require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg=$_GET['msg'];
$id=$_GET['id'];

$sql="delete from inquiry where id='$id'";
$delete=mysql_query($sql) or die(mysql_error());
header("location:inquiry.php");


?>

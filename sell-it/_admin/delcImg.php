<?php 
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
$c_id=$_GET['c_id'];
$delete_query="DELETE  from certificateimg WHERE c_id='$c_id' " ;
if(mysql_query($delete_query)){
		header("location:certificate.php?msg=value has been deleted");
}else{
	echo("error");
}




?>
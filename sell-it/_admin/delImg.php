<?php 
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
$f_id=$_GET['f_id'];
$delete_query="DELETE  from factoryimg WHERE f_id='$f_id' " ;
if(mysql_query($delete_query)){
		header("location:factory.php?msg=value has been deleted");
}else{
	echo("error");
}




?>
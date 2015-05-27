<?php 
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
$pid=$_GET['page_id'];
$delete_query="DELETE  from pages WHERE id='$pid' " ;
if(mysql_query($delete_query)){
		header("location:page.php?msg=value has been deleted");
}else{
	echo("error");
}




?>
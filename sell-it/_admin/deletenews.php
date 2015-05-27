<?php 
$id=$_GET['news_id'];
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$delete_query="DELETE  from headernews WHERE id='$id' " ;
if(mysql_query($delete_query)){
		header("location:headernews.php?msg=value has been deleted");
}else{
	echo("error");
}






?>
<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>
<?php 
$h_news=$_POST['news_heading'];
$hnews=$_POST['newsdes'];
$qryInsert="insert into headernews(headernews,news) values('$h_news','$hnews')";
if(mysql_query($qryInsert) or die(mysql_error())){
header("location:headernews.php?msg=Value Inserted");
}else{
	echo("error");
}




?>
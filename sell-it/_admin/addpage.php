<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
$heading=$_POST['page_heading'];
$des=$_POST['page_description'];
$qryInsert="insert into pages(heading,description) values('$heading','$des')";
if(mysql_query($qryInsert) or die(mysql_error())){
header("location:page.php?msg=Value Inserted");
}else{
	echo("error");
}
 
?>










 ?>
<?php
session_start();
//require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg=$_GET['msg'];
$id=$_GET['id'];
$status=$_REQUEST['status'];
if($status==0){
$st=1;
}elseif($status==1){
$st=0;
}
$sql="update inquiry set status='$st' where id='$id'";


if(mysql_query($sql)){
		header("location:inquiry.php");
	}else{
		$msg="There is some error";
	}

?>

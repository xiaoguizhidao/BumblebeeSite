<?php 
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
$heading=$_POST['page_heading'];
$des=addslashes($_POST['page_description']);
//$des_arb=$_POST['des_arb'];
$pid=$_GET['page_id'];
$update_query="UPDATE pages SET heading='$heading',description='$des' " ;
if ($_FILES["page_image"]["error"] > 0)
  {
  //echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else{
move_uploaded_file($_FILES["page_image"]["tmp_name"],
      "../page_image/" . $_FILES["page_image"]["name"]);
$filename = basename($_FILES['page_image']['name']);
$update_query.=", page_image='$filename'";
}
$update_query.=" where id='$pid'";
if(mysql_query($update_query)){
header("location:page.php?msg=value updated");
}else{
	echo("error");
}




?>
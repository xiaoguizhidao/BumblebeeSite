<?php
require_once("_admin/includes/config.php");
$id = $_GET['id'];
$returnUrl = $_SERVER['HTTP_REFERER'];
$qury = "delete from cart where c_i_id=".$id;
if(mysql_query($qury)) {
	header("location:$returnUrl");
} else {
	echo mysql_error();
}
?>
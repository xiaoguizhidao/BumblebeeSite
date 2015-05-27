<?php
require_once("../_admin/includes/config.php");
require_once("../_admin/includes/class.php");
$objUser = new users;
if(isset($_GET['register_email'])) {
	$emailadd = $_POST['email'];
	if(filter_var($emailadd, FILTER_VALIDATE_EMAIL)) {
	if($objUser->getUserDetail($emailadd)) {
		echo "Already Registered";
	} else {
		echo "Valid Email";
		}} else {
		echo "Invalid Email address";
		}
}

if(isset($_GET['address'])) {
	$adresid = $_POST['addressid'];
	//echo $adresid;
	$qry = "select * from address where add_id = ".$adresid;
	$res = mysql_query($qry);
	$data = mysql_fetch_array($res);
	echo "<strong>".$data['address_name']."</strong>
	<p>".$data['address1']."</p>
	<p>".$data['address2']."</p>
	<p>".$data['city'].", ".$data['state'].", ".$data['zip_code'].", ".$data['country']."</p>
	<p>".$data['phone']."</p>";
}
?>
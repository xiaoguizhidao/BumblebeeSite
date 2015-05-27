<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
include_once("inc/security.php");
$msg = NULL;
$userObj = new users;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$sess_id = $_SESSION['order_id'];
if(isset($_SESSION['login_status']) && $_SESSION['login_status']==1) {
	$ids = "select trade_id from trades where user_id=".$userid." and sessid='".$sess_id."'";
	$rIfP = mysql_query($ids);
	if(mysql_num_rows($rIfP)<1) {
		header("location:index.php");
	}
}
if(isset($_POST['sub_paypal'])) {
	$paypalid = addslashes($_POST['paypal_payment']);
	$chqk = "select trade_id from trades where user_id = ".$userid." and sessid='".$sess_id."'";
	$chqr = mysql_query($chqk);
	if(mysql_num_rows($chqr)<1) {
		$insq = "insert into trades (user_id,sessid,paypal_id) values('".$userid."','".$sess_id."','".$paypalid."')";
		if(mysql_query($insq)) {
			$msg = "Successfull";
		} else {
			$msg = mysql_error();
		}
	} else {
		$trdd = mysql_query($chqk);
		$dt = mysql_fetch_array($trdd);
		$insq = "update trades set paypal_id = '".$paypalid."', check_address = NULL, charity = NULL where trade_id = ".$dt['trade_id'];
		if(mysql_query($insq)) {
			$msg = "Successfull";
		} else {
			$msg = mysql_error();
		}
	}
}
if(isset($_POST['sub_cheque'])) {
	$chkadr = $_POST['chkadr'];
	$chqk = "select trade_id from trades where user_id = ".$userid." and sessid='".$sess_id."'";
	$chqr = mysql_query($chqk);
	if(mysql_num_rows($chqr)<1) {
		$insq = "insert into trades (user_id,sessid,check_address) values('".$userid."','".$sess_id."','".$chkadr."')";
		if(mysql_query($insq)) {
			$msg = "Successfull";
		} else {
			$msg = mysql_error();
		}
	} else {
		$trdd = mysql_query($chqk);
		$dt = mysql_fetch_array($trdd);
		$insq = "update trades set paypal_id = NULL, check_address = '".$chkadr."', charity = NULL where trade_id = ".$dt['trade_id'];
		if(mysql_query($insq)) {
			$msg = "Successfull";
		} else {
			$msg = mysql_error();
		}
	}
}
if(isset($_POST['sub_charity'])) {
	$charity = addslashes($_POST['charity']);
	$chqk = "select trade_id from trades where user_id = ".$userid." and sessid='".$sess_id."'";
	$chqr = mysql_query($chqk);
	if(mysql_num_rows($chqr)<1) {
		$insq = "insert into trades (user_id,sessid,charity) values('".$userid."','".$sess_id."','".$charity."')";
		if(mysql_query($insq)) {
			$msg = "Successfull";
		} else {
			$msg = mysql_error();
		}
	} else {
		$trdd = mysql_query($chqk);
		$dt = mysql_fetch_array($trdd);
		$insq = "update trades set paypal_id = NULL, check_address = NULL, charity = '".$charity."' where trade_id = ".$dt['trade_id'];
		if(mysql_query($insq)) {
			$msg = "Successfull";
		} else {
			$msg = mysql_error();
		}
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<title>Sell It</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
#center_mid_container {min-height:300px;}
#sellcart {list-style:none; float:right; width:24%; max-width:230px;}
#sellcart li {padding:5px 3px; margin:5px auto; border-bottom:2px solid #333;}
#sellcart img {display:block; margin-bottom:5px;}
#sellcart strong {font:bold 13px calibri;}
#sellcart p {font:12px arial; text-align:left;}
#sellcart a {color:#888; font:bold 11px arial; text-decoration:underline; text-align:right; display:block;}
#const {width:75%; float:left; max-width:750px; padding:20px 0; font:13px calibri;}
#const h2 {font:bold 30px calibri;}

label {font:bold 16px calibri; display:block; clear:both; margin:7px auto 3px;}
input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; color:#000; font:bold 18px calibri; line-height:28px; height:32px; /*padding:0 55px;*/ background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); border:1px solid #ffcc00;}
#adrprv {margin:10px auto;}
</style>
</head>

<body>
<?php include_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container">
        <?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container">
<section id="const">
<?php
if(!isset($_SESSION['login_status']) || $_SESSION['login_status']!=1) { ?>
	<p>Please <a href="login.php">Login</a> with your existing account or <a href="signup.php">Create New Account</a> to complete the process.</p>
<?php } else { ?>
<ul class="steps">
<li><a href="index.php">Step 1</a></li>
<li><a href="payment-type.php">Step 2</a></li>
<li><a href="ship-opt.php">Step 3</a></li>
</ul>

<h2>Address Confirmation </h2>
Please select the address you want your check to be sent to below.
<p><?php // echo $msg; ?></p>
<form action="final.php" method="post" id="formadr">
<?php if($userObj->getAddress($_SESSION['user_email'])) { ?>
<?php
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$paypalQry = "select address_to_ship from trades where user_id=".$userid." and sessid='".$_SESSION['order_id']."' and address_to_ship !=''";
$paypalRslt = mysql_query($paypalQry);
$paypalData = mysql_fetch_array($paypalRslt);
$shipAddress = $paypalData['address_to_ship'];
?>
<?php $name=  $userObj->getUserDetail($_SESSION['user_email'])->first_name; ?>
<?php $lname= $userObj->getUserDetail($_SESSION['user_email'])->last_name; ?>
<label>Select Address</label>
<select name="address" id="adrcng">
<option value="">Select Address</option>
<?php foreach($userObj->getAddress($_SESSION['user_email']) as $myadr): ?>
<?php if($shipAddress): ?>
<option value="<?php echo $myadr->add_id; ?>"<?php if($myadr->add_id==$shipAddress):?> selected<?php endif; ?>><?php echo $myadr->address1.', '. $myadr->address2.', '. $myadr->city.', '. $myadr->state.', '. $myadr->zip_code.', '. $myadr->country; ?><?php //echo $name.' '.$lname; ?></option>
<?php else: ?>
<option value="<?php echo $myadr->add_id; ?>"><?php echo $myadr->address1.', '. $myadr->address2.', '. $myadr->city.', '. $myadr->state.', '. $myadr->zip_code.', '. $myadr->country; ?><?php //echo $name.' '.$lname; ?></option>
<?php endif; ?>
<?php endforeach; ?>
</select>
<section id="adrprv"></section>
<input type="submit" name="sub_adr" value="Submit">
<?php } else { ?>
<a href="add-address.php">Add Address</a>
<?php } ?>
</form>
<?php } ?>

</section>
<?php include_once("inc/right-cart.php"); ?>
                    </section>
<?php include_once("inc/footer.php"); ?>
</section>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#butnCart').click(function(){
		$('#sellcart ul').slideToggle('slow')
		})
    $('#adrcng').change(function(){
		var ind = document.getElementById('adrcng').selectedIndex
		if(ind==0) {
			$('#adrprv').html('')
		} else {
		var adid = $(this).val()
		$.post("inc/ajax.php?address",{'addressid':adid},function(data,status) {
			$('#adrprv').html(data)
		})
		}
		
		})
		
	$('#formadr').submit(function(){
		var ind = document.getElementById('adrcng').selectedIndex
		if(ind==0) {
			alert('select any address')
			return false;
		}
		})
});
</script>
<?php if($shipAddress): ?>
<script type="text/javascript">
$(document).ready(function() {
	$.post("inc/ajax.php?address",{'addressid':<?php echo $shipAddress; ?>},function(data,status) {
			$('#adrprv').html(data)
		})
})
</script>
<?php endif; ?>
</body>
</html>
<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
$msg = NULL;
$userObj = new users;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
if(!isset($_SESSION['order_id']) || empty($_SESSION['order_id'])) {
$_SESSION['order_id'] = $userObj->randomOrder();
}
$sess_id = $_SESSION['order_id'];
if(isset($_POST['sub_adr'])) {
	$myadrid = $_POST['address'];
	$query = "update trades set address_to_ship = ".$myadrid." where user_id = ".$userid." and sessid='".$sess_id."'";
	if(mysql_query($query)) {
		
	} else {
		echo mysql_error();
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
#center_mid_container {min-height:400px; font:13px calibri; padding:10px 0 0 0; clear:both;}
#sellcart {list-style:none; float:right; width:24%; max-width:230px;}
#sellcart li {padding:5px 3px; margin:5px auto; border-bottom:2px solid #333;}
#sellcart img {display:block; margin-bottom:5px;}
#sellcart strong {font:bold 13px calibri;}
#sellcart p {font:12px arial; text-align:left;}
#sellcart a {color:#888; font:bold 11px arial; text-decoration:underline; text-align:right; display:block;}
#const {width:75%; float:left; max-width:750px; padding:20px 0; font:13px calibri;}
#const h2 {font:bold 30px calibri;}
input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 16px calibri; line-height:30px; height:33px; background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); border:1px solid #ffcc00; color:#000; float:right;}
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
<h2>Choose your shipping method</h2>
<p>You can pick the most convenient way to send your items to us.</p>
<!--<strong>Choose From: </strong>-->
<form action="confirm.php" method="post">
<ul id="shipbox">

<li>
<img src="images/usps_shipping.jpg" alt="fedex">
<input type="radio" name="box_opt" value="pre-paid " checked>
<article><strong>Free USPS Label and Use your own Box (1-3 days)</strong>
<p>We'll send a prepaid label to your email address. Affix it to your own box and drop it at any USPS location.</p>
</article>
</li>
<li>
<img src="images/fedex_shipping.jpg" alt="fedex">
<input type="radio" name="box_opt" value="pre-paid">
<article><strong>Free FedEx Label and Use your own Box (1-3 days)</strong>
<p>We’ll send a prepaid label to your email address. Affix it to your own box and drop it at any FedEx location.</p>
</article>
</li>
<li>
<img src="images/obb_shipping.jpg" alt="shipbox">
<input type="radio" name="box_opt" value="USPS">
<article><strong>Free Prepaid USPS Label and Box (3-5 days)</strong>
<p>We'll send a prepaid USPS label and a box right to your home or office.</p>
</article>
</li>
</ul>
<p>Note: Be kind to the environment. If you are re-processing an item you previously agreed to send to us and have already requested/received a box, please choose one of the prepaid shipping label options above.</p>
<input type="submit" value="Continue" name="boxtype">
</form>
</section>

<?php include_once("inc/right-cart.php"); ?>


</section>
<?php include_once("inc/footer.php"); ?>
</section></section>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#butnCart').click(function(){
		$('#sellcart ul').slideToggle('slow')
		})
	$('#agreement').submit(function(){
		if($('#terms').prop('checked')==false) {
			alert('You must agree to our tems and conditinos')
			return false;
		}
		})
});
</script>
</body>
</html>
<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
require_once('apis/USPSAddressVerify.php');
$verify = new USPSAddressVerify('bumble39');
$msg = NULL;
$userObj = new users;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
if(!isset($_SESSION['order_id']) || empty($_SESSION['order_id'])) {
$_SESSION['order_id'] = $userObj->randomOrder();
}
$sess_id = $_SESSION['order_id'];
$last_sell = $sess_id;
if(isset($_POST['boxtype'])) {
	$box_type = $_POST['box_opt'];
	$query = "update trades set box_type = '".$box_type."' where user_id = ".$userid." and sessid='".$sess_id."'";
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
body{margin:0 !important;}
#center_mid_container {min-height:400px; font:13px calibri; padding:10px 0 0 0; clear:both;}
#sellcart {list-style:none; float:right; width:24%; max-width:230px;}
#sellcart li {padding:5px 3px; margin:5px auto; border-bottom:2px solid #333;}
#sellcart img {display:block; margin-bottom:5px;}
#sellcart strong {font:bold 13px calibri;}
#sellcart p {font:12px arial; text-align:left;}
#sellcart a {color:#888; font:bold 11px arial; text-decoration:underline; text-align:right; display:block;}
#const {width:75%; float:left; max-width:750px; padding:20px 0; font:13px calibri;}
#const h2 {font:bold 30px calibri;}
#center_mid_container strong {margin-top:10px; clear:both; font:bold 16px calibri;}
input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 16px calibri; line-height:30px; height:33px;background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); border:1px solid #ffcc00; color:#000; float:right;}
body{margin: 50px;}

select{border:1px solid #ccc;height: 34px;width: 250px; padding: 6px 12px;line-height: 1.42857143; -moz-appearance: none;
    background: url("images/dropDownArrow.png") no-repeat scroll 100% 50% rgba(0, 0, 0, 0);}

.selectwrap{position: relative;float: left;}
.selectwrap:after{content:"";text-align: center;line-height:32px;position: absolute;width: 32px;height: 32px; background: url("images/dropDownArrow.png") no-repeat scroll 100% 50% rgba(0, 0, 0, 0);/*background: #fff;*/right: 1px;top: 1px;pointer-events: none;}
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
$tradequery = "select t.*, a.* from trades t left join address a ON t.address_to_ship = a.add_id where t.user_id = ".$userid." and t.sessid = '".$sess_id."'";
$restTra = mysql_query($tradequery);
$shipdata = mysql_fetch_array($restTra);
$address = new USPSAddress;
$address->setAddress($shipdata['address1']);
$address->setCity($shipdata['city']);
$address->setState($shipdata['state']);
$address->setZip5($shipdata['zip_code']);
$verify->addAddress($address);
//print_r($verify->verify());
//print_r($verify->getArrayResponse());
//var_dump($verify->isError());
if($verify->isSuccess()) {
  echo 'Done';
} else {
//  echo 'Error: ' . $verify->getErrorMessage();
}
?>
<h2>Confirm your details</h2>
<p>Please confirm the following information is correct.</p>
<form action="complete.php" method="post" id="agreement">
<ul id="shiping">
<li class="full">
<strong>Contact Email Address</strong>
<article>
<p><?php echo $_SESSION['user_email']; ?></p>
</article>
</li>
<li class="half">
<strong>Payment Detail</strong>
<article>
<?php if($shipdata['paypal_id']) { ?>
<strong>To Paypal ID</strong>
<p><?php echo $shipdata['paypal_id']; ?></p>
<?php } elseif ($shipdata['check_address']) { ?>
<strong>Send Check To:</strong>
<?php
$addressQry = "select * from address where add_id=".$shipdata['check_address'];
$addressRst = mysql_query($addressQry);
$addressData = mysql_fetch_array($addressRst);
?>
<p>
<?php echo $userObj->getUserDetail($_SESSION['user_email'])->first_name.' '.$userObj->getUserDetail($_SESSION['user_email'])->last_name; ?> <br><?php echo $addressData['address1']; ?><br>
<?php if($addressData['address2']) { ?>
<?php echo $addressData['address2']; ?><br>
<?php } ?>
<?php echo $addressData['city']; ?>, <?php echo $addressData['state']; ?> <?php echo $addressData['zip_code']; ?> <?php echo $addressData['country']; ?><br><br><br><br>
</p>
<?php } elseif ($shipdata['charity']) { ?>
<strong>Donate to:</strong>
<p><?php echo $shipdata['charity']; ?></p>
<?php } ?>
</article>
</li>
<li class="half">
<strong>Shipping Detail</strong>
<article>

<p>We'll send a <?php if ($box_type=='USPS'):?>box and <?php endif;?><?php // echo $box_type;?>pre-paid Label to:</p>
<p><?php echo $shipdata['address1']; ?><br><?php echo $shipdata['address2']; ?><br><?php echo $shipdata['city']; ?>, <?php echo $shipdata['state']; ?>, <?php echo $shipdata['zip_code']; ?><br><?php echo $shipdata['country']; ?></p>
</article>
</li>
<li class="half">
<strong>How did you hear about us?</strong>
<article style="height:60px; padding:15px;" >
<div class="selectwrap">
      <select>
        <option value="">- Choose One -</option>
<option value="billboard_transit_ad">Billboard/Transit Ad</option>
<option value="friend_or_family_member">Friend or Family Member</option>
<option value="internet">Internet</option>
<option value="magazine_or_newspaper">Magazine or Newspaper</option>
<option value="news_article_or_story">News Article or Story</option>
<option value="other">Other</option>
<option value="podcast">Podcast</option>
<option value="radio">Radio</option>
<option value="tv">TV</option>
      </select>
</div>



<!--<select class="fancy">
<option value="">- Choose One -</option>
<option value="billboard_transit_ad">Billboard/Transit Ad</option>
<option value="friend_or_family_member">Friend or Family Member</option>
<option value="internet">Internet</option>
<option value="magazine_or_newspaper">Magazine or Newspaper</option>
<option value="news_article_or_story">News Article or Story</option>
<option value="other">Other</option>
<option value="podcast">Podcast</option>
<option value="radio">Radio</option>
<option value="tv">TV</option>
</select>-->
</article>
</li>
<li class="half">
<strong>Terms of Service</strong>
<article>
<p><input type="checkbox" id="terms" name="terms"> By checking this box, you agree to our <a href="http://bumblebeewireless.com/terms/" target="_blank" style="text-decoration:underline;">terms of service</a> and confirm that the item(s) you are selling have not been reported lost or stolen.</p>
</article>
</li>
<input type="submit" value="Confirm" name="confirm_detail" id="confirm" style="margin-right:37px; float:right;">
</form>

</ul>
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
		if($('#terms').prop('checked')==false) {
			alert('You must agree to our tems and conditinos')
			return false;
		}
		})
});
</script>
</body>
</html>
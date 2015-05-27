<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
$msg = NULL;
$userObj = new users;
if(!isset($_SESSION['order_id']) || $_SESSION['order_id']=='') {
$_SESSION['order_id'] = $userObj->randomOrder();
}
if(!isset($_SESSION['login_status']) || $_SESSION['login_status']!=1) {
	header("location:index.php");
}
if(isset($_GET['action']) && $_GET['action']=="delete") {
	$id = $_GET['id'];
	$delq = "delete from address where add_id=".$id;
	echo $delq;
	if(mysql_query($delq)) {
		header("location: addresses.php");
	} else {
		$msg = "Error deleting address";
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
<script src="inc/functions.js" language="javascript"></script>
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
$cqicq = "select * from cart where sessid='".$_SESSION['order_id']."'";
$cqicr = mysql_query($cqicq);
if(mysql_num_rows($cqicr)==0) { ?>
Please add any product to box before process <a href="http://bumblebeewireless.com/trade-in-gadgets">Click Here</a> to go back.
<?php } else {
echo $msg;
?>
<ul class="steps">
<li class="disable"><a href="index.php">Step 1</a></li>
<li><a href="payment-type.php">Step 2</a></li>
<li class="disable"><a href="ship-opt.php">Step 3</a></li>
</ul>
<h2>Click on one of the payment options below to get paid.</h2>
<p style="padding-bottom:5px;">We'll initiate payment after your item has been inspected and accepted.</p>
<ul id="sellPayOpt">
<li>
<h4 style="padding-left:40px;">Fast</h4>
<img src="images/paypal_select.jpg" alt="paypal">
<p><strong>PayPal:</strong> No need to wait. 
Get paid fast through your Pay-pal account</p>
</li>
<?php
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$chkAdrQry = "select * from address where user_id=".$userid;
$chkAdrRslt = mysql_query($chkAdrQry);
if(mysql_num_rows($chkAdrRslt)>0): ?>
<li class="selected">
<?php else:?>
<li>
<?php endif;?>

<h4 style="padding-left:22px;">Standard</h4>
<img src="images/check_select.jpg" alt="Check">
<p><strong>Check:</strong> Get paid via standard bank check, delivered by mail within 10 days</p>
</li>
<li>
<h4 style="padding-left:15px;">Charitable</h4>
<img src="images/charity_select.jpg" alt="Charity">
<p><strong>Donate to Charity:</strong> Give the value of your items to a good cause</p>
</li>
</ul>

<?php
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$paypalQry = "select paypal_id from trades where user_id=".$userid." and sessid='".$_SESSION['order_id']."' and paypal_id IS NOT NULL";
$paypalRslt = mysql_query($paypalQry);
$paypalData = mysql_fetch_array($paypalRslt);
$paypalid = $paypalData['paypal_id'];
?>
<form action="ship-opt.php" method="post" id="paypalForm">
<p>Confirm your PayPal email address so we can ensure prompt payment.</p>
<label>Enter the email address associated with your PayPal account</label>
<input type="email" name="paypal_payment" <?php if($paypalid) {?> value="<?php echo $paypalid; ?>"<?php } ?>required>
<label>Confirm your PayPal email address</label>
<input type="email" name="confirm_paypal_payment" <?php if($paypalid) {?> value="<?php echo $paypalid; ?>"<?php } ?>required>
<input type="submit" name="sub_paypal" value="Submit" style="float:right;">
<input type="hidden" name="pay_type" value="paypal">
</form>

<?php
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$chkAdrQry = "select * from address where user_id=".$userid;
$chkAdrRslt = mysql_query($chkAdrQry);
if(mysql_num_rows($chkAdrRslt)>0): ?>
<form action="ship-opt.php" method="post" id="standardForm"  style="display: block;">
<?php else:?>
<form action="ship-opt.php" method="post" id="standardForm">
<p>Please create an address you'd like your check sent to.</p>
<?php endif;?>
<?php
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$chkAdrQry = "select * from address where user_id=".$userid;
$chkAdrRslt = mysql_query($chkAdrQry);
if(mysql_num_rows($chkAdrRslt)>0): ?>
<ul id="chkadress">
<?php while($cadr = mysql_fetch_array($chkAdrRslt)) { ?>
<li>
<input type="radio" name="chkadr" value="<?php echo $cadr['add_id']; ?>" onClick="showcurImg(this.value);">
<address>
<?php $name=  $userObj->getUserDetail($_SESSION['user_email'])->first_name;
$lname= $userObj->getUserDetail($_SESSION['user_email'])->last_name; 
?>
<strong><?php echo $name.' '.$lname; ?><?php // echo $name.' '.$lanme; //$cadr['address_name']; ?> <?php // echo $cadr['address_name']; ?></strong><br>
<p><?php echo $cadr['address1']; ?></p>
<?php if($cadr['address2']) { ?>
<p><?php echo $cadr['address2']; ?></p>
<?php } ?>
<p><?php echo $cadr['city']. ", ". $cadr['state']." ".$cadr['zip_code']; ?></p>
<p><?php echo $cadr['country']; ?></p>
</address>
</li>
<?php } ?>
</ul>
<?php endif; ?>
<?php /*?><a href="add-address.php" style="float:left;"><strong>Add Address</strong> | </a><div id="divcurImg" style="float:left; padding-left:3px;"> <a href="#"><strong>Edit Address</strong> | </a> <a href="#"><strong>Delete Address</strong></a></div><?php */?>

<?php if(mysql_num_rows($chkAdrRslt)==0): ?>
<a href="add-address.php" style="background:-webkit-linear-gradient(top,#fffc62,#ffca00);
background:-moz-linear-gradient(top,#fffc62,#ffca00);
background:-ms-linear-gradient(top,#fffc62,#ffca00);
background:-o-linear-gradient(top,#fffc62,#ffca00); border: 1px solid #ffcc00; border-radius: 7px; clear: both; color: #000; display: inline-block; font: bold 18px/28px calibri; height: 32px; margin: 10px 0px; width:135px; text-align:center; padding: 0px;">Add Address</a>
<?php endif;?>
<?php if(mysql_num_rows($chkAdrRslt)>0): ?>
<div style="float:left; padding:10px 0; font-size:13px;">Select address above to send your check to and click continue.</div>
<input type="submit" name="sub_cheque" value="Continue" style="float:right; 
background:-webkit-linear-gradient(top,#fffc62,#ffca00);
background:-moz-linear-gradient(top,#fffc62,#ffca00);
background:-ms-linear-gradient(top,#fffc62,#ffca00);
background:-o-linear-gradient(top,#fffc62,#ffca00); border: 1px solid #ffcc00; border-radius: 7px; clear: none; color: #000; font: bold 18px/28px calibri; height: 32px; margin: 10px 0px; text-align:center; cursor:pointer;">
<?php endif;?>
<input type="hidden" name="pay_type" value="cheque">
</form>
<form action="ship-opt.php" method="post" id="charityForm">
<label style="font:bold 18px calibri;">Select your chartity of choice below</label>
<select name="charity" class="fancy">
<option value="ASCEND Foundation">ASCEND Foundation</option>
<option value="AmeriCares Foundation">AmeriCares Foundation</option>
<option value="American Cancer Society">American Cancer Society</option>
<option value="American Heart Association">American Heart Association</option>
<option value="American Red Cross">American Red Cross</option>
<option value="Boston One Fund">Boston One Fund</option>
<option value="Boy Scouts of America">Boy Scouts of America</option>
<option value="Boys & Girls Club of America">Boys & Girls Club of America</option>
<option value="CARE United States">CARE United States</option>
<option value="Catholic Charities USA">Catholic Charities USA</option>
<option value="Catholic Relief Services">Catholic Relief Services</option>
<option value="Easter Seals">Easter Seals</option>
<option value="Environmental Defense Fund">Environmental Defense Fund</option>
<option value="Feed the Children">Feed the Children</option>
<option value="Food for the Poor">Food for the Poor</option>
<option value="Fund for Teachers">Fund for Teachers</option>
<option value="Gifts in Kind">Gifts in Kind</option>
<option value="Girl Scouts of the United States">Girl Scouts of the United States</option>
<option value="Goodwill Industries">Goodwill Industries</option>
<option value="Habitat For Humanity">Habitat For Humanity</option>
<option value="Keep America Beautiful">Keep America Beautiful</option>
<option value="Living Lands & Waters">Living Lands & Waters</option>
<option value="Memorial Sloan-Kettering Cancer Center">Memorial Sloan-Kettering Cancer Center</option>
<option value="NRDC">NRDC</option>
<option value="National Fatherhood Initiative">National Fatherhood Initiative</option>
<option value="Ocean Conservancy">Ocean Conservancy</option>
<option value="Operation Smile">Operation Smile</option>
<option value="Partners In Health">Partners In Health</option>
<option value="Planned Parenthood Federation of America">Planned Parenthood Federation of America</option>
<option value="SHARED ">SHARED </option>
<option value="Salvation Army">Salvation Army</option>
<option value="Shriners Hospital for Children">Shriners Hospital for Children</option>
<option value="Sodexo Foundation to Help STOP Hunger">Sodexo Foundation to Help STOP Hunger</option>
<option value="StandUp For Kids">StandUp For Kids</option>
<option value="The Nature Conservancy">The Nature Conservancy</option>
<option value="United Jewish Communities">United Jewish Communities</option>
<option value="Volunteers of America">Volunteers of America</option>
<option value="World Vision">World Vision</option>
<option value="YMCAs in the US">YMCAs in the US</option>
<option value="YWCA USA ">YWCA USA </option>
</select>
<input type="submit" name="sub_charity" value="Continue" style="float:right; background: -moz-linear-gradient(center top , #fffc62, #ffca00) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #ffcc00;
    border-radius: 7px;
    clear: both;
    color: #000;
    display: inline-block;
    font: bold 18px/28px calibri;
    height: 32px;
    margin: 10px 20px;
    padding: 0 15px;">
<input type="hidden" name="pay_type" value="charity">
</form>
</section>
<?php include_once("inc/right-cart.php"); ?>
<div class="clear"></div>
<?php } ?>
<div class="clear"></div>                    
</section>
<?php include_once("inc/footer.php"); ?>
</section></section>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#butnCart').click(function(){
		$('#sellcart ul').slideToggle('slow')
		})
		$('#sellPayOpt li').click(function(){
		$('#sellPayOpt li').each(function() {
              $(this).removeClass('selected');
			  $('form').each(function() {
				$(this).slideUp('slow')
            });
        });
		$(this).addClass('selected')
		var pOpt = $(this).index()
		if(pOpt==0) {
			$('#paypalForm').slideDown('slow')
		} else if (pOpt==1) {
			$('#standardForm').slideDown('slow')
		} else if (pOpt==2) {
			$('#charityForm').slideDown('slow')
		}
		})
			
			
	
});
</script>
</body>
</html>
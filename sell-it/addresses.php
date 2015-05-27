<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
include_once("inc/security.php");
$msg = NULL;
$userObj = new users;
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
<title>Welcome To Bumblebee</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.account-pages {padding:10px 15px; box-sizing:border-box; font:13px arial;}
.account-pages h2 {margin-bottom:10px;}
.account-pages p, .account-pages strong {margin-bottom:5px;}
.account-pages input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 14px calibri; line-height:22px; height:22px; padding:0 10px; background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); border:1px solid #ffcc00;}
</style>
</head>
<body>
<?php include_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container">
        <?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container">
	<section id="left_menu_container">
    		<section class="left_cat">
            	<ul>
                	<li><a href="trades.php">Your Trades</a></li>
                	<li><a href="account.php">Password &amp; Email</a></li>
                	<li><a href="addresses.php">Stored Addresses</a></li>
                    </ul></section></section>
                    <section id="right_side_container">
                    	<section class="products_heading">Account Summary</section>
                        <section class="account-pages">
                        <h2>Your Addresses 
						<?php if($userObj->getAddress($_SESSION['user_email'])): 
						$name=  $userObj->getUserDetail($_SESSION['user_email'])->first_name; 
						$lname=  $userObj->getUserDetail($_SESSION['user_email'])->last_name; 
						//print_r($userObj);
						
						?>
                        <?php foreach($userObj->getAddress($_SESSION['user_email']) as $address): ?>
                        <?php
						//print_r($address);
						 if($address->address_status==0): ?>
                        <?php $mstat = '<p style="color:blue;">Pending</p>'; ?>
                        <?php elseif($address->address_status==1): ?>
                        <?php $mstat = '<p style="color:green;">Verfied</p>'; ?>
                        <?php elseif($address->address_status==2): ?>
                        <?php $mstat = '<p style="color:red;">Invalid</p>'; ?>
                        <?php endif; ?></h2>
                        <p><?php // echo $msg; ?></p>
                        <strong><?php echo $name.' '.$lname; ?></strong>
                        <p><?php echo $address->address1; ?>,<br>
                        <?php if($address->address2): ?>
						<?php echo $address->address2; ?><br>
                        <?php endif; ?>
                        <?php echo $address->city; ?>, <?php echo $address->state; ?><br>
                        <?php echo $address->country; ?>, <?php echo $address->zip_code; ?><br>
                        <?php echo $address->phone; ?></p>
                         <a href="add-address.php"><strong>Add Address</strong></a> | <a href="edit-address.php?id=<?php echo $address->add_id; ?>"><strong>Edit Address</strong></a> | <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&id=<?php echo $address->add_id; ?>"><strong>Delete Address</strong></a>
                        <hr>
                        <?php endforeach; ?>
                        <?php endif; 
						//echo count($userObj)."hear";
						$user_id = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
						$chkQry=mysql_query("select * from address where user_id='".$user_id."'") or die(mysql_error());
						$numchk=mysql_num_rows($chkQry);
						?>
                       
                        </section><!--Account Pages-->
                         <section>
                       <?php if($numchk>0){ ?>  <a href="payment-type.php" id="paymentpage"><strong>Continue</strong></a><?php }else{ ?><a href="add-address.php" id="paymentpage" style="float:left;"><strong>Add Address</strong></a><?php }?>
                       </section>
</section></section>
<?php include_once("inc/footer.php"); ?>
</section></section>

</body>
</html>
<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
include_once("inc/security.php");
$msg = NULL;
$userObj = new users;
if(isset($_POST['add_address'])) {
	$address_name = addslashes($_POST['add_name']);
	$address1 = addslashes($_POST['add']);
	$address2 = addslashes($_POST['add2']);
	$city = addslashes($_POST['city']);
	$state = addslashes($_POST['state']);
	$zip_code = addslashes($_POST['zip']);
	$country = addslashes($_POST['country']);
	$phone = addslashes($_POST['phone']);
	$user_id = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
	$query = "insert into address (user_id, address_name, address1, address2, city, state, zip_code,phone,country) values (".$user_id.", '".$address_name."', '".$address1."', '".$address2."', '".$city."', '".$state."', '".$zip_code."','".$phone."','".$country."')";
	if(mysql_query($query)) {
		header("location: addresses.php");
	} else {
		$msg = "Can't Add Address, try again ".mysql_error();
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
#addForm {}
#addForm label {font:bold 16px calibri; display:block; clear:both; margin:7px auto 3px;}
#addForm input {max-width:100%; width:250px;}
#addForm input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 18px calibri; line-height:28px; height:32px;  background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); width:auto; border:1px solid #ffcc00; color:#000;}
</style>
<script src="gen_validatorv4.js" type="text/javascript"></script>
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
                        <h2>Create Addresses</h2>
                        <?php echo $msg;?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="addForm">
                        <label>First Name</label>
                        <input type="text" name="add_name" value="<?php echo $userObj->getUserDetail($_SESSION['user_email'])->first_name; ?>" required>
                         <label>Last Name</label>
                        <input type="text" name="add_name" value="<?php echo $userObj->getUserDetail($_SESSION['user_email'])->last_name; ?>" required>
                       
                        <label>Address</label>
                        <input type="text" name="add" required>
                        <label>Address 2</label>
                        <input type="text" name="add2">
                        <label>City</label>
                        <input type="text" name="city" required>
                        <label>State</label>
                        <input type="text" name="state" required>
                        <label>Zip Code</label>
                        <input type="text" name="zip" required>
                        <label>Country</label>
                        <input type="text" name="country" required>
                        <label>Phone</label>
                        <input type="text" name="phone" required>
                        <input type="submit" name="add_address" value="Add Address">
                        </form>
                        </section><!--Account Pages-->
                        
</section></section>
<?php include_once("inc/footer.php"); ?>
</section></section>
<script  type="text/javascript">
 var frmvalidator = new Validator("addForm");

frmvalidator.addValidation("city","req","Please enter your City");
frmvalidator.addValidation("city","alphabetic_space","Please enter your correct city name");

frmvalidator.addValidation("state","req","Please enter your correct state");
frmvalidator.addValidation("state","alphabetic_space","Please enter your correct state");
 
frmvalidator.addValidation("zip","maxlen=50");
frmvalidator.addValidation("zip","numeric", "Please enter your numeric Zipcode  Example: 2451");

frmvalidator.addValidation("phone","maxlen=50");
frmvalidator.addValidation("phone","numeric", "Please enter your phone number  Example: 5051234567");


</script>
</body>
</html>
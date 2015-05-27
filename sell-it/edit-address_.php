<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
include_once("inc/security.php");
$msg = NULL;
$userObj = new users;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<title>Welcome To Bumblebee</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="gen_validatorv4.js" type="text/javascript"></script>
<style type="text/css">
.account-pages {padding:10px 15px; box-sizing:border-box; font:13px arial;}
.account-pages h2 {margin-bottom:10px;}
.account-pages p, .account-pages strong {margin-bottom:5px;}
#editForm {}
#editForm label {font:bold 16px calibri; display:block; clear:both; margin:7px auto 3px;}
#editForm input {max-width:100%; width:250px;}
#editForm input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px;  color: #000;  font: bold 18px calibri; height: 30px!important; line-height: 25px!important ; margin: 10px 0px; background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); width:80px !important; border:1px solid #ffcc00;}
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
                        <?php
						if($_REQUEST['act']==1){
						$id = $_GET['id'];	
						$add_name=$_REQUEST['add_name'];
						$add=$_REQUEST['add'];
						$add2=$_REQUEST['add2'];
						$city=$_REQUEST['city'];
						$state=$_REQUEST['state'];
						$zip=$_REQUEST['zip'];	
						$country=$_REQUEST['country'];
						$phone=$_REQUEST['phone'];
						mysql_query("update address set address1='$add',address2='$add2',city='$city',state='$state',zip_code='$zip',country='$country',phone='$phone',address_name='$add_name' where add_id='$id' ") or die(mysql_error());
							$ms=7;?>
						<script>
                        window.location='addresses.php';
                        </script>	
							<?php }
 						$id = $_GET['id'];
						$getQry = "select * from address where add_id =".$id;
						$result = mysql_query($getQry);
						if(mysql_num_rows($result)>0):
						$addData = mysql_fetch_array($result);
						?>
                        
                        <h2>Edit Addresses</h2>
                        <p style="color:#F00">
						<?php if($ms==7){echo '<strong>Address has been updated successfully</strong>';} ?>
                        </p>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>?act=1&id=<?php echo $id;?>" method="post" id="editForm">
                        <label>Name</label>
                        <input type="text" name="add_name" value="<?php echo $userObj->getUserDetail($_SESSION['user_email'])->first_name; ?>" required  readonly >
                        <label>Address</label>
                        <input type="text" name="add" value="<?php echo $addData['address1']; ?>" required>
                        <label>Address 2</label>
                        <input type="text" name="add2" value="<?php echo $addData['address2']; ?>"  >
                        <label>City</label>
                        <input type="text" name="city" value="<?php echo $addData['city']; ?>" required>
                        <label>State</label>
                        <input type="text" name="state" value="<?php echo $addData['state']; ?>" required>
                        <label>Zip Code</label>
                        <input type="text" name="zip" value="<?php echo $addData['zip_code']; ?>" required>
                        <label>Country</label>
                        <input type="text" name="country" value="<?php echo $addData['country']; ?>" required>
                        <label>Phone</label>
                        <input type="text" name="phone" value="<?php echo $addData['phone']; ?>" required>
                        <input type="submit" name="add_address" value="Save">
                        </form>
                        <?php endif; ?>
                        </section><!--Account Pages-->
                        
</section></section>
<?php include_once("inc/footer.php"); ?>
</section></section>
<!--<script  type="text/javascript">
 var frmvalidator = new Validator("editForm");

frmvalidator.addValidation("city","req","Please enter your City");
frmvalidator.addValidation("city","alphanumeric","Max length for city is 20");
 
frmvalidator.addValidation("city","req","Please enter your City");
frmvalidator.addValidation("city","alphanumeric","Max length for city is 20");


</script>-->
</body>
</html>
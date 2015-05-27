<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
include_once("inc/security.php");
$msg = NULL;
$userObj = new users;
if(isset($_POST['updateInfo'])) {
$u_email = $_POST['user_email'];
$u_fname = addslashes($_POST['first_name']);
$u_lname = addslashes($_POST['last_name']);
$userid = $_POST['user_id'];
$checkq = "select * from users where user_email = '".$u_email."' and user_id=".$userid;
$echeckr = mysql_query($checkq);
/*if(mysql_num_rows($echeckr)>0) {
	$msg = "Email you updated is already assigned to other user";
} else {*/
// $query = "update users set first_name = '".$u_fname."', last_name = '".$u_lname."', user_email = '".$u_email."' where user_id = ".$userid;
$query = "update users set first_name = '".$u_fname."', last_name = '".$u_lname."' where user_id = ".$userid;
if(mysql_query($query)) {
	$_SESSION['user_email'] = $u_email;
	$msg = "Update Successfully!";
} else {
	$msg = "Error Updating!";
}
//}
}
if(isset($_POST['changePassword'])) {
	$newpass = $_POST['new_password'];
	$cnewpass = $_POST['c_new_password'];
	$p_user_id = $_POST['p_user_id'];
	$uppass = md5($newpass);
	if($newpass!=$cnewpass) {
		$msg = "Passwords doesn't match";
	} else {
		$query = "update users set password = '".$uppass."' where user_id = ".$p_user_id;
		if(mysql_query($query)) {
			$msg = "Passwords changed successrully!";
		} else {
			$msg = "Error changing password";
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
<title>Welcome To Bumblebee</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.account-pages {padding:10px 15px; box-sizing:border-box; font:13px arial;}
.account-pages h2 {margin-bottom:10px;}
.account-pages p, .account-pages strong {margin-bottom:5px;}
.account-pages input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 18px calibri; line-height:28px; height:32px; background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); width:150px !important; background:-o-linear-gradient(top,#fffc62,#ffca00); border:1px solid #ffcc00; color:#000;}
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
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2>Welcome <?php echo $userObj->getUserDetail($_SESSION['user_email'])->first_name . " " . $userObj->getUserDetail($_SESSION['user_email'])->last_name; ?></h2>
                        <p style="color:#008040; font-weight:bold;"><?php echo $msg; ?></p>
                        <strong>Your Email</strong>
                        <p>
						<input type="email" name="user_email" value="<?php echo $_SESSION['user_email']; ?>"  readonly>
                        </p>
                        <strong>Your First Name</strong>
                        <p><input type="text" name="first_name" value="<?php echo $userObj->getUserDetail($_SESSION['user_email'])->first_name; ?>"></p>
                        <strong>Your Last Name</strong>
                        <p>
						<input type="text" name="last_name" value="<?php echo $userObj->getUserDetail($_SESSION['user_email'])->last_name; ?>">
                        </p>
                        <input type="hidden" name="user_id" value="<?php echo $userObj->getUserDetail($_SESSION['user_email'])->user_id; ?>">
                        <input type="submit" value="Update Info" name="updateInfo">
                        </form>
                        <h2>Change Password</h2>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <strong>New Password</strong>
                        <p style="  margin-bottom: 10px;">
						<input type="password" name="new_password" />
                        </p>
                        <strong>Confirm New Password</strong>
                        <p>
						<input type="password" name="c_new_password" />
                        </p>
                        <input type="hidden" name="p_user_id" value="<?php echo $userObj->getUserDetail($_SESSION['user_email'])->user_id; ?>">
                        <input type="submit" value="Change Password" name="changePassword" style="margin-top:34px;">
                        </form>
                        </section><!--Account Pages-->
                        
</section></section>
<?php include_once("inc/footer.php"); ?>
</section></section>

</body>
</html>
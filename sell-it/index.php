<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
$msg = NULL;
$userObj = new users;
if(!isset($_SESSION['order_id']) || $_SESSION['order_id']=='') {
$_SESSION['order_id'] = $userObj->randomOrder();
}
if(isset($_POST['add_selling'])) {
$prodName = addslashes($_POST['sell_item']);
$price = addslashes($_POST['sell_price']);
$path = $_POST['sell_pic'];
$query = "insert into cart (sessid, item_name, item_price, item_pic) values ('".$_SESSION['order_id']."','".$prodName."','".$price."','".$path."')";
if(mysql_query($query)) {
	$msgadd = "You have selected <strong>".$prodName . "</strong> to sell or donate.";
} else {
	$msg = mysql_error();
}
}
if (isset($_POST['create_account'])) {
$first_name = addslashes($_POST['first_name']);
$last_name = addslashes($_POST['last_name']);
$user_email = addslashes($_POST['user_email']);
$password = md5($_POST['user_pass']);
$query = "insert into users (user_email,password,first_name,last_name) values ('".$user_email."','".$password."','".$first_name."','".$last_name."')";
if(mysql_query($query)) {
	$_SESSION['login_status'] = 1;
	$_SESSION['username'] = $first_name . " " . $last_name;
	$_SESSION['user_email'] = $user_email;
} else {
	$msg = "Existing Account Detected";
}
}
if(isset($_POST['logins'])) {
	$useremail = mysql_real_escape_string($_POST['user_email']);
	$pass = md5($_POST['user_pass']);
	if($userObj->validateLogin($useremail,$pass)) {
		$_SESSION['login_status'] = 1;
		$_SESSION['username'] = $userObj->getUserDetail($useremail)->first_name . " " . $userObj->getUserDetail($useremail)->last_name;
		$_SESSION['user_email'] = $userObj->getUserDetail($useremail)->user_email;
	} else {
		if($userObj->getUserDetail($useremail)) {
		$msg = "Invalid Password";
		} else {
			$msg = "No account associated with this email";
			
		}
	}
}
if(isset($_SESSION['login_status']) && $_SESSION['login_status']==1) {
	header("location:payment-type.php");
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sell It</title>
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link href="style.css" rel="stylesheet" type="text/css">
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
Please add any product to box before process <a href="http://bumblebeewireless.com/">Click Here</a> to go back.
<?php } else { ?>
<?php echo $msgadd;
?>
<span style="color:#F00; font-size:18px; font-weight:bold;">
<?php echo $msg;
?>
</span>
<p>Please <a href="login.php">Login</a> with your existing account or <a href="signup.php">Create New Account</a> to complete the process.</p>
<ul class="steps">
<li><a href="index.php">Step 1</a></li>
<li class="disable"><a href="payment-type.php">Step 2</a></li>
<li class="disable"><a href="ship-opt.php">Step 3</a></li>
</ul>
<section class="resigter-login">
<form method="post" action="<?php echo basename($_SERVER['PHP_SELF']); ?>" name="login-resiger" id="register-form-home" autocomplete="off">
    <strong class="heading">New Customers</strong>
    <p>Create an account below, so that we can send you a free shipping label &amp; pay you</p>
    <label>First Name</label>
    <input type="text" name="first_name" required autocomplete="off">
    <label>Last Name</label>
    <input type="text" name="last_name" required autocomplete="off">
    <label>Email Address</label>
    <input type="email" name="user_email" id="signupemail" required autocomplete="off">
    <p class="statusemail"></p>
    <label>Confirm Email Address</label>
    <input type="email" name="confirm_email" id="signupconfirm" required autocomplete="off">
    <p class="statusconfirm"></p>
    <label>Password</label>
    <input type="password" name="user_pass" required autocomplete="off">
    <p style="margin:10px 0;"><input type="checkbox" id="termscon" name="agreement" value="agree" style="float:left; margin-top:-2.5px;"><a href="http://bumblebeewireless.com/selling-agreement" target="_blank">I agree with terms and conditions.</a></p>
    <input type="submit" name="create_account" value="Create an Account">
    </form>
</section>

<section class="resigter-login reghome">
<form method="post" action="<?php echo basename($_SERVER['PHP_SELF']); ?>" name="login-resiger" id="loginFormHome" autocomplete="off">
    <strong class="heading">Returning Customers</strong>
    <p>Already have an account? Quickly login by entering your email login below</p>
    <label>Email Address</label>
    <input type="email" name="user_email" required autocomplete="off">
    <label>Password</label>
    <input type="password" name="user_pass" required autocomplete="off">
    <a href="forget-password.php">Forget your password?</a>
    <p><input type="checkbox" name="remember" value="remember" style="margin-top:-3px;">Keep me signed in</p>
    <p align="center">(Uncheck if on a shared computer)</p>
    <input type="submit" name="logins" value="Login">
    </form>
</section>

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
			
		$('#register-form-home').submit(function(){
			if($('#termscon').prop('checked') == true) {
				var supe = $('#signupemail').val()
				var supc = $('#signupconfirm').val()
				if(supe!=supc) {
					alert('Your email and confirm email not matched')
					return false
				} else {
					return true
				}
			} else {
				alert('You must agree to terms & conditions')
				return false
			}
			})	
	
});
</script>
</body>
</html>
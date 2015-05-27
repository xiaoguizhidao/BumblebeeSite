<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
require_once("inc/security.php");
$userObj = new users;
$msg = NULL;
if(isset($_POST['logins'])) {
	$useremail = mysql_real_escape_string($_POST['user_email']);
	$pass = md5($_POST['user_pass']);
	if($userObj->validateLogin($useremail,$pass)) {
		$_SESSION['login_status'] = 1;
		$_SESSION['username'] = $userObj->getUserDetail($useremail)->first_name . " " . $userObj->getUserDetail($useremail)->last_name;
		$_SESSION['user_email'] = $userObj->getUserDetail($useremail)->user_email;
		header("location:index.php");
	} else {
		if($userObj->getUserDetail($useremail)) {
		$msg = "Invalid Password";
		} else {
			$msg = "No account associated with this email";
			
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
<script type="text/javascript" lang="javascript" src="http://cdn.gigya.com/JS/socialize.js?apikey=<?php echo $apiKey; ?>"></script>
<style type="text/css">
.padding {padding:10px 0; box-sizing:border-box; margin:0 auto; display:block; clear:both; font:16px calibri;}
.loginpage {width:100%; padding:10px 0%; box-sizing:border-box; margin:10px auto; border-radius:12px;}
.loginpage h2 {font:bold 30px calibri;}
#loginForm {margin-bottom:40px;}
#loginForm input[type="submit"] {    border: 1px solid #ffcc00;
    border-radius: 7px;
    clear: both;
    color: #000;
    display: block;
    font: bold 18px/30px calibri !important;
    height: 35px !important;
    margin: 10px auto;
    padding: 0 15px;
    width: 100px !important;
	background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00);}
#loginForm label {font-weight:normal; line-height:20px; font-size:14px;}

</style>
</head>

<body>
<?php include_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container">
        <?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container" class="padding">
	<section class="loginpage">
    <h2>Login</h2>
    <p style="color:#F00;"><?php echo $msg; ?></p>
    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="loginForm" id="loginForm">
    <label>Email Address</label>
    <input type="email" name="user_email" required>
    <label>Password</label>
    <input type="password" name="user_pass" required>
    <input type="hidden" name="login" value="1">
    <input type="submit" name="logins" value="Log In">
    <a href="signup.php" class="lstlinks">Create Account</a>
    <a class="lstlinks" href="forget-password.php">Forget Password</a>
    </form>
    
    </section>
                    </section>
<?php include_once("inc/footer.php"); ?>
</section></section>
</body>
</html>
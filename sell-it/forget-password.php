<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
$userObj = new users;
$msg = NULL;
if(isset($_POST['submit'])) {
	$useremail = mysql_real_escape_string($_POST['user_email']);
	if($userObj->getUserDetail($useremail)) {
		$newpass = $userObj->randomPassword();
		if($userObj->resetPassword($useremail,$newpass)) {
			//$headers = "From: <no-reply@bumblebeewireless.com>";
			//$subject = "Password for Bumblebee Wireless Sell It Account";
			$mlmsg = '<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
    <tr>
        <td align="center" valign="top" style="padding:30px 0 20px 0">
            <table bgcolor="FFFFFF" cellspacing="0" cellpadding="10" border="0" width="800" style="border-top:5px solid #ffe115; border-bottom:5px solid #ffe115;">
                <tr>
                    <td valign="top">
                        <a href="http://bumblebeewireless.com/" style="color:#1E7EC8;"><img src="http://bumblebeewireless.com/sell-it/images/email.jpg"  alt="Bumblebee Wireless" border="0"/></a>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <h1 style="font-size:22px; font-weight:normal; line-height:22px; margin:0 0 11px 0;">Reset Password,</h1>
                        <p style="font-size:12px; line-height:16px; margin:0 0 8px 0;">You have indicated that you have forgotten your password for the member profile associative with '.$useremail.'<strong><br><br>Your new password is:</strong> '.$newpass.'</p>
                     </td>
                </tr>
				 <tr>
                    <td valign="top">
                        <a href="http://bumblebeewireless.com/sell-it/login.php"  style="background:#3b91cf; border: 1px solid #3b91cf; border-radius: 5px; clear: both; color: #fff; display: inline-block; font: bold 18px/32px calibri; height: 32px; margin: 10px 0px; width:200px; text-decoration:none; text-align:center; padding: 0px;">login To Your Account</a>
                       </td>
                </tr>
              
            </table>
        </td>
    </tr>
</table>';
$subject = "Your Bumblebee Wireless new password";
$headersxx = "From : \"Bumblebee Wireless\" <no-reply@bumblebeewireless.com>
MIME-Version: 1.0
Content-Type: text/html;";

$headers = "From: Bumblebee Wireless <no-reply@bumblebeewireless.com>" . "\r\n";
$headers .= "CC: irfan.mukhtar@xperts.pk\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if(mail($useremail,$subject,$mlmsg,$headers)) {
				$msg .= "Password sent to your email ".$useremail;
			} else {
				$msg .= "Error Reseting Password";
			}
		} else {
			$msg = "password not reset";
		}
	} else {
		$msg = "Invalid email address, <a href=\"signup.php\">create new account</a>";
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
.padding {padding:10px 0; box-sizing:border-box; margin:0 auto; display:block; clear:both; font:16px calibri;}
.loginpage {width:98%; padding:10px 1%; box-sizing:border-box; margin:10px auto; border-radius:12px;}
.loginpage h2 {font:bold 30px calibri;}
#loginForm {float:left; margin-bottom:45px;}
#loginForm label {font:bold 16px calibri; display:block; clear:both; margin:7px auto 3px;}
#loginFormright a { background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00);
    border: 1px solid #ffcc00;
    border-radius: 7px;
    clear: both;
    color: #000;
    display: block;
    font: bold 16px/35px calibri !important;
    height: 35px !important;
    margin: 28px;
    padding: 0 20px;
    width: 100px !important;}
#loginForm input[type="submit"] {    border: 1px solid #ffcc00;
    border-radius: 7px;
    clear: both;
    color: #000;
    display: block;
    font: bold 16px/30px calibri !important;
    height: 35px !important;
    margin: 15px auto;
    padding: 0 15px;
    width: 150px !important;
	background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00);}
#loginForm label {font-weight:normal; line-height:20px; font-size:14px;}
#loginFormright {float:left;}
</style>
</head>

<body>
<?php include_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container"><?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container" class="padding">
	<section class="loginpage">
    <h2>Login</h2>
     <p style="color:#F00;"><?php echo $msg; ?></p>
    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="loginForm" id="loginForm">
    <label>Enter Email to Retrieve Passowrd</label>
    <input type="email" name="user_email" required>
    <input type="submit" name="submit" value="Retrieve Password">
    </form>
    
       <section id="loginFormright"><a href="login.php">Back To Login</a></section>

    </section>
    </section>
<?php include_once("inc/footer.php"); ?>
</section></section>
</body>
</html>
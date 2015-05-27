<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
require_once("inc/security.php");
require_once("apis/GSSDK.php");

$msg = NULL;
$userObj = new users;
if (isset($_POST['submit'])) {
$first_name = addslashes($_POST['first_name']);
$last_name = addslashes($_POST['last_name']);
$user_email = addslashes($_POST['user_email']);
$password = md5($_POST['user_pass']);
$query = "insert into users (user_email,password,first_name,last_name) values ('".$user_email."','".$password."','".$first_name."','".$last_name."')";
if(mysql_query($query)) {
	$_SESSION['login_status'] = 1;
	$_SESSION['username'] = $first_name . " " . $last_name;
	$_SESSION['user_email'] = $user_email;
	header("location:index.php?pass=".$password);
} else {
	$msg = "Error Creating account";
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
.loginpage {width:98%; padding:10px 1%; box-sizing:border-box; margin:10px auto; border-radius:12px;}
.loginpage h2 {font:bold 30px calibri;}
#loginForm {}
#loginForm label {font:bold 16px calibri; display:block; clear:both; margin:7px auto 3px;}
#loginForm input[type="text"], #loginForm input[type="email"], #loginForm input[type="password"] {width:100%; max-width:200px; height:22px; padding:0 5px;}
#loginForm input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 14px calibri; line-height:22px; height:22px; padding:0 10px; background:-webkit-linear-gradient(top,#fffc62,#ffca00);border:1px solid #ffcc00;}
</style>
<!-- gigya.js script should only be included once -->
</head>
<body onLoad="onLoad()">
<?php require_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container"><?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container" class="padding">
	<section class="loginpage">
    <h2>Create Account</h2>
    <p><?php echo $msg; ?></p>
    <a href="login.php">&laquo; Back to Login</a>
    <form method="post" action="<?php echo basename($_SERVER['PHP_SELF']); ?>" name="loginForm" id="loginForm">
    <label>First Name</label>
    <input type="text" name="first_name" required>
    <label>Last Name</label>
    <input type="text" name="last_name" required>
    <label>Email Address</label>
    <input type="email" name="user_email" required>
    <p class="statusemail"></p>
    <label>Confirm Email Address</label>
    <input type="email" name="confirm_email" required>
    <p class="statusconfirm"></p>
    <label>Password</label>
    <input type="password" name="user_pass" required>
    <input type="submit" name="create_account" value="Create Account">
    </form>
<div id="loginDiv"></div>
    <script type="text/javascript">
        gigya.socialize.showLoginUI({containerID: "loginDiv", cid:'', width:220, height:60,
              redirectURL: "http://localhost/bumble-sell-it/postLoginPage.php",
                showTermsLink:false, hideGigyaLink:true // remove 'Terms' and 'Gigya' links
                });
    </script>
</section>
    </section>
    <?php require_once("inc/footer.php"); ?>
    </section>
    
                    

</section></section>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('input[name="user_email"]').focusout(function() {
		var myemail = $(this).val()
        //alert(myemail)
		if($(this).val()!="") {
		$.post("inc/ajax.php?register_email",{'email':myemail},function(data) {
			$('.statusemail').html(data)
		})
		}
    })
	
	$('input[name="confirm_email"]').keyup(function(){
		var cone = $(this).val()
		var eml = $('input[name="user_email"]').val()
		if(cone==eml) {
			$('.statusconfirm').html('Matched')
		} else {
			$('.statusconfirm').html('Not Matched')
		}
		})
});
</script>
</body>
</html>
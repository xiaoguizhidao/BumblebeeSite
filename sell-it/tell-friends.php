<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
$msg = NULL;
$userObj = new users;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
if(isset($_POST['cartId'])) {
	$boxNum = $_POST['cartId'];
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
	$email3 = $_POST['email3'];
	$email4 = $_POST['email4'];
	$email5 = $_POST['email5'];
	$headersxx = "From : \"Bumblebee Wireless\" <no-reply@bumblebeewireless.com>
	MIME-Version: 1.0
	Content-Type: text/html;";
	$mysg = '<table bgcolor="#585958" cellpadding="3" cellspacing="2" width="550" align="center">
 	<tbody>
 	<tr>
    	<td>
        	<table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td><a href="http://bumblebeewireless.com/preview/" target="_blank"><img src="http://bumblebeewireless.com/preview/skin/frontend/default/bumble/images/logo.jpg" alt="Bumblebee Wireless" width="360" height="98" border="0" style="display:block"></a></td>
                 </tr>
            	
            </tbody></table>   
              
            
            <table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">   

                  <tbody><tr>
                	<td colspan="3">

      <table width="550" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
        <tbody><tr>
          <td><table width="500" align="left">
              <tbody><tr>
                <td><p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">your friend '.$_SESSION['username'].' just sold device on bumblebee are got quick cash for used or broken gadgets. Whats your Iphone or android worth get a free quote...<br>
                    <br>
                   we can\'t  verify your address please correct your address to complete process.</p>
                
                  </td>
              </tr>
              <tr>
                <td><p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">                    Thanks,<br>
                    The Bumblebee Wireless Team<br>
                  </p></td>
              </tr>';
									 $mysg .=' </tbody></table>
                        	        </td>
                           		  </tr>
                        </tbody></table>   
                    </td>                                      
        </tr>
      </tbody></table>
</td>
                  </tr>
            </tbody></table>
         </td>
   	 </tr>
 </tbody></table>';
	if($email1) {
		mail($email1,"Bumblebee Wireless",$mysg,$headersxx);
	}
	if($email2) {
		mail($email2,"Bumblebee Wireless",$mysg,$headersxx);
	}
	if($email3) {
		mail($email3,"Bumblebee Wireless",$mysg,$headersxx);
	}
	if($email4) {
		mail($email4,"Bumblebee Wireless",$mysg,$headersxx);
	}
	if($email5) {
		mail($email5,"Bumblebee Wireless",$mysg,$headersxx);
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
#center_mid_container {min-height:350px; font:13px calibri; padding:10px 0 0 0; clear:both;}
#center_mid_container h2 {font:bold 23px arial;}
#center_mid_container p {font:14px arial; color:#343434;}
</style>
</head>

<body>
<?php include_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container">
        <?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container">
<h2>Refer Friends</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label>Friend's Email</label>
<input type="email" name="email1" required>
<label>Friend's Email</label>
<input type="email" name="email2">
<label>Friend's Email</label>
<input type="email" name="email3">
<label>Friend's Email</label>
<input type="email" name="email4">
<label>Friend's Email</label>
<input type="email" name="email5">
<input type="submit" value="Send">
</form>


</section>
<?php include_once("inc/footer.php"); ?>
</section></section>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</body>
</html>
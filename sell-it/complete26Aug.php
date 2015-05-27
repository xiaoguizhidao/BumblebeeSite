<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
$msg = NULL;
$userObj = new users;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
if(!isset($_SESSION['order_id']) || empty($_SESSION['order_id'])) {
$_SESSION['order_id'] = $userObj->randomOrder();
}
$sess_id = $_SESSION['order_id'];
$tradeingId = $sess_id;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sell It</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
#center_mid_container {min-height:400px; font:13px calibri; padding:10px 0 0 0; clear:both;}
#center_mid_container h2 {font:bold 23px arial;}
#center_mid_container p {font:14px arial; color:#343434;}
#sellcart {list-style:none; float:right; width:24%; max-width:230px;}
#sellcart li {padding:5px 3px; margin:5px auto; border-bottom:2px solid #333;}
#sellcart img {display:block; margin-bottom:5px;}
#sellcart strong {font:bold 13px calibri;}
#sellcart p {font:12px arial; text-align:left;}
#sellcart a {color:#888; font:bold 11px arial; text-decoration:underline; text-align:right; display:block;}
#const {width:75%; float:left; max-width:750px; padding:20px 0; font:13px calibri;}
#const h2 {font:bold 30px calibri;}
#center_mid_container strong {margin-top:10px; clear:both; font:bold 16px calibri; display:block;}
input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 14px calibri; line-height:22px; height:22px; padding:0 10px; background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); border:1px solid #ffcc00;}
</style>
</head>

<body>
<?php include_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container">
        <?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container">
<h2>Completed</h2>
<?php
$tradequery = "select t.*, a.*,u.first_name, DATE_ADD(t.sate_time, INTERVAL 1 MONTH) as expiry from trades t inner join address a ON t.address_to_ship = a.add_id inner join users u on u.user_id = t.user_id  where t.user_id = ".$userid." and t.sessid = '".$sess_id."'";
$restTra = mysql_query($tradequery);
$shipdata = mysql_fetch_array($restTra);

$mysg = '<table bgcolor="#585958" cellpadding="3" cellspacing="2" width="550" align="center">
 	<tbody>
 	<tr>
    	<td>
        	<table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td style="padding:10px 20px;"><a href="http://bumblebeewireless.com/" target="_blank"><img src="http://bumblebeewireless.com/skin/frontend/default/bumble/images/logo.jpg" alt="Bumblebee Wireless" width="360" height="98" border="0" style="display:block"></a></td>
                 </tr>
            	
            </tbody></table>   
              
            
            <table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">   

                  <tbody><tr>
                	<td colspan="3">

      <table width="550" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
        <tbody><tr>
          <td><table width="500" align="left">
              <tbody><tr>
                <td><p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif"> Hi '.$shipdata['first_name'].',<br>
                    <br>
                    We\'re excited that you\'ve decided to sell your ';
					$myprosname = mysql_query("select item_name from cart where sessid = '".$sess_id."'");
					$koma = 0;
					while($pronames = mysql_fetch_array($myprosname)) {
						if($koma!=0) {
							$mysg .= ", ";
						}
						$mysg .= $pronames[0];
					}
		$mysg .= ' Device to Bumblebee Wireless. Your free shipping label and instructions will be mailed shortly.</p>
                  <table bgcolor="#FFFFFF" cellpadding="2" cellspacing="2" width="500">
                  	<tbody><tr>
                    	<td width="25"></td>
                        <td width="500" align="left">
                        	<h1 style="color:#000;padding-top:0px;padding-left:0px;padding-right:0px;margin:0;font-size:16px;font-family:Arial,Helvetica,sans-serif">Shipping to Bumblebee Wireless:</h1>
                        	<span style="color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif;font-weight:bold">


                  <ol style="margin-left:20px;padding:0px">
                   <li style="color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif;font-weight:bold">Prepare your device for shipping. <span style="text-decoration:underline">How to prepare your device. </li>
                    <li>Pack your item into the box we\'ve provided or use your box to get your item to us quicker. Be sure to include your packing slip so we can easily identify your ';
					$myprosname2 = mysql_query("select item_name from cart where sessid = '".$sess_id."'");
					$koma2 = 0;
					while($pronames2 = mysql_fetch_array($myprosname2)) {
						if($koma2!=0) {
							$mysg .= ", ";
						}
						$mysg .= $pronames2[0];
					}
					
					$mysg .= ' device. Please <u>do not</u> add any items that are not on your packing slip.</li>
<li style="color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif;font-weight:bold">Affix your shipping label to box and drop off your item to your nearest shipping carrier, listed on the pre-paid label we provided you.</li>
                  </ol>

                  </span>
                       	</td>
                 		<td width="25"></td>
                  	</tr>
                  </tbody></table>
                  </td>
              </tr>
              <tr>
                <td><p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">                    Thanks again,<br>
                    The Bumblebee Team<br>
                  </p></td>
              </tr>
                            		  
                           		  <tr>
                           		    <td valign="middle" width="455" align="center" height="110">
                        	          <table border="1">
                        	           <tbody><tr>
                        	            <td valign="middle" width="200" align="center" height="20">
                        	            <span style="font-size:12px;line-height:16px;font-family:Arial,Helvetica,sans-serif;color:#333333">
                        	             <b>Product Name</b></span>
                        	            </td>
                        	            <td valign="middle" width="85" align="center" height="20">
                        	            <span style="font-size:12px;line-height:16px;font-family:Arial,Helvetica,sans-serif;color:#333333">
                        	             <b>Offer Amount</b></span>                        	            
                        	             </td>
                        	            <td valign="middle" width="85" align="center" height="20">
                        	            <span style="font-size:12px;line-height:16px;font-family:Arial,Helvetica,sans-serif;color:#333333">
                        	             <b>Expiration</b></span>
                        	            </td>
                        	           </tr>';
									   $mystq = "select * from cart where sessid = '".$sess_id."'";
									   //echo $mystq;
  									   $myprosname3 = mysql_query($mystq);
									   $boxamout=0;
					while($pronames3 = mysql_fetch_array($myprosname3)) {
						$mysg .= '<tr>
                        	            <td valign="middle" width="190" align="left" height="20">
                        	            <span style="font-size:12px;line-height:16px;font-family:Arial,Helvetica,sans-serif;color:#333333">
                        	            '.$pronames3['item_name'].'</span>
                        	            </td>
                        	            <td valign="middle" width="85" align="center" height="20">
                        	            <span style="font-size:12px;line-height:16px;font-family:Arial,Helvetica,sans-serif;color:#333333">
                        	             '.$pronames3['item_price'].'</span>                        	            
                        	             </td>
                        	            <td valign="middle" width="85" align="center" height="20">
                        	            <span style="font-size:12px;line-height:16px;font-family:Arial,Helvetica,sans-serif;color:#333333">
                        	             <span class="aBn" data-term="goog_527566755" tabindex="0"><span class="aQJ">'.
										 date('d-m-Y',strtotime($shipdata['expiry'])).'</span></span></span>
                        	            </td>                       	           
                        	          </tr>';
									  $boxamout += substr($pronames3['item_price'],1);
					}
									   
									   
									   
									 $mysg .=' </tbody></table>
                        	        </td>
                           		  </tr>
                           		  <tr>
                           		    <td>
                           		     <p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">
                <b>Box Total: $'.$boxamout.'</b>

                           		    </p></td>
                           		  </tr>
                                 <tr>
                           		    <td>
                           		     <p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#ff0000;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">
                <b>* Offer amount expires if we don\'t receive your device prior to the date above.</b>
                           		    </p></td>
                           		  </tr>
                                 
                            <tr>
                           		    <td>
                           		     <p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">
                <b>The expiration date above should be 15 business days from the date the email was sent. Not the same day. This would be confusing expiration is the day the offer amount expires. </b><br>
                <br>

                           		    </p></td>
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
 
 
 
$subject = "Your Bumblebee Wireless Shipping Information";
$headersxx = "From : \"Bumblebee Wireless\" <no-reply@bumblebeewireless.com>
MIME-Version: 1.0
Content-Type: text/html;";

$headers = "From: Bumblebee Wireless <no-reply@bumblebeewireless.com>" . "\r\n";
$headers .= "CC: irfan.mukhtar@xperts.pk\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if(mail($_SESSION['user_email'],$subject,$mysg,$headers)) {
	//echo "<p>Thanks for selling your item to us.</p>";
	$_SESSION['order_id'] = $userObj->randomOrder();
}
?>
<p>Thank you for selling your item to us. We have sent you an email with a free shipping label.</p>
<section id="ship_inst">
    <h2 class="zazzy">What Happens Next?</h2>
    <div id="shipping_instructions">
        <div class="step" id="prep_phone_step">
          <!-- Loading Content: '/app_partials/g3/thank_you/step-1/cell_phone' -->
<div class="step_description">
  <div class="step_image">
    <img src="images/thank_you_phone_settings_original_original.png" alt="thank_you_phone_settings">
</div>
  <div class="step_content">
    <h4>1. Prep Your Device</h4>
    <p class="description">
    </p>
<ul>
<li>Remove passwords</li>
      <li>Deactivate your service</li>
      <li>Save your data</li>
      <li><a href="http://bumblebeewireless.com/how-to-instructions" target="_blank" style="text-decoration:underline;">How to Instructions</a></li>
    </ul>
</div>
</div>
        </div>
        <div class="step" id="packaging_step">
<div class="step_description">
  <div class="step_image">
    <img src="images/thank_you_shipping_original_original.png" alt="thank_you_shipping">
</div>
  <div class="step_content">
    <h4>2. Pack &amp; Send</h4>
    <p class="description">
    </p>
<ul>
<li>Check email for pre-paid shipping label</li>
      <li>Pack your device in a box</li>
      <li>Drop it off at your <a href="http://fedex.com/Dropoff/start">nearest FedEx or USPS location</a>
</li>
    </ul>
</div>
</div>
        </div>
        <div class="step" id="payment_step">
<div class="step_description">
  <div class="step_image">
    <img src="images/thank_you_payment_original_original.png" alt="thank_you_payment" border="0" usemap="#Map">
    <map name="Map">
      <area shape="rect" coords="47,116,161,176" href="http://www.smartaddon.com/?share" onClick="return sa_tellafriend('http://bumblebeewireless.com','email')" target="_blank">
    </map>
  </div>
  <div class="step_content">
    <h4>3. Get Paid</h4>
    <p class="description">
      Once we receive an item it typically takes about a week for your check to be mailed to you. 
    </p>
    <h4>4. <script type="text/javascript">
(function() {
var s=document.createElement('script');s.type='text/javascript';s.async = true;
s.src='http://s1.smartaddon.com/share_addon.js';
var j =document.getElementsByTagName('script')[0];j.parentNode.insertBefore(s,j);
})();
</script>
<a href="http://www.smartaddon.com/?share" title="Share Button" style="text-decoration:underline;" onClick="return sa_tellafriend('http://bumblebeewireless.com','email')">Refer your Friends</span></a>
<!-- SMARTADDON END -->
</h4>
    <p class="description">
    We love referrals and made it simple to buzz about us to your friends & family <script type="text/javascript">
(function() {
var s=document.createElement('script');s.type='text/javascript';s.async = true;
s.src='http://s1.smartaddon.com/share_addon.js';
var j =document.getElementsByTagName('script')[0];j.parentNode.insertBefore(s,j);
})();
</script>
<a href="http://www.smartaddon.com/?share" title="Share Button" style="text-decoration:underline;" onClick="return sa_tellafriend('http://bumblebeewireless.com','email')">Click here</span></a>
<!-- SMARTADDON END --> to start spreading the buzz
    </p>
  </div>
</div>
        </div>
    </div>
    <br>
    <div id="caution_important_steps">
      <div class="caution_text">
        <h2>Important steps to get full value for your device</h2>
        <p>Make sure to complete these steps to avoid reduced or delayed payment.</p>
      </div>
    </div>
    <br>
    <div id="detailed_steps">
        <div id="step_1" class="step_detail">
<h2>▸ Remove Passwords</h2>
<p>Make sure you have turned off any password protection on your device so we can test it. Leaving it locked could delay payment.</p>
<a href="http://bumblebeewireless.com/how-to-instructions" target="_blank">How to remove your password &gt;</a>
        </div>
        <div id="step_2" class="step_detail">
<h2>▸ Deactivate your service</h2>
<p>It is very important that your contact your carrier to terminate service to this phone, and pay any remaining balance.</p>
<a href="http://bumblebeewireless.com/how-to-instructions" target="_blank">How to deactivate service &gt;</a>
        </div>
        <div id="step_3" class="step_detail">
<h2>▸ Save your data</h2>
<p>Save your photos and files. If your device has an SD card, don't forget to remove it. We will erase all the information from your device.</p>
<a href="http://bumblebeewireless.com/how-to-instructions" target="_blank">How to save your data &gt;</a>
        </div>
      </div>  
  </section>




</section>
<?php include_once("inc/footer.php"); ?>
</section></	section>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</body>
</html>
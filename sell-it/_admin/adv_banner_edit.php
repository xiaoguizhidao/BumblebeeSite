<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
?>
<?php
$adv_id=$_GET['adv_id'];
$qryNews="select * from adv_banner where adv_id='$adv_id' limit 1";
$rsNews=mysql_query($qryNews);
$rowNews=mysql_fetch_array($rsNews);
if($_POST['hSubmit']==1){

	$adv_title=$_POST['adv_title'];
	$adv_link=$_POST['adv_link'];
	
	$qryUpdate="update adv_banner set adv_title='$adv_title',adv_link='$adv_link'";
	
if ($_FILES["adv_banners"]["error"] > 0)
  {
  //echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else{
move_uploaded_file($_FILES["adv_banners"]["tmp_name"],
      "../banner_images/" . $_FILES["adv_banners"]["name"]);
$filename1 = basename($_FILES['adv_banners']['name']);
$qryUpdate.=", adv_banners='$filename1'";
}

$qryUpdate.=" where adv_id='$adv_id'";


	
	if(mysql_query($qryUpdate)){?>
        <script language="javascript">
        window.location="adv_banner.php";
        
        </script>
	
	<?php
		
	}else{
		$msg="There is some error";
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
        <td width="216" bgcolor="#c8cca9" valign="top"><?php include("includes/menu.php");?></td>
        <td align="left" valign="top" style="padding-top:15px;"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30"><span class="usr_info">Edit  Banners</span></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4" height="3"><img src="images/corn_1_top.jpg" width="4" height="4"></td>
                <td  background="images/usr_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
                <td width="4" height="3"><img src="images/corn_2_top.jpg" width="4" height="4"></td>
              </tr>
              <tr>
                <td width="3" valign="top" background="images/usr_lft_bg.jpg" align="left"><img src="images/usr_lft.jpg" width="4" height="147"></td>
                <td valign="top" background="images/usr_bg2.jpg" style="background-repeat:repeat-x;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" ><form action="<?php echo($_SERVER['PHP_SELF'].'?adv_id='.$_REQUEST['adv_id']);?>" method="post" name="frmChange" enctype="multipart/form-data"><table width="98%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td align="right" class="usr_info">&nbsp;</td>
                          <td><?php echo($msg);?></td>
                        </tr>
                       
                       
						<!--<tr>
                          <td align="right" class="usr_info">Small Image:</td>
                          <td><input name="small_image" type="file" class="passfieds" id="small_image">&nbsp;<b>Only (107 * 38)</b></td>
                        </tr>-->
                         <tr>
                          <td align="right" class="usr_info">Banner Title:</td>
                          <td><input name="adv_title" type="text" class="passfieds" id="adv_title" value="<?php echo $rowNews['adv_title'];?>"></td>
                        </tr>
						<tr>
                          <td align="right" class="usr_info">Banner Image:</td>
                          <td><input name="adv_banners" type="file" class="passfieds" id="adv_banners" value="<?php echo $rowNews['adv_banners'];?>">&nbsp;<b><img src="../banner_images/<?php echo $rowNews['adv_banners'];?>" width="60" height="60"></b></td>
                        </tr>
                        <tr>
                          <td align="right" class="usr_info">Banner Link:</td>
                          <td><input name="adv_link" type="text" class="passfieds" id="adv_link" value="<?php echo $rowNews['adv_link'];?>">&nbsp;<b style="color:#F00;">(With http://)</b></td>
                        </tr>
                       
                        
						
                       
                        <tr>
                          <td>&nbsp;</td>
                          <td><input type="image" name="imageField" id="imageField" src="images/btn_submit.jpg"><input name="hSubmit" type="hidden" id="hSubmit" value="1" /></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></form></td>
                     
                    </tr>
                    
                </table></td>
                <td width="3" valign="top" background="images/usr_rit_bg.jpg"><img src="images/usr_rit.jpg" width="4" height="147"></td>
              </tr>
              <tr>
                <td width="4" height="3"><img src="images/corn_3.jpg" width="4" height="3"></td>
                <td  background="images/usr_btm_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
                <td width="4" height="3"><img src="images/corn_4.jpg" width="4" height="3"></td>
              </tr>
            </table></td>
          </tr>
		  <tr>
		  	<td height="15"></td>
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

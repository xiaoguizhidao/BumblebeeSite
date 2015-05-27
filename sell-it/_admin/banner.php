<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>
<?php 
if($_POST['upload']==1){
$top_link=$_POST['top_link'];
$left_link=$_POST['left_link'];
$right_link=$_POST['right_link'];
$update_qry="update banner set top_link='$top_link' ,left_link='$left_link',right_link='$right_link' ";
if ($_FILES["top"]["error"] > 0)
{
//echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else{
move_uploaded_file($_FILES["top"]["tmp_name"],
"../banner/" . $_FILES["top"]["name"]);
$filename = basename($_FILES['top']['name']);
$update_qry.=", top_banner='$filename'";
}
if ($_FILES["left"]["error"] > 0)
{
//echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else{
move_uploaded_file($_FILES["left"]["tmp_name"],
"../banner/" . $_FILES["left"]["name"]);
$filename1 = basename($_FILES['left']['name']);
$update_qry.=", left_banner='$filename1'";
}
if ($_FILES["right"]["error"] > 0)
{
//echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else{
move_uploaded_file($_FILES["right"]["tmp_name"],
"../banner/" . $_FILES["right"]["name"]);
$filename2 = basename($_FILES['right']['name']);
$update_qry.=", right_banner='$filename2'";
}
$update_qry.=" where banner_id=1";
if(mysql_query($update_qry)or die(mysql_error())){
$msg="Value Has Been Updated";
}
}
?>
<?php 
$banner_qry=mysql_query("select * from banner where banner_id=1")or die(mysql_error());
$row=mysql_fetch_array($banner_qry);
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
        <td align="left" valign="top"><form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" style="padding:10px">
  <tr>
    <td colspan="2"><?php echo $msg;?></td>
    </tr>
  <tr>
    <td width="21%">Upload Top Bnner </td>
    <td width="79%"><input type="file" name="top" id="top" /></td>
  </tr>
  <tr>
    <td> Top Bnner Link</td>
    <td><input type="text" name="top_link" id="top" /></td>
  </tr>
  <tr>
    <td>Upload Left Banner</td>
    <td><input type="file" name="left" id="left" /></td>
  </tr>
   <tr>
    <td> Left Banner Link</td>
    <td><input type="text" name="left_link" id="top" /></td>
  </tr>
  <tr>
    <td>Upload Right Banner</td>
    <td><input type="file" name="right" id="right" /></td>
  </tr>
   <tr>
    <td> Right Bnner Link</td>
    <td><input type="text" name="right_link" id="top" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Upload" />
      <input name="upload" type="hidden" id="upload" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Top Banner</td>
    <td><img src="../banner/<?php echo $row['top_banner']?>" width="403" height="60" /> </td>
  </tr>
   <tr>
    <td>Top Banner Link</td>
    <td><?php echo $row['top_link']?></td>
  </tr>
  <tr>
    <td>Left Banner</td>
    <td><img src="../banner/<?php echo $row['left_banner']?>" width="401" height="60" /></td>
  </tr>
  <tr>
    <td>Left Banner Link</td>
    <td><?php echo $row['left_link']?></td>
  </tr>
  <tr>
    <td>Right Banner</td>
    <td><img src="../banner/<?php echo $row['right_banner']?>" width="398" height="60" /></td>
  </tr>
  <tr>
    <td>Right Banner Link</td>
    <td><?php echo $row['right_link']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
        </form>

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
                      <td>Tornado</td>
                    </tr>
                    <tr>
                      <td align="right" class="usr_info">Connected Date/Time:</td>
                      <td>Friday,22.5.2009</td>
                    </tr>
                    <tr>
                      <td align="right" class="usr_info">VIA IP:</td>
                      <td>192.168.1.1</td>
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

<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>

<?php
if(isset($_POST['hSubmit']) && $_POST['hSubmit']==1){

if ($_FILES["file"]["error"] > 0)
  {
  //echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
 move_uploaded_file($_FILES["file"]["tmp_name"],
      "../slider_images/" . $_FILES["file"]["name"]);
$filename = basename($_FILES['file']['name']);
	$sort=$_REQUEST['sort'];
$qryinsert="INSERT INTO slider(slide_image,sort) VALUES('$filename','$sort')";
	if(mysql_query($qryinsert) or die(mysql_error())){?>
	<script>
    window.location="slider.php";
    </script>
	<?php }else{
		$msg=0;
	}
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="includes/general.js"></script>
</head>

<body>
<table width="90%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="85" colspan="3" align="left" valign="top"><?php include("includes/header.php");?></td>
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
        <td width="216" valign="top"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3" height="3"><img src="images/side_menu_corn_lft.jpg" width="3" height="3"></td>
            <td bgcolor="#2A2F32"><img src="images/x.gif" width="1" height="1"></td>
            <td width="3" height="3"><img src="images/side_menu_corn_rit.jpg" width="3" height="3"></td>
          </tr>
          <tr>
            <td width="3" bgcolor="#2A2F32">&nbsp;</td>
            <td width="100%" valign="top" bgcolor="#2A2F32"><?php include("includes/menu.php");?></td>
            <td width="3" bgcolor="#2A2F32">&nbsp;</td>
          </tr>
          <tr>
            <td><img src="images/side_menu_btm_lft.jpg" width="3" height="3"></td>
            <td width="3" height="3" bgcolor="#2A2F32"><img src="images/x.gif" width="1" height="1"></td>
            <td align="right"><img src="images/side_menu_btm_rit.jpg" width="3" height="3"></td>
          </tr>
        </table></td>
        <td align="left" valign="top" style="padding-top:15px;"><table border="1" width="100%" cellspacing="0" cellpadding="2" height="40" bgcolor="#F0F1F1">
          <tr>
            <td align="center">
			<form 

action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" name="frmUpdateSub" id="frmUpdateSub"><br><br>
			  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="main" align="center">

 <tr>
    <td width="10%">Slide</td>
    <td><input type="file" name="file"></td>
  </tr>
 <tr>
    <td width="10%">Sort</td>
    <td><input type="text" name="sort"></td>
  </tr>
  
<!--<tr> 	 
 	  <td>Image</td>
 	  <td><input type="file" 

name="file" id="file" />
 	    (103 * 62)</td>
 	  </tr>-->
 	<tr>
 	  <td>&nbsp;</td>
 	  <td><input type="submit" value="Insert" name="submit">
 	    <input name="hSubmit" type="hidden" id="hSubmit" value="1"></td>
 	  <td></td>
 	  </tr>
 	<?php
  if($msg==1){
  ?>
	
	<tr>
 		<td 

colspan="2">&nbsp;</td>
<td colspan="2" ><span class="cms"><?php 

if($msg==0){ echo("There is some error in 

inserting data.");}
if($msg==1){ echo("Record has been inserted 

successfully.");}
?>.</span></td>
	</tr>
	<?php
	}
	?>
</table>

                  </form>
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

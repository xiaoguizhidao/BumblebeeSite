<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
?>
<?php
if($_POST['hSubmit']==1){



if ($_FILES["adv_banners"]["error"] > 0)
  {
  //echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
move_uploaded_file($_FILES["adv_banners"]["tmp_name"],
      "../banner_images/" . $_FILES["adv_banners"]["name"]);
$filename = basename($_FILES['adv_banners']['name']);

	$adv_title=$_POST['adv_title'];
	$adv_link=$_POST['adv_link'];
	$rsInsert=mysql_query("insert into adv_banner (adv_title,adv_banners,adv_link)values('$adv_title','$filename','$adv_link')")or die(mysql_error());
	if($rsInsert){
	$msg="Data has been added successfully";
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
<script language="javascript">
function confirmation()
{
var r=confirm("Are You Sure Want To Delete ?");
if (r==true)
  {
 window.location="adv_banner.php?adv_id=<?php echo($rowProjects['adv_id']."&action=delete_image"); ?>";
  }
  else
  return false;
}
</script>
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
            <td height="30"><span class="usr_info">Manage  Banners</span></td>
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
                      <td align="left" valign="top" ><form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" name="frmChange" enctype="multipart/form-data"><table width="98%" border="0" cellpadding="0" cellspacing="4">
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
                          <td><input name="adv_title" type="text" class="passfieds" id="adv_title"></td>
                        </tr>
						<tr>
                          <td align="right" class="usr_info">Banner Image:</td>
                          <td><input name="adv_banners" type="file" class="passfieds" id="adv_banners">&nbsp;<b></b></td>
                        </tr>
                        <tr>
                          <td align="right" class="usr_info">Banner Link:</td>
                          <td><input name="adv_link" type="text" class="passfieds" id="adv_link">&nbsp;<b style="color:#F00;">(With http://)</b></td>
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
		  <tr>
		  	<td align="center">
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="4" height="3"><img src="images/corn_1_top.jpg" width="4" height="4"></td>
              <td background="images/usr_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
              <td width="4" height="3"><img src="images/corn_2_top.jpg" width="4" height="4"></td>
            </tr>
            <tr>
              <td width="3" valign="top" background="images/usr_lft_bg.jpg"><img src="images/usr_lft.jpg" width="4" height="147"></td>
              <td valign="top" background="images/usr_bg2.jpg" style="background-repeat:repeat-x;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top" align="center">
				  
				  <table width="99%" border="0" cellspacing="5" cellpadding="0">
  <tr bgcolor="#999900">
    <td width="15%" align="center" height="30" class="usr_info" style="color:#000000;">Banner</td>
    <td width="38%" align="center" height="30" class="usr_info" style="color:#000000;">Banner Title</td>
    <td width="32%" align="center" class="usr_info" style="color:#000000;">Banner link</td>
    <td width="15%" align="center" class="usr_info" style="color:#000000;">Action</td>
  </tr>
  <tr>
   <td width="15%" align="left" class="usr_info" height="5"></td>
   <td width="38%" align="left" class="usr_info"></td>
    <td width="32%" align="left" class="usr_info"></td>
    <td width="15%" align="center" class="usr_info"></td>
  </tr>
  
  <?php 
   if ($_REQUEST['action']=="delete_image"){
				  $adv_id=$_GET['adv_id'];
				  $del="delete from adv_banner where adv_id='$adv_id'";
				  $delete=mysql_query($del) or die(mysql_error());
				}
  $rsProjects=mysql_query("select * from adv_banner order by adv_id desc")or die(mysql_error());
  $noProjects=mysql_num_rows($rsProjects);
  if($noProjects==0){
  echo 'No Banners';
  }else{
  while($rowProjects=mysql_fetch_array($rsProjects)){
  
  ?>
  <tr>
    <td width="15%" align="center"><div align="center"><img src="../banner_images/<?php echo $rowProjects['adv_banners'];?>" width="60" height="60"></div></td>
	<td width="38%" align="center"><div align="center"><?php echo $rowProjects['adv_title'];?></div></td>
    <td width="32%" align="center"><div align="center"><?php echo $rowProjects['adv_link'];?></div></td>
    <td width="15%" align="center" class="usr_info"><a href="adv_banner_edit.php?adv_id=<?php echo $rowProjects['adv_id'];?>" title="Edit" style="text-decoration:underline;">Edit</a> | <a onClick="return confirmation()" href="adv_banner.php?adv_id=<?php echo ($rowProjects['adv_id']."&action=delete_image"); ?>" title="Delete" style="text-decoration:underline;">Delete</a></td>
  </tr>
  <tr>
   <td width="15%" align="left" class="usr_info" bgcolor="#999900" height="2"></td>
   <td width="38%" align="left" class="usr_info" bgcolor="#999900" height="2"></td>
    <td width="32%" align="left" class="usr_info" bgcolor="#999900"></td>
    <td width="15%" align="center" class="usr_info" bgcolor="#999900"></td>
  </tr>
  
  <?php }}?>
  
  
</table>

				  
				  </td>
                  
                </tr>
                
              </table></td>
              <td width="3" valign="top" background="images/usr_rit_bg.jpg"><img src="images/usr_rit.jpg" width="4" height="147"></td>
            </tr>
            <tr>
              <td width="4" height="3"><img src="images/corn_3.jpg" width="4" height="3"></td>
              <td background="images/usr_btm_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
              <td width="4" height="3"><img src="images/corn_4.jpg" width="4" height="3"></td>
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

<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>
<?php 
$service_id=$_GET['service_id'];
$qry=mysql_query("select * from employement where emp_id='$service_id'")or die(mysql_error());
$rs=mysql_fetch_array($qry);
?>

<?php
if($_POST['hSubmit']==1){
$service_id=$_GET['service_id'];
	$hn_name=addslashes($_POST['hn_name']);
	
	$hn_des=addslashes($_POST['hn_des']);
	
	$update_qry="update employement set emp_head='$hn_name',emp_des='$hn_des'";
/*if(!empty($_FILES['honey']) && ($_FILES['honey']['error'] == 0)) {
		$filename = basename($_FILES['honey']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
			$img_src = $_FILES["honey"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			$rsLastProduct=mysql_query("select max(service_id) as max_pid from service limit 1");
			$rowLastProduct=mysql_fetch_array($rsLastProduct);
			$max_pid=$rowLastProduct['max_pid']+1;
			$changedFilename = $max_pid.$filename;
			//$uploadat="../honey/".$changedFilename;
			move_uploaded_file($_FILES["honey"]["tmp_name"],
      "../service/" .$changedFilename);
	  
	  // unlink("../banner/".$main_banner);
		$update_qry.=",service_img='$changedFilename' ";
	}*/
$update_qry.=" where emp_id='$service_id'";
//echo $update_qry;
	if($rsUpdate=mysql_query($update_qry)){?>
	
	<script>window.location="service.php";</script>
    <?php }
	$msg=1;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
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
        <td align="left" valign="top" style="padding-top:15px;"><form 

action="<?php 

echo($_SERVER['PHP_SELF']);?>?service_id=<?php echo $service_id;?>" 

method="post" 

enctype="multipart/form-data" 

name="frmUpdateSub" 

id="frmUpdateSub">
            <table 

width="100%" border="0" cellpadding="4" 

cellspacing="0" class="main" 

align="center">
              <tr>
                <td width="13%"><div align="center"> Name</div></td>
                <td width="82%"><input 

name="hn_name" type="text" class="passfieds" id="hn_name" 

value="<?php echo $rs["emp_head"]?>" size="26"></td>
              </tr>
              
              <tr> 
                  <td><div align="center"> Description </div></td>
                <td><textarea name="hn_des" 

id="hn_des" cols="50" 

rows="10" class="passfieds"><?php echo $rs["emp_des"];?></textarea></td>
              </tr>
              
              <!--<tr>
                <td>Image</td>
                <td><input type="file" 

name="honey" id="honey" class="passfieds"><?php 
if($rs["service_img"]!=""){?>
<img src="../service/<?php echo($rs['service_img']);?>" width="50" height="50" />
<?php }
?></td>
              </tr>-->
              <tr>
                <td colspan="2"><div align="center">
                  <input type="submit" 

value="Insert" name="submit">
                  <input name="hSubmit" 

type="hidden" id="hSubmit" 

value="1">
                </div></td>
              </tr>
              <?php
  if($msg==1){
  ?>
              <tr>
                <td 

colspan="2">&nbsp;</td>
                <td width="5%" colspan="2" ><span class="cms">
                  <?php 

if($msg==0){ echo("There is some error in 

inserting data.");}
if($msg==1){ echo("Record has been inserted 

successfully.");}
?>
                  .</span></td>
              </tr>
              <?php
	}
	?>
            </table>
        </form></td>
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
<?php include("includes/header.php");?>
</body>
</html>

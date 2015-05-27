<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript" src="../jscripts/tinymce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "textareas",
		textarea_trigger : "convert_this",
		plugins : "advimage",
		external_image_list_url : "images.php",
	});
</script>
<script language="javascript">
function confirmation()
{
var r=confirm("Are You Sure Want To Delete ?");
if (r==true)
  {
 window.location="colors.php?color_id=<?php echo($rsColors['color_id']."&action=delete_image"); ?>";
  }
  else
  return false;
}
</script>
<!-- /TinyMCE -->
 <?php
if(isset($_POST['submit'])){

if ($_FILES["upload"]["error"] > 0)
  {
  //echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
move_uploaded_file($_FILES["upload"]["tmp_name"],
      "../tinymce/fotos/" . $_FILES["upload"]["name"]);
$filename = basename($_FILES['upload']['name']);


	$alt_txt=$_POST['alt_txt'];
	$qry="insert into foto_table(file_name,alt_txt) values('$filename','$alt_txt')";
	
	if(mysql_query($qry)or die(mysql_error())){
		$msg="Images has been added successfully";
	}else{
		$msg="There is some error in adding Images. Please try again.";
	}
}
?>
              
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

action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" name="frmCms">
            <table 

width="100%" border="0" cellpadding="4" 

cellspacing="0" class="main" 

align="center">
              
              
              
              <tr> 
                  <td><div align="center"> Upload Image </div></td>
                  <td><input name="upload" type="file" class="passfieds" id="upload"></td>
              </tr>
              <tr> 
                  <td><div align="center"> Alter Text: </div></td>
                  <td><input name="alt_txt" type="text" class="passfieds" id="upload"></td>
              </tr>
              <!--<tr>
                <td>Image</td>
                <td><input type="file" 

name="service" id="honey" class="passfieds">                </td>
              </tr>-->
              <tr>
                <td colspan="2"><div align="center">
                 <input type="submit" name="submit" id="submit" value="Add Images" />
                </div></td>
              </tr>
              <?php
			   if ($_REQUEST['action']=="delete_image"){
				  $file_name=$_GET['file_name'];
				  $del="delete from foto_table where file_name='$file_name'";
				  $delete=mysql_query($del) or die(mysql_error());
				}
   $sqlColors=mysql_query("select * from foto_table order by file_name ")or die(mysql_error());
			  $r=0;
			  while($rsColors=mysql_fetch_array($sqlColors)){
			  $r++;
  ?>
              <!--<tr>
                <td 

colspan="4"><span class="cms"><?php echo $rsColors['file_name']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onClick="return confirmation()" href="upload.php?file_name=<?php echo($rsColors['file_name']."&action=delete_image"); ?>">Delete</a>
                  </span></td>
                </tr>-->
                <tr>
                <td style=" padding-left:15px;"><span class="cms"><img src="../tinymce/fotos/<?php echo $rsColors['file_name']; ?>" width="40" height="40" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </span></td>
                <td><a onClick="return confirmation()" href="upload.php?file_name=<?php echo ($rsColors['file_name']."&action=delete_image"); ?>">Delete</a></td>
                <td width="21%"></td>
                <td width="12%"></td>
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
</body>
</html>

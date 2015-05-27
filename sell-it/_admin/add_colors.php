<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
?>
<?php 
$p_id=$_GET['p_id'];
if(isset($_POST['upload']) && $_POST['upload']==1){
$p_id=$_GET['p_id'];
if(!empty($_FILES['color_image']) && ($_FILES['color_image']['error'] == 0)) {
		$filename = basename($_FILES['color_image']['name']);
		//$ext = substr($filename, strrpos($filename, '.') + 1);
		$ext = substr($filename, -3);
			$img_src = $_FILES["color_image"]["tmp_name"];
			$changedFilename = time().".".$ext;
			$uploadat="../colors/".$changedFilename;
	// This is the temporary file created by PHP 
	$uploadedfile = $_FILES['color_image']['tmp_name'];
	move_uploaded_file($uploadedfile,$uploadat);
	}
//---------------------------------------------------------------------------------------------
$insert_qry=mysql_query("insert into add_colors (color_image,p_id) values('$changedFilename','$p_id')")or die(mysql_error());
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../tinymce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<script language="javascript">
function confirmation()
{
var r=confirm("Are You Sure Want To Delete ?");
if (r==true)
  {
 window.location="add_colors.php?c_id=<?php echo($rsColors['c_id']."&action=delete_image"); ?>";
  }
  else
  return false;
}
</script>
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
        <td align="left" valign="top" background="images/usr_bg2.jpg" style="background-repeat:repeat-x;"><form action="<?php echo $_SERVER['PHP_SELF'];?>?p_id=<?php echo $p_id;?>" method="post" enctype="multipart/form-data">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px">
  <tr>
    <td colspan="4"><?php echo $msg;?></td>
    </tr>
  <tr>
    <td width="21%">Upload Images </td>
    <td width="79%" colspan="3"><input name="color_image" type="file" class="passfieds" id="color_image" /></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="submit" name="button" id="button" value="Upload" />
      <input name="upload" type="hidden" id="upload" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
 <?php 
                if (isset($_REQUEST['action']) && $_REQUEST['action']=="delete_image"){
				  $c_id=$_GET['c_id'];
				  $del="delete from add_colors where c_id='$c_id'";
				  $delete=mysql_query($del) or die(mysql_error());
				}
 $gllery_qry=mysql_query("select * from add_colors where p_id='$p_id'")or die(mysql_error());
//$num=mysql_num_rows($gllery_qry);
// if($num>0){
 while($row=mysql_fetch_array($gllery_qry)){
 ?>
  <tr>
    <td></td>
    <td><img src="../colors/<?php echo $row['color_image'];?>" width="70" height="70" /> </td>
   <!-- <td><a href="edit_gallery.php?img_id=<?php echo $row['img_id'];?>&p_id=<?php echo $p_id;?>">Edit</a></td>-->
    <td><a onClick="return confirmation()" href="add_colors.php?c_id=<?php echo ($row['c_id']."&action=delete_image&p_id=".$row['p_id']); ?>">Delete</a></td>
  </tr>
  <?php }
  //}
  ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
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

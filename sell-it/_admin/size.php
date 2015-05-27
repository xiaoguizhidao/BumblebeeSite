<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>
<?php
$size_id=$_REQUEST['size_id'];
	if($_REQUEST['hAction']=="edit_size"){
		$size=$_POST['size'];
		$rsChk=mysql_query("select * from ".TBL_SIZE." where size='$size' and size_id!='$size_id'") or die(mysql_error());
		$noChk=mysql_num_rows($rsChk);
		if($noChk>0){
		$msg="<span class=msg_error>This size already exists.</span>";
		}else{
		mysql_query("update ".TBL_SIZE." set size='$size' where size_id='$size_id'");
		$msg="<span class=msg_ok>Size has been update successfully</span>";
		}
	}
	if($_REQUEST['hAction']=="add_size"){
		$size=$_REQUEST['size'];
		$rsAc=mysql_query("select * from ".TBL_SIZE." where size='$size'") or die(mysql_error());
		$noAc=mysql_num_rows($rsAc);
		if($noAc>0){
		$msg="<span class=msg_error>This size already exist.</span>";
		}else{
		mysql_query("insert into ".TBL_SIZE." (size) VALUES ('$size')"); 
		$msg="<span class=msg_ok>Size has been Inserted successfully</span>";
		}
	}
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
 window.location="download.php?size_id=<?php echo($rsColors['size_id']."&action=delete_image"); ?>";
  }
  else
  return false;
}
</script>
<!-- /TinyMCE -->
 
              
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
        <td align="center" valign="top" style="padding-top:15px;">
            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="30" class="Black_Text"><span class="orange_text">Manage New Sizes</span></td>
              </tr>
              <tr>
                <td align="center" valign="top">&nbsp;</td>
              </tr>
              <tr>
                    <td width="80%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="67%" valign="top">Size<br />
                            <br />
                            <?php include("includes/size.php");?>
                          <br />
                            <hr />
                            <br />
                            <table width="100%" border="0" cellspacing="0" cellpadding="2">
                              <tr>
                                <td width="35%">&nbsp;</td>
                                <td width="38%" align="right">&nbsp;</td>
                                <td width="27%" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <form action="add_product.php" method="post" name="frmNewProduct">
                                      <tr>
                                        <td><a href="<?php echo($_SERVER['PHP_SELF']."?action=new_sizes");?>">New Size</a>
                                            <input name="hUrl" type="hidden" value="<?php echo(selfURL()); ?>" /></td>
                                      </tr>
                                    </form>
                                </table></td>
                              </tr>
                          </table></td>
                        <td width="33%" valign="top"><br />
                            <br />
                            <?php
	include("includes/new_sizes.php");
	include("includes/edit_size.php");
	?>
                        </td>
                      </tr>
                    </table></td>
                    
                  </tr>
            </table>
        </td>
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

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
 window.location="video.php?pdf_id=<?php echo($rsColors['pdf_id']."&action=delete_image"); ?>";
  }
  else
  return false;
}
</script>
<!-- /TinyMCE -->
 <?php
 
if(isset($_POST['submit'])){

if ($_FILES["pdf_image"]["error"] > 0)
 {
//echo "Error: " . $_FILES["file"]["error"] . "<br />";
 }else{
move_uploaded_file($_FILES["pdf_image"]["tmp_name"],
     "../video/" . $_FILES["pdf_image"]["name"]);
$filename1 = basename($_FILES['pdf_image']['name']);
}



	$pdf_name=addslashes($_POST['pdf_name']);
//	echo $pdf_name;
	$pdf_size=$_POST['pdf_size'];
	$qry="insert into video(pdf_name,pdf_size,pdf_image) values('$pdf_name','$pdf_size','$filename1')";
	
	if(mysql_query($qry)or die(mysql_error())){
		$msg="Video has been added successfully";
	}else{
		$msg="There is some error in adding Video. Please try again.";
	}
}
?></head>

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
                <td height="30" class="Black_Text"><span class="orange_text">Manage Video Links</span></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="4" height="3"><img src="images/corn_1_top.jpg" width="4" height="4"></td>
                    <td background="images/usr_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
                    <td width="4" height="3"><img src="images/corn_2_top.jpg" width="4" height="4"></td>
                  </tr>
                  <tr>
                    <td width="3" valign="top" background="images/usr_lft_bg.jpg"><img src="images/usr_lft.jpg" width="4" height="147"></td>
                    <td valign="top" background="images/usr_bg2.jpg" style="background-repeat:repeat-x;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" style="padding-top:10px;">
                              <form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" name="frmCms">
                              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="3">
                                <tr>
                                  <td><strong>Video Image</strong></td>
                                  <td><input type="file" name="pdf_image" id="pdf_image"></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><strong>Video Name</strong></td>
                                  <td><input name="pdf_size" type="text" class="textbox1" id="pdf_size" style="border-width:1; border-style:solid;font-size:10; " size="40"></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr> 
                  <td><strong>Video Link</strong></td>
                  <td><input name="pdf_name" type="text" class="textbox1" id="pdf_name" style="border-width:1; border-style:solid;font-size:10; " size="40"></td>
                   <td>&nbsp;</td>
              </tr>
                                
                                <tr>
                                  <td height="19" align="right" class="usr_info">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                
                                <tr>
                                  <td class="usr_info">&nbsp;</td>
                                  <td> <input type="submit" name="submit" id="submit" value="Add New" /></td>
                                  <td>&nbsp;</td>
                                </tr>
                                    <tr>
                                  <td height="19" align="right" class="usr_info">&nbsp;</td>
                                  <td><?php echo $msg;?></td>
                                  <td>&nbsp;</td>
                                </tr>                    
                              </table>
                              
                              
                             </form> 
                              
                              
                         </td>
                          <td width="122" align="right" valign="top" style="padding-left:10px; padding-top:10px;"><img src="images/chang_pass_img.jpg" width="122" height="133"></td>
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
              <tr>
                    <td width="80%" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderbtm">
                        <tr>
                          <td height="27" colspan="2" bgcolor="#efefda" class="main_table_border"><table width="600" cellpadding="0" cellspacing="0" class="Lblack">
                            <tr>
                              <td width="156" align="center">&nbsp;</td>
                              <td width="425" align="center"><strong>Video Link</strong></td>
                              
                              
                              <td width="189" align="center">Action</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top">
                          
                          
                          <table width="100%" bgcolor="#EFEFDA" border="0" cellpadding="0" cellspacing="0" id="maintable">
                        <?php
			   if ($_REQUEST['action']=="delete_image"){
				  $pdf_id=$_GET['pdf_id'];
				  $del="delete from video where pdf_id='$pdf_id'";
				  $delete=mysql_query($del) or die(mysql_error());
				}
   $sqlColors=mysql_query("select * from video order by pdf_id desc")or die(mysql_error());
			  $r=0;
			  while($rsColors=mysql_fetch_array($sqlColors)){
			  $r++;
  ?>
                                
                  <tr onMouseOver="this.style.backgroundColor='#f9f9ec';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#cccccc';">
                                <td width="20%"  height="50" class="border4" align="center"><img src="images/icons/folder-document-24x24.png" width="24" height="24"></td>
                                <td width="54%" class="border4" align="center" style="padding-left:5px;"><strong class="dataTable_title"><?php echo $rsColors['pdf_name']; ?></strong></td>
                                
                                
                                <td width="26%" class="border4" align="center" >
                                <a onClick="return confirmation()" href="video.php?pdf_id=<?php echo ($rsColors['pdf_id']."&action=delete_image"); ?>"><img src="images/icons/delete-16x16.png" alt="Delete Record" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="video_edit.php?pdf_id=<?php echo ($rsColors['pdf_id']); ?>"><img src="images/icons/icon_action.jpg" alt="Delete Record" border="0"></a>                                </td>                                
                                
                            </tr>
                              
                               <?php
	}
	?>
                            
                             
                              <tr>
                                <td height="25" align="center" bgcolor="#E4E4E4" class="lft_border">&nbsp;</td>
                                <td bgcolor="#E4E4E4" class="border2" style="padding-left:5px;">&nbsp;</td>
                                
                                <td align="center" bgcolor="#E4E4E4" class="border4">&nbsp;</td>
                                <td width="0%" align="center" bgcolor="#E4E4E4" class="border2"></td>
                                
                            </tr>
                              <tr>
                                <td height="25" colspan="6" align="center" bgcolor="#FFF3EB" class="lft_border"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    
                                    
                                    <td width="20%" align="right"><a href="default.asp"></a></td>
                                    <td width="25%" align="right" style="padding-right:5Px;"><a href="default.asp"></a></td>
                                    <td width="23%" align="right"><a href="home.php">Go Back</a>&nbsp;</td>
                                  </tr>
                                </table></td>
                                </tr>                              
                          </table></td>
                        </tr>
                      </table>
                                  </td>
                    
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

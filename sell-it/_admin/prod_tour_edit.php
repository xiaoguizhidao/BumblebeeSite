<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>
<?php
$pdf_id=$_GET['prod_tour_id'];
$qryNews="select * from prod_tour_img where prod_tour_id='$pdf_id' limit 1";
$rsNews=mysql_query($qryNews);
$rowNews=mysql_fetch_array($rsNews);
if(isset($_POST['submit'])){

	$pdf_name=$_POST['pdf_name'];
	//$pdf_size=$_POST['pdf_size'];
	
	$qryUpdate="update prod_tour_img set prod_tour_name='$pdf_name'";
	

if ($_FILES["pdf_image"]["error"] > 0)
  {
  //echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else{
move_uploaded_file($_FILES["pdf_image"]["tmp_name"],
      "../tour_images/" . $_FILES["pdf_image"]["name"]);
$filename1 = basename($_FILES['pdf_image']['name']);
$qryUpdate.=", pdf_image='$filename1'";
$qryUpdate="update prod_tour_img set prod_tour_image='$filename1'";
}

$qryUpdate.=" where prod_tour_id='$pdf_id'";
	
	if(mysql_query($qryUpdate)){?>
        <script language="javascript">
        window.location="prod_tour.php";
        
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
    <td width="8" height="8" align="left" valign="top"></td>
    <td height="8" ></td>
    <td width="8" align="right" valign="top"></td>
  </tr>
  <tr>
    <td width="8" background="images/main_lft_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
    <td width="100%" align="left" valign="top" ><table width="100%"  height="100%"border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" valign="top"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td width="3" >&nbsp;</td>
            <td width="100%" valign="top" ><?php include("includes/menu.php");?></td>
            <td width="3" >&nbsp;</td>
          </tr>
          
        </table></td>
        <td align="center" valign="top" style="padding-top:15px;">
            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="30" class="heading">Edit Production Tour Image</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="4" height="3"></td>
                    <td ></td>
                    <td width="4" height="3"></td>
                  </tr>
                  <tr>
                    
                    <td valign="top" background="images/usr_bg2.jpg" style="background-repeat:repeat-x;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" style="padding-top:10px;">
                              <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?prod_tour_id='.$_GET['prod_tour_id'];?>" enctype="multipart/form-data">
                              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="3">
                                <tr> 
                  <td> <b>Name</b></td>
                  <td><input name="pdf_name" type="text" class="textbox1" id="pdf_name" style="border-width:1; border-style:solid;font-size:10; " size="40" value="<?php echo $rowNews['prod_tour_name'];?>"></td>
                   <td>&nbsp;</td>
              </tr>
                                
                                <tr>
                                  <td height="19" align="right" class="usr_info">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                 
                                
                                
                              
                                <tr> 
                  <td><b>Production Image</b></td>
                  <td><input name="pdf_image" type="file" class="textbox1" id="pdf_image" style="border-width:1; border-style:solid;font-size:10; " size="40"></td>
                   <td>&nbsp;</td>
              </tr>
                                
                                <tr>
                                  <td height="19" align="right" class="usr_info">&nbsp;</td>
                                  <td><img src="../tour_images/<?php echo $rowNews['prod_tour_image'];?>" width="50" height="50" border="0" /> </td>
                                  <td>&nbsp;</td>
                                </tr>
                                
                                <tr>
                                  <td class="usr_info">&nbsp;</td>
                                  <td> <input type="submit" name="submit" id="submit" value="Edit Tour Image" /></td>
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
                          <td width="122" align="right" valign="top" style="padding-left:10px; padding-top:10px;"></td>
                        </tr>
                    </table></td>
                  
                  </tr>
                  <tr>
                    <td width="4" height="3"><img src="images/corn_3.jpg" width="4" height="3"></td>
                    <td background="images/usr_btm_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
                    <td width="4" height="3"><img src="images/corn_4.jpg" width="4" height="3"></td>
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
  
</table>
</body>
</html>

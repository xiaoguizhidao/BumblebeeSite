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
 window.location="prod_tour.php?prod_tour_id=<?php echo($rsColors['prod_tour_id']."&action=delete_image"); ?>";
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
  }
else
move_uploaded_file($_FILES["pdf_image"]["tmp_name"],
      "../tour_images/" . $_FILES["pdf_image"]["name"]);
$filename = basename($_FILES['pdf_image']['name']);




	$pdf_name=$_POST['pdf_name'];
	//$pdf_size=$_POST['pdf_size'];
	$qry="insert into prod_tour_img(prod_tour_name,prod_tour_image) values('$pdf_name','$filename')";
	
	if(mysql_query($qry)or die(mysql_error())){
		$msg="Image has been added successfully";
	}else{
		$msg="There is some error in adding Image. Please try again.";
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
    <td height="5" colspan="3"></td>
  </tr>
  
  <tr>
    <td width="8" background="images/main_lft_bg.jpg"><img src="images/x.gif" width="1" height="1"></td>
    <td width="100%" align="left" valign="top" ><table width="100%"  height="100%"border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" valign="top"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
           
            <td width="100%" valign="top" ><?php include("includes/menu.php");?></td>
            
          </tr>
        
        </table></td>
        <td align="center" valign="top" style="padding-top:15px;">
            <table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="30" class="Black_Text"><span class="heading">Manage Production Tour Images</span></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="370" height="3"></td>
                    <td width="400" ></td>
                    <td width="1" height="3"></td>
                  </tr>
                  <tr>
                    
                    <td valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" style="padding-top:10px;">
                              <form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" name="frmCms">
                              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="3">
                                <tr> 
                  <td> <b>Name:</b></td>
                  <td><input name="pdf_name" type="text" class="textbox1" id="pdf_name" style="border-width:1; border-style:solid;font-size:10; " size="40"></td>
                   <td>&nbsp;</td>
              
                                
                                
                                
                                <tr>
                                  <td height="19" align="right" class="usr_info">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                 <tr> 
                  <td><b> Image</b></td>
                  <td><input name="pdf_image" type="file" class="textbox1" id="pdf_image" style="border-width:1; border-style:solid;font-size:10; " size="40"></td>
                   <td>&nbsp;</td>
              </tr>
                                
                                <tr>
                                  <td height="19" align="right" class="usr_info">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                
                                <tr>
                                  <td class="usr_info">&nbsp;</td>
                                  <td> <input type="submit" name="submit" id="submit" value="Add New Image" /></td>
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
                          
                        </tr>
                    </table></td>
                   
                  </tr>
                  <tr>
                    <td width="370" height="3"></td>
                    <td ></td>
                    <td width="1" height="3"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                    <td width="60%" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderbtm">
                        <tr>
                          <td height="27" colspan="2" bgcolor="#efefda" class="main_table_border"><table width="100%" cellpadding="0" cellspacing="0" class="Lblack">
                            <tr>

                              <td width="156" align="center">Image</td>
                              <td width="425" align="center">Name</td>
                              
                              
                              <td width="189" align="center">Action</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top">
                          
                          
                          <table width="100%" bgcolor="#EFEFDA" border="0" cellpadding="0" cellspacing="0" id="maintable">
                        <?php
			   if ($_REQUEST['action']=="delete_image"){
				  $pdf_id=$_GET['prod_tour_id'];
				  $del="delete from prod_tour_img where prod_tour_id='$pdf_id'";
				  $delete=mysql_query($del) or die(mysql_error());
				}
   $sqlColors=mysql_query("select * from prod_tour_img order by prod_tour_id desc")or die(mysql_error());
			  $r=0;
			  while($rsColors=mysql_fetch_array($sqlColors)){
			  $r++;
  ?>
                                
                              <tr onMouseOver="this.style.backgroundColor='#f9f9ec';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#cccccc';">
                                <td width="20%"  height="50" class="border4" align="center"><img src="../tour_images/<?php echo $rsColors['prod_tour_image']; ?>" width="24" height="24"></td>
                                <td width="54%" class="border4" align="center" style="padding-left:5px;"><strong class="dataTable_title"><?php echo $rsColors['prod_tour_name']; ?></strong></td>
                                
                                
                                <td width="26%" class="border4" align="center" >
                                <a onClick="return confirmation()" href="prod_tour.php?prod_tour_id=<?php echo ($rsColors['prod_tour_id']."&action=delete_image"); ?>">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prod_tour_edit.php?prod_tour_id=<?php echo ($rsColors['prod_tour_id']); ?>">Edit</a>                                </td>                                
                                
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
                                    <td width="23%" align="right"><a href="categories.php">Go Back</a>&nbsp;</td>
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
 
</table>
</body>
</html>

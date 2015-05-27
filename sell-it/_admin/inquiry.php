<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
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
        <td align="left" valign="top">        <?php
			  
$qry="SELECT * FROM inquiry";
$result=mysql_query($qry);

?>
        
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderbtm">
            <tr>
              <td height="27" colspan="2" align="center"><?php echo $msg;?></td>
            </tr>
            <tr>
              <td height="27" colspan="2" bgcolor="#efefda" class="main_table_border"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="11%" align="center" class="Lblack" style="padding-left:5px;">Name</td>
                  <td width="1%" align="center"><img src="images/sap.jpg" width="2" height="12"></td>
                  <td width="19%" align="center" class="Lblack" style="padding-left:5px;">Email</td>
                  <td width="1%" align="center"><img src="images/sap.jpg" width="2" height="12"></td>
                  <!--td width="10%" align="center" class="Lblack" style="padding-left:5px;">Date</td-->
                  <!--td width="1%" align="center"><img src="images/sap.jpg" width="2" height="12"></td-->
                  <td width="10%" align="center" class="Lblack" style="padding-left:5px;">Article No</td>
                  <td width="1%" align="center"><img src="images/sap.jpg" width="2" height="12"></td>
                  <td width="10%" align="center" class="Lblack" style="padding-left:5px;">Quantity</td>
                  <td width="1%" align="center"><img src="images/sap.jpg" width="2" height="12"></td>
                  <td width="15%" align="center" class="Lblack" style="padding-left:5px;">Status</td>
                  <td width="1%" align="center"><img src="images/sap.jpg" width="2" height="12"></td>
                 
                  <td width="19%" align="center" class="Lblack" style="padding-left:5px;">Comments</td>
                  <td width="19%" align="center" class="Lblack" style="padding-left:5px;">Actions</td>
                  
                  
                 
                </tr>
              </table></td>
            </tr>
            
            
            <tr>
              <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
               <?php
					$r=0;
while($row=mysql_fetch_array($result)){
$r++;

?>
                  <tr>
                    <td width="11%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><?php echo $row['name'];?></td>
                    <td width="20%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><?php echo $row['e_mail'];?></td>
                    <!--td width="11%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><?php echo $row['date'];?></td-->
                    <td width="11%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><?php //echo($row['article_no']);
					  $wordChunks1 = explode(",", $row['article_no']);
for($i = 0; $i < count($wordChunks1); $i++){
if($wordChunks1[$i]!=''){
	echo $wordChunks1[$i]." <br /><hr />";
	}
}
					  ?></td>
                    <td width="11%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><?php //echo($row['quantity']);
					  $wordChunks2 = explode(",", $row['quantity']);
for($i = 0; $i < count($wordChunks2); $i++){
if($wordChunks2[$i]!=''){
	echo $wordChunks2[$i]." <br /><hr />";
}
}
					  ?></td>
                    <td width="16%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><?php 
					  if($row['status']==0)
					  echo("Pending");
					  else echo("Delivered");?><div align="center"><a href="update_inquiry.php?id=<?php echo $row['id'];?>&status=<?php echo($row['status'])?>"> Update Status</a></div></td>
                      <!-- <td valign="top"><?php echo($row['description']);?></td>--></td>
                    <td width="20%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><?php echo $row['comments'];?></td>
                   <td width="20%" height="50" align="center" bgcolor="#fff3eb" class="lft_border"><a href="delinq.php?id=<?php echo $row['id'];?>">Delete</a></td>
                    
                </tr>
                   <?php }?> 
              </table></td>
            </tr>
            
           
          </table>
          <br></td>
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

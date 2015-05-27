<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>


<?php
if($_POST['hSubmit']==1){

	$hn_name=addslashes($_POST['hn_name']);
	
	
$qryUpdate="insert into clint_cat (cat_name)values('$hn_name')";
	$rsUpdate=mysql_query($qryUpdate) or die(mysql_error());
}
if(isset($_GET['cat_id'])){
$cat_id=$_GET['cat_id'];
$del_qry=mysql_query("delete from clint_cat where cat_id='$cat_id'")or die(mysql_error());
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
            <td width="3" bgcolor="#2A2F32"">&nbsp;</td>
            <td width="100%" valign="top" bgcolor="#2A2F32""><?php include("includes/menu.php");?></td>
            <td width="3" bgcolor="#2A2F32"">&nbsp;</td>
          </tr>
          <tr>
            <td><img src="images/side_menu_btm_lft.jpg" width="3" height="3"></td>
            <td width="3" height="3" bgcolor="#2A2F32"><img src="images/x.gif" width="1" height="1"></td>
            <td align="right"><img src="images/side_menu_btm_rit.jpg" width="3" height="3"></td>
          </tr>
        </table></td>
        <td align="left" valign="top" style="padding-top:15px;"><form 

action="<?php 

echo($_SERVER['PHP_SELF']);?>" 

method="post" 

enctype="multipart/form-data" 

name="frmUpdateSub" 

id="frmUpdateSub">
          <table 

width="100%" border="0" cellpadding="4" 

cellspacing="2" class="main" 

align="center"><tr><td 

colspan="2"><table 

width="100%" border="0" cellpadding="4" 

cellspacing="2" class="main" 

align="center">
           <tr>
            <td height="27" colspan="2"><a href="clients.php">Manage References</a></td>
          </tr>
            <tr>
              <td width="13%"><div align="center">Name</div></td>
              <td width="82%"><input 

name="hn_name" type="text" class="passfieds" id="hn_name" 

value="" size="26"></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" 

value="Insert" name="submit">
                  <input name="hSubmit" 

type="hidden" id="hSubmit" 

value="1">              </td>
            </tr>
            
            <tr>
              <td 

colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="38%"><strong>Client Category</strong></td>
                    <td width="62%"><strong>Delete</strong></td>
                  </tr>
                  <?php 
				  $client_cat=mysql_query("select * from clint_cat") or die(mysql_error());
				  while($row_cat=mysql_fetch_array($client_cat)){
				  ?>
                  <tr>
                    <td><?php echo $row_cat['cat_name'];?></td>
                    <td><a href="<?php echo $_SERVER['PHP_SELF'];?>?cat_id=<?php echo $row_cat['cat_id'];?>">Delete</a></td>
                  </tr>
                  <?php }?>
              </table></td>
              <td width="5%" colspan="2" ><span class="cms"> </span></td>
            </tr>
           
          </table></td>
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

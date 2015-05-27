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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50"><?php include("includes/header.php");?></td>
  </tr>
  <tr>
    <td><table width="900" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="142" valign="top" bgcolor="#EEEEEE"><?php include_once("includes/menu.php");?></td>
        <td width="746" valign="top">
        <?php echo($msg);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="67%" valign="top">Size<br />
          <br />
          <?php include("includes/size.php");?><br />
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
</table>          </td>
    <td width="33%" valign="top"><br />
<br />

    <?php
	include("includes/new_sizes.php");
	include("includes/edit_size.php");
	?>    </td>
  </tr>
</table>

          </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

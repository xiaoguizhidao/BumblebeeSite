<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
$id=$_GET['news_id'];
$qry="SELECT * FROM headernews where id='$id'";
$result=mysql_query($qry);
echo $result;
$rs=mysql_fetch_array($result);
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
      
        <table border="1" width="100%" 

cellspacing="0" cellpadding="2" height="40" 

bgcolor="#F0F1F1">
          <tr>
            <td class="bg1" align="center">NEWS</td>
           
          </tr>
          <tr>
            <td colspan="2" align="center"><br>
<form action="edit_headernews.php" method="post" enctype="multipart/form-data" name="frmUpdateSub" id="frmUpdateSub"><br><br>
			  <table 

width="100%" border="0" cellpadding="4" 

cellspacing="0" class="main" 

align="center"  >
  
  <tr>
    <td width="23%">&nbsp;</td>
    <td width="10%"> Header News </td>
    <td width="67%"><input type="text" 

name="news_heading" id="news_heading" 

value="<?php echo $rs['headernews'];?>"></td>
  </tr>
 <tr>
    <td width="23%">&nbsp;</td>
    <td width="10%">News</td>
    <td><textarea name="newsdes" id="newsdes"><?php echo $rs['news'];?></textarea></td>
  </tr>
 
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp; </td>
    <td><input type="submit" name="Submit" value="Submit" /></td>
  </tr>
 	<tr>
 	  <td>&nbsp;</td>
 	  <td>&nbsp; </td>
 	  <td>&nbsp;</td>
 	  </tr>
 	<tr>
 	  <td colspan="2">&nbsp;</td>
 	  <td><input name="hSubmit" 

type="hidden" id="hSubmit" 

value="1"></td>
 	  </tr>
 	 
	<tr>
 		<td 

colspan="2">&nbsp;</td>
<td colspan="2" ><span class="cms"> </span></td>
	</tr>
	 
</table>

                  </form>
 

<table width="100%" border="0" 

cellpadding="3" cellspacing="0" 

class="main">
  <tr>
    <td></td>
  </tr>
 
  <tr  >
  </tr>

</table>
			</td>
            </tr>
        </table>

          </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

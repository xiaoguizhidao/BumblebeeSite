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
        <table border="1" width="100%" 

cellspacing="0" cellpadding="2" height="40" 

bgcolor="#F0F1F1">
      <tr>
        <td>
		<?php
$qry="SELECT * FROM headernews";
$result=mysql_query($qry);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#EEEEEE">
  <tr class="bg1">
    <td width="187" >Header News </td>
    <td width="244">News</td>
    
    <td width="220">Edit/Delete</td>
  </tr>
<?php
while($row=mysql_fetch_array($result)){
?>
  <tr class="main">
    <td valign="top"><?php echo($row['headernews']);?></td>
	<td valign="top"><?php echo($row['news']);?></td>
	
    <td valign="top"><a href="headernewsedit.php?news_id=<?php echo($row['id']);?>">Edit</a> |  <a 

href="news.php?news_id=<?php echo($row['id']);?>">Delete</a> </td>
  </tr>
  <?php }?> 
</table>

		</td>
      </tr>
      <tr>
        <td align="center"><form action="addheadernews.php" method="post">
	<input type="submit" value="Add News" name="submit" id="submit" align="middle"/>
</form></td>
      </tr>
    </table>

          </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

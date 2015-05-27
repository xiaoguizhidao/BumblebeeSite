<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
$newpid=$_REQUEST['p_id'];
?>


<?php
if($_POST['upload']==1){


$qrydc=mysql_query("delete from tbl_relatedp where p_id='".$newpid."'") or die("Invalid Values: " . mysql_error());
		////////////////
	$makesizede=mysql_query("select * from products where p_id!='".$newpid."'") or die("Invalid Values: " . mysql_error());
			 

$count=mysql_num_rows($makesizede);
if($count>0){
for($j=1;$j<=$count;$j++){
$datatech=mysql_fetch_row($makesizede);


if (!empty($_POST["sel".$datatech[0]])) {
$qryprodsize=mysql_query("insert into tbl_relatedp (p_id, relatedp) values('".$newpid."','".$_POST["sel".$datatech[0]]."')") or die("Invalid Values: " . mysql_error());
}
}
} 
$msg="Action Performed Successfully.";
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
        <td align="center" valign="top" background="images/usr_bg2.jpg" style="background-repeat:repeat-x;"><form action="related_products.php?p_id=<?php echo $newpid;?>" method="post" enctype="multipart/form-data">
          <table width="96%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="center" valign="middle">&nbsp;</td>
            </tr>
<?php
$gllery_qry=mysql_query("select * from products where p_id=".$newpid."")or die(mysql_error());
if (mysql_num_rows($gllery_qry)>0){
$rows=mysql_fetch_array($gllery_qry);
$myano=$rows['article_no'];
}
?>
            <tr>
              <td height="30" align="left" valign="middle" class="heading">Related Products For&nbsp;:&nbsp;<?php echo $myano;?></td>
            </tr>
            <tr>
              <td height="30" align="center" valign="middle">&nbsp;</td>
            </tr>
            <tr>
              <td height="30" align="center" valign="middle" class="heading"><?php echo $msg;?></td>
            </tr>
            <tr>
              <td height="22" align="center" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="80" height="22" align="left" valign="middle"><strong>Select</strong></td>
                  <td width="80" height="22" align="left" valign="middle"><strong>Article No</strong></td>
                  <td width="80" height="22" align="left" valign="middle"><strong>Name</strong></td>
                   <td width="80" height="22" align="left" valign="middle"><strong>Select</strong></td>
                  <td width="80" height="22" align="left" valign="middle"><strong>Article No</strong></td>
                  <td width="80" height="22" align="left" valign="middle"><strong>Name</strong></td>
                   <td width="80" height="22" align="left" valign="middle"><strong>Select</strong></td>
                  <td width="80" align="left" valign="middle"><strong>Article No</strong></td>
                  <td width="80" align="left" valign="middle"><strong>Name</strong></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
<?php 
$gllery_qry=mysql_query("select * from products where p_id!=".$newpid."")or die(mysql_error());
$trows = mysql_num_rows($gllery_qry);
$row=0;
while($rows=mysql_fetch_array($gllery_qry)){
?>
                  <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="80" height="20" align="left" valign="middle">
<?
$qryprodsize=mysql_query("select recid from tbl_relatedp where p_id='".$newpid."' and relatedp='".$rows["p_id"]."' ") or die("Invalid SQL ".mysql_error());	

if ($qryprodsize){
$prodrows = mysql_num_rows($qryprodsize);
if($prodrows>0){
$Checked="Checked";
}else{
$Checked="";
}
}
?>
                      <input name="sel<? echo($rows['p_id']);?>" type="checkbox" id="sel<? echo($rows['p_id']);?>" value="<?php echo $rows['p_id'];?>" <?=$Checked;?>></td>
                      <td width="80" height="20" align="left" valign="middle"><?php echo $rows['article_no'];?></td>
                      <td width="80" height="20" align="left" valign="middle"><?php echo $rows['name'];?></td>
                    </tr>
                  </table></td>
<?php
$row++;
if ($row%3==0){
echo "</tr><tr>";
}
}
?>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top"><input type="submit" name="button" id="button" value="Attach Products As Related Products">
                <input name="upload" type="hidden" id="upload" value="1" /></td>
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

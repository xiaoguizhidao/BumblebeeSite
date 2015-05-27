<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>

<?php 
if(isset($_GET['action']) && $_GET['action']=="delete") {
$news_id=$_GET['news_id'];
$dqur="delete from news where news_id='$news_id'";
$delete=mysql_query($dqur);
$msge=1;
}
?>

<?php
if(isset($_POST['hSubmit']) && $_POST['hSubmit']==1){

	$news_id=$_GET['news_id'];
	$news_heading=$_POST['news_heading'];
	$news_des=$_POST['news_des'];
	
$qryUpdate="update news set news_heading='$news_heading', news_des='$news_des' where news_id='$news_id'";
	$rsUpdate=mysql_query($qryUpdate);
	$msg=1;
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
        <td align="left" valign="top" style="padding-top:15px;"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderbtm">
            <tr>
              <td height="27" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="27" colspan="2" bgcolor="#e4e4e4" class="main_table_border"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="19%" class="Lblack" style="padding-left:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="19%" class="Lblack" style="padding-left:5px;">Date</td>
                  <td align="left"><img src="images/sap.jpg" width="2" height="12"></td>
                  <td width="61%" class="Lblack"style="padding-left:5px;">News</td>
                  <td><img src="images/sap.jpg" width="2" height="12"></td>
                  <td width="20%" class="Lblack"style="padding-left:5px;">Action</td>
                </tr>
              </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                 <?php
$qry="SELECT * FROM news";
$result=mysql_query($qry);
$r=0;
while($row=mysql_fetch_array($result)){
$r++;
if($r%2==0){
$bg1="#e4e4e4
";
$bg2="#f9f9ec";
$bg3="#e4e4e4";
}else {
$bg1="#ffdfcb";
$bg2="#e4e4e4
";
$bg3="#f2f2f2";

}
?> <tr>
                    <td width="20%" height="50" align="center" bgcolor="<?php echo $bg3;?>" class="lft_border"><?php echo($row['news_date']);?></td>
                    <td width="60%" bgcolor="<?php echo $bg3;?>" class="border2" style="padding-left:5px;"><?php echo($row['news_heading']);?></td>
                    <td width="10%" align="center" bgcolor="<?php echo $bg3;?>" class="border3"><a href="newsedit.php?news_id=<?php echo($row['news_id']);?>"><img src="images/icons/icon_action.jpg" width="20" height="17" border="0"></a></td>
                    <td width="10%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"><a 

href="news.php?news_id=<?php echo($row['news_id']);?>&action=delete"><img src="images/icons/icon_delete_lit.jpg" width="13" height="17" border="0"></a></td>
                    </tr><?php }?>
                 
                 
                 
                  <tr>
                    <td height="50" align="center" bgcolor="#e4e4e4" class="lft_border" colspan="4"><form action="addnews.php" method="post">
	<input type="submit" value="Add News" name="submit" id="submit" align="middle"/>
</form></td>
                    
                    
                    </tr>
              </table></td>
            </tr>
          </table></td>
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

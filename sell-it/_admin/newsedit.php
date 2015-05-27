<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?><?php
if($_POST['hSubmit']==1){

if ($_FILES["file"]["error"] > 0)
  {
  //echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
 move_uploaded_file($_FILES["file"]["tmp_name"],
      "../newsimages/" . $_FILES["file"]["name"]);



	$news_id=$_GET['news_id'];
	$news_heading=$_POST['news_heading'];
	$news_des=$_POST['news_date'];
	$news_longdes=$_POST['news_longdes'];

	
	
	$qryUpdate="update news set news_heading='$news_heading', news_date='$news_des',news_longdes='$news_longdes'";
	if($_FILES['file']['tmp_name']!=""){
	$filename = basename($_FILES['file']['name']);
	$qryUpdate .= ", image='$filename'";
	}
	$qryUpdate .= " where news_id='$news_id'";
	$rsUpdate=mysql_query($qryUpdate);
	$msg=1;?>
<script language="javascript">
 window.location="<?php echo 'news.php'?>";
 </script>	
<?php }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="includes/general.js"></script>
<script src="calendar.js" type="text/javascript" language="javascript"></script>
    <style type="text/css" media="screen,projection">
@import url(calendar.css);
</style>
<script type="text/javascript" src="../tinymce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "textareas",
		textarea_trigger : "convert_this",
		plugins : "advimage",
		external_image_list_url : "../tinymce/images.php"
	});
</script>

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
        <td align="left" valign="top" style="padding-top:15px;"><table border="1" width="100%" cellspacing="0" cellpadding="2" height="40" bgcolor="#F0F1F1">
          <tr>
            <td align="center">
			
			<?php
		$news_id=$_GET['news_id'];
		$qryPage="select * from news where news_id='$news_id' limit 1";
		$rsPage=mysql_query($qryPage) or die(mysql_error());
		$rowPage=mysql_fetch_array($rsPage);
			?>
			<form action="<?php echo($_SERVER['PHP_SELF']."?news_id=".$_GET['news_id']);?>" 

method="post" enctype="multipart/form-data" name="frmUpdateSub" id="frmUpdateSub"><br><br>
			  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="main" align="center">
  
  <!--<tr>
    
    <td width="16%">News Heading</td>
    <td width="61%"><input type="text" name="news_heading" id="news_heading" value="<?php echo($rowPage['news_heading']); 

?> "></td>
  </tr>-->
  <tr>
    
    <td width="16%">News Date</td>
    <td><div id="calendarDiv"></div>
                <input name="news_date" type="text" class="textfield2" size="15"  maxlength="50"  readonly="yes" value="<?php echo($rowPage['news_date']); ?>"></td>
  </tr>
  
  
  <tr>
   
    <td>News Descripition</td>
    <td><textarea name="news_longdes" id="news_longdes" cols="70" rows="25"><?php echo($rowPage['news_longdes']); ?> 
	</textarea></td>
  </tr>
<!--<tr>
 	  
 	  <td>Image</td>
 	  <td><input type="file" name="file" id="file">	
 	    <?php if($rowPage['image']!=''){?> <img src="../newsimages/<?php echo($rowPage['image']);?>" 

width="75" height="75" />   <?php }?>(103 * 62)</td>
 	  </tr>-->
 	<tr>
 	  <td>&nbsp;</td>
 	  <td><input type="submit" value="Insert" name="submit">
 	  <input name="hSubmit" type="hidden" id="hSubmit" value="1"></td>
 	  <td></td>
 	  </tr>
 	<?php
  if($msg==1){
  ?>
	
	<tr>
 		<td colspan="2">&nbsp;</td>
<td colspan="2" ><span class="cms"><?php if($msg==0){ echo("There is some error in inserting data.");}
if($msg==1){ echo("Record has been inserted successfully.");}
?>.</span></td>
	</tr>
	<?php
	}
	?>
</table>
                  </form>
<?php
$rsNews=mysql_query("select * from news");
//$noNews=mysql_num_rows($rsNews);
if($noNews==0){
//echo("No news");
}else{
?>

<table width="100%" border="0" cellpadding="3" cellspacing="0" class="main">
  <tr>
    <td></td>
  </tr>
<?php
$i=0;
while($rowNews=mysql_fetch_array($rsNews)){
$i++;
?>
  <tr <?php if($i%2==0){ echo("bgcolor=#EEEEEE");}?>>  </tr>
<?php }?>
</table>
<?php }?>			</td>
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

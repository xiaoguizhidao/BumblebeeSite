<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>
<?php
$p_id=$_REQUEST['p_id'];

if($_POST['hSubmit']==1){
	$p_id=$_REQUEST['p_id'];
	$color_id=$_POST['color_id'];
	$article_no=$_POST['article_no'];
	$rsChk=mysql_query("select * from ".TBL_PRODUCT_COLORS." where p_id='$p_id' and color_id='$color_id'");
	$noChk=mysql_num_rows($rsChk);
	$rsChk2=mysql_query("select * from ".TBL_PRODUCT_COLORS." where article_no='$article_no'");
	$noChk2=mysql_num_rows($rsChk2);
	$rsChk3=mysql_query("select * from ".TBL_PRODUCTS." where article_no='$article_no'");
	$noChk3=mysql_num_rows($rsChk3);
	if($noChk>0){
		$msg="<span class=msg_error>Product for this color already exists</span>";
	}elseif($noChk2>0 || $noChk3>0){
		$msg="<span class=msg_error>A product with this article no already exists</span>";
	}else{
		if(!empty($_FILES['color_image']) && ($_FILES['color_image']['error'] == 0)) {
		$filename = basename($_FILES['color_image']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
			$img_src = $_FILES["color_image"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			$rsLastPC=mysql_query("select max(pc_id) as max_pcid from ".TBL_PRODUCT_COLORS." limit 1");
			$rowLastPC=mysql_fetch_array($rsLastPC);
			$max_pcid=$rowLastPC['max_pcid']+1;
			$changedFilename = "c_".$max_pcid.$filename;
			@copy("$img_src","../products/".$changedFilename);
		}
		
		mysql_query("insert into ".TBL_PRODUCT_COLORS."(color_id, pc_image, article_no, p_id) values('$color_id', '$changedFilename', '$article_no', '$p_id')") or die(mysql_error());
		$msg="<span class=msg_ok>Product color option has been added successfully.</span>";
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
        <td width="746" valign="top"><table border="1" width="100%" cellspacing="0" cellpadding="2" height="40" bgcolor="#F0F1F1">
          <tr>
            <td align="center">NEWS EDIT</td>
           
          </tr>
          <tr>
            <td align="center"><br>
			<?php /*?><?php
		$qryPages="select * from news";
		$rsPages=mysql_query($qryPages);
		while($rowPages=mysql_fetch_array($rsPages)){
		echo("<a 

href=".$_SERVER['PHP_SELF']."?news_id=".$rowPages['news_id'].">".$rowPages['news_heading']."</a> | ");
			}
			?><?php */?>
			<?php
		$news_id=$_GET['news_id'];
		$qryPage="select * from news where news_id='$news_id' limit 1";
		$rsPage=mysql_query($qryPage) or die(mysql_error());
		$rowPage=mysql_fetch_array($rsPage);
			?>
			<form action="<?php echo($_SERVER['PHP_SELF']."?news_id=".$_GET['news_id']);?>" 

method="post" enctype="multipart/form-data" name="frmUpdateSub" id="frmUpdateSub"><br><br>
			  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="main" align="center">
  
  <tr>
    <td width="23%">&nbsp;</td>
    <td width="16%">News Heading</td>
    <td width="61%"><input type="text" name="news_heading" id="news_heading" value="<?php echo($rowPage['news_heading']); 

?> "></td>
  </tr>
  <tr>
    <td width="23%">&nbsp;</td>
    <td width="16%">News</td>
    <td><input type="text" name="news_des" id="news_des" value="<?php echo($rowPage['news_des']); ?>"></td>
  </tr>
  
  
  <tr>
    <td>&nbsp;</td>
    <td>News Descripition</td>
    <td><textarea name="news_longdes" id="news_longdes" cols="70" rows="25"><?php echo($rowPage['news_longdes']); ?> 
	</textarea></td>
  </tr>
 	<tr>
 	  <td>&nbsp;</td>
 	  <td>Image</td>
 	  <td><input type="file" name="file" id="file">	 <img src="../newsimages/<?php echo($rowPage['image']);?>" 

width="75" height="75" />   </td>
 	  </tr>
 	<tr>
 	  <td colspan="2">&nbsp;</td>
 	  <td><input type="submit" value="Insert" name="submit">
 	    <input name="hSubmit" type="hidden" id="hSubmit" value="1"></td>
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
  <tr <?php if($i%2==0){ echo("bgcolor=#EEEEEE");}?>>
  </tr>
<?php }?>
</table>
<?php }?>			</td>
            </tr>
        </table>

          </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

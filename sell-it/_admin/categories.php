<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>

<?php
if(isset($_REQUEST['hAction']) && $_REQUEST['hAction']=="add_category"){
	$category=$_REQUEST['category'];
	if($_REQUEST['sort']!=""){
	$sort=$_REQUEST['sort'];
	$des=$_POST['des'];
	}else{
	$sort=0;
	}	
	if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!=""){
	$parent=$_REQUEST['category_id'];
	}else{
	$parent=0;
	}
	$rsChk=mysql_query("select * from ".TBL_CATEGORIES." where category='".$category."' and parent='".$parent."'");
	$noChk=mysql_num_rows($rsChk);
	if($noChk>0){
	$msg.="<div class=msg_error>A category with this name already exists.</div><br/>";
	}elseif($noChk==0){
	if(!empty($_FILES['cat_image']) && ($_FILES['cat_image']['error'] == 0)) {
		$filename = basename($_FILES['cat_image']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
			$img_src = $_FILES["cat_image"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			//$rsLastCategory=mysql_query("select max(category_id) as max_categoryid from ".TBL_CATEGORIES." limit 1");
			//$rowLastCategory=mysql_fetch_array($rsLastCategory);
			//$max_categoryid=$rowLastProduct['max_categoryid'];
			$changedFilename = time().$filename;
			@copy("$img_src","../categories/".$changedFilename);
	}
	
	if(!empty($_FILES['cat_left_image']) && ($_FILES['cat_left_image']['error'] == 0)) {
		$filename1 = basename($_FILES['cat_left_image']['name']);
		$ext = substr($filename1, strrpos($filename1, '.') + 1);
			$img_src = $_FILES["cat_left_image"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			$rsLastCategory=mysql_query("select max(category_id) as max_categoryid from ".TBL_CATEGORIES." limit 1");
			$rowLastCategory=mysql_fetch_array($rsLastCategory);
			//$max_categoryid=$rowLastProduct['max_categoryid'];
			$changedFilename1 = time().$filename1;
			@copy("$img_src","../categories/left/".$changedFilename1);
	}
	
		$qryInsert="INSERT INTO ".TBL_CATEGORIES." (category, parent, cat_image, sort, des, cat_left_image) VALUES('".$category."', '".$parent."', '".$changedFilename."', '".$sort."', '".$des."', '".$changedFilename1."')";
		if(mysql_query($qryInsert)or die(mysql_error())){
		$msg.="<div class=msg_ok>Category has entered successfully.</div><br />";
		}else{
		$msg.="<div class=msg_error>Ther is some error in entering record. Please try again.</div><br />";
		}
	}
}
if(isset($_REQUEST['hAction']) && $_REQUEST['hAction']=="edit_category"){
	$category=$_REQUEST['category'];
	if($_REQUEST['sort']!=""){
	$sort=$_REQUEST['sort'];
	$des=$_POST['des'];
	$cat_key=$_POST['cat_key'];
	}else{
	$sort=0;
	}
	if($_REQUEST['category_id']!=""){
	$parent=$_REQUEST['category_id'];
	}else{
	$parent=0;
	}
	$rsChk=mysql_query("select * from ".TBL_CATEGORIES." where category='".$category."' and parent='".$parent."' and category_id!='".$_REQUEST['hCategory_id']."'");
	$noChk=mysql_num_rows($rsChk);
	if($noChk>0){
	$msg.="<div class=msg_error>A category with this name already exists.</div><br/>";
	}elseif($noChk==0){
		if(!empty($_FILES['cat_image']) && ($_FILES['cat_image']['error'] == 0)) {
		$filename = basename($_FILES['cat_image']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
			$img_src = $_FILES["cat_image"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			//$max_pid=$rowLastProduct['max_pid'];
			$changedFilename = $_REQUEST['hCategory_id'].$filename;
			@copy("$img_src","../categories/".$changedFilename);
		}
		if(!empty($_FILES['cat_left_image']) && ($_FILES['cat_left_image']['error'] == 0)) {
		$filename1 = basename($_FILES['cat_left_image']['name']);
		$ext = substr($filename1, strrpos($filename1, '.') + 1);
			$img_src = $_FILES["cat_left_image"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			//$max_pid=$rowLastProduct['max_pid'];
			$changedFilename1 = $_REQUEST['hCategory_id'].$filename1;
			@copy("$img_src","../categories/left/".$changedFilename1);
		}
		
		$qryUpdate="UPDATE ".TBL_CATEGORIES." SET category='".$category."', sort='".$sort."',des='".$des."', cat_key='$cat_key'";
		if(isset($changedFilename)){
		$qryUpdate.=", cat_image='$changedFilename'";
		}
		
		//$qryUpdate.=" WHERE category_id='".$_REQUEST['hCategory_id']."'";
		if(isset($changedFilename1)){
		$qryUpdate.=", cat_left_image='$changedFilename1'";
		}
		
		$qryUpdate.=" WHERE category_id='".$_REQUEST['hCategory_id']."'";
		
		if(mysql_query($qryUpdate)){
		$msg.="<div class=msg_ok>Category has updated successfully.</div><br />";
		}else{
		$msg.="<div class=msg_error>Ther is some error in updating record. Please try again.</div><br />";
		}
	}
}
if(isset($_REQUEST['hAction']) && $_REQUEST['hAction']=="edit_move"){
	mysql_query("update products set category_id='".$_POST['lstCats']."' where p_id='".$_POST['hP_id']."'");
	$msg="<div class=msg_ok>Product has been shifted successfully.</div>";
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
        <td align="left" valign="top" style="padding-top:15px;"><table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="heading"><a href="home.php">Home</a><?php //include("includes/bread.php");?></td>
                  <td><?php echo $msg;?><!--<table width="200" border="0" align="right" cellpadding="0" cellspacing="2">
                      <tr>
                        <td>Search:</td>
                        <td align="right"><input type="text" name="textfield43" id="textfield43" style="width:150px;"></td>
                      </tr>
                      <tr>
                        <td>Go To:</td>
                        <td align="right"><select name="select" id="select" style="width:150px;">
                            <option>Top</option>
                          </select>
                        </td>
                      </tr>
                  </table>--></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td width="80%" valign="top"><?php include("includes/categories.php");?></td>
            <td width="20%" valign="top" bgcolor="#e4e4e4"><?php
	include("includes/new_category.php");
	include("includes/edit_category.php");
	include("includes/move.php");
	?></td>
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

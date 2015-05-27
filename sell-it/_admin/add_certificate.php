<?php
session_start();
//require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
?>
<?php
if(isset($_POST['submit'])){
//---------------------------------------------------------------------------------------------
	if(!empty($_FILES['product_image']) && ($_FILES['product_image']['error'] == 0)) {
		$filename = basename($_FILES['product_image']['name']);
		//echo $filename;
		$ext = substr($filename, strrpos($filename, '.') + 1);
			$img_src = $_FILES["product_image"]["tmp_name"];
			//echo $img_src;
			//$changedFilename = $insert_id.".".$ext;
			$rsLastProduct=mysql_query("select max(f_id) as max_pid from factoryimg limit 1")or die(mysql_error());
			$rowLastProduct=mysql_fetch_array($rsLastProduct);
			$max_pid=$rowLastProduct['max_pid']+1;
			$changedFilename = $max_pid.$filename;
			echo $changedFilename;
			$uploadat="../certificate/".$changedFilename;
			$uploadatthumb="../certificate/thumbs/".$changedFilename;
	// This is the temporary file created by PHP 
	$uploadedfile = $_FILES['product_image']['tmp_name'];
	
	// Create an Image from it so we can do the resize
	$src = imagecreatefromjpeg($uploadedfile);
	
	// Capture the original size of the uploaded image
	list($width,$height)=getimagesize($uploadedfile);
	
	$newwidth=550;
	$newheight=($height/$width)*550;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	
	// this line actually does the image resizing, copying from the original
	// image into the $tmp image
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); 
	
	// now write the resized image to disk. I have assumed that you want the
	// resized, uploaded image file to reside in the ./images subdirectory.
	$filename = $uploadat;
	imagejpeg($tmp,$filename,100);
	
	imagedestroy($src);
	imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request
	// has completed.
			//******************************thumbnail***************************************
				// This is the temporary file created by PHP 
				$uploadedfilethumb = $_FILES['product_image']['tmp_name'];
				
				// Create an Image from it so we can do the resize
				$srcthumb = imagecreatefromjpeg($uploadedfilethumb);
				
				// Capture the original size of the uploaded image
				list($widththumb,$heightthumb)=getimagesize($uploadedfilethumb);
				
				$newwidththumb=154;
				$newheightthumb=($heightthumb/$widththumb)*154;
				$tmpthumb=imagecreatetruecolor($newwidththumb,$newheightthumb);
				
				// this line actually does the image resizing, copying from the original
				// image into the $tmp image
				imagecopyresampled($tmpthumb,$srcthumb,0,0,0,0,$newwidththumb,$newheightthumb,$widththumb,$heightthumb); 
				
				// now write the resized image to disk. I have assumed that you want the
				// resized, uploaded image file to reside in the ./images subdirectory.
				$filenamethumb = $uploadatthumb;
				imagejpeg($tmpthumb,$filenamethumb,100);
				
				imagedestroy($srcthumb);
				imagedestroy($tmpthumb); // NOTE: PHP will clean up the temp file it created when the request
				// has completed.
			//******************************************************************************
	}
//---------------------------------------------------------------------------------------------
if(isset($_POST['submit'])){
//---------------------------------------------------------------------------------------------
	if(!empty($_FILES['product_image_large']) && ($_FILES['product_image_large']['error'] == 0)) {
		$filename = basename($_FILES['product_image_large']['name']);
		//echo $filename;
		$ext = substr($filename, strrpos($filename, '.') + 1);
			$img_src = $_FILES["product_image_large"]["tmp_name"];
			//echo $img_src;
			//$changedFilename = $insert_id.".".$ext;
			$rsLastProduct=mysql_query("select max(f_id) as max_pid from factoryimg limit 1")or die(mysql_error());
			$rowLastProduct=mysql_fetch_array($rsLastProduct);
			$max_pid=$rowLastProduct['max_pid']+1;
			$changedFilename1 = $max_pid.$filename;
			echo $changedFilename;
			$uploadat="../certificate1/".$changedFilename1;
			//$uploadatthumb="../certificate/thumbs/".$changedFilename;
	// This is the temporary file created by PHP 
	$uploadedfile = $_FILES['product_image_large']['tmp_name'];
	
	// Create an Image from it so we can do the resize
	$src = imagecreatefromjpeg($uploadedfile);
	
	// Capture the original size of the uploaded image
	list($width,$height)=getimagesize($uploadedfile);
	
	$newwidth=550;
	$newheight=($height/$width)*550;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	
	// this line actually does the image resizing, copying from the original
	// image into the $tmp image
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); 
	
	// now write the resized image to disk. I have assumed that you want the
	// resized, uploaded image file to reside in the ./images subdirectory.
	$filename = $uploadat;
	imagejpeg($tmp,$filename,100);
	
	imagedestroy($src);
	imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request
	// has completed.
			//******************************thumbnail***************************************
				// This is the temporary file created by PHP 
				//$uploadedfilethumb = $_FILES['product_image']['tmp_name'];
				
				// Create an Image from it so we can do the resize
				//$srcthumb = imagecreatefromjpeg($uploadedfilethumb);
				
				// Capture the original size of the uploaded image
				//list($widththumb,$heightthumb)=getimagesize($uploadedfilethumb);
				
				//$newwidththumb=154;
				//$newheightthumb=($heightthumb/$widththumb)*154;
				//$tmpthumb=imagecreatetruecolor($newwidththumb,$newheightthumb);
				
				// this line actually does the image resizing, copying from the original
				// image into the $tmp image
				//imagecopyresampled($tmpthumb,$srcthumb,0,0,0,0,$newwidththumb,$newheightthumb,$widththumb,$heightthumb); 
				
				// now write the resized image to disk. I have assumed that you want the
				// resized, uploaded image file to reside in the ./images subdirectory.
				//$filenamethumb = $uploadatthumb;
				//imagejpeg($tmpthumb,$filenamethumb,100);
				
				//imagedestroy($srcthumb);
				//imagedestroy($tmpthumb); // NOTE: PHP will clean up the temp file it created when the request
				// has completed.
			//******************************************************************************
	}
//---------------------------------------------------------------------------------------------
$fact="insert into certificateimg (c_img ,c_img_large) values ('$changedFilename','$changedFilename1')";
if(mysql_query($fact) or die(mysql_error())){?>
<script language="javascript">
 window.location="certificate.php";
 </script>
<?php }
}
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
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
        <td width="746" valign="top">Iamge  Description <br />
          <br /><form action="#" method="post" name="frmChange" enctype="multipart/form-data"><table width="500" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2"><?php echo($msg);?></td>
    </tr>
  <tr>
    <td width="151">Insert Small Image :</td>
    <td width="341"><input type="file" name="product_image" id="product_image" /></td>
  </tr>
  <tr>
    <td width="151">Insert Large Image :</td>
    <td width="341"><input type="file" name="product_image_large" id="product_image_large" /></td>
  </tr>
  <tr>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="submit" />
      </td>
  </tr>
</table>
          </form>
</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

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
		$fileext = substr($filename,-3);
		if($fileext=="jpg" || $fileext=="gif" || $fileext=="png") {
			$uploadpath = $_SERVER['DOCUMENT_ROOT']."/useruploads/images/".$filename;
			if(move_uploaded_file($_FILES['product_image']['tmp_name'],$uploadpath)) {
				$msg = "Uploaded Successfully!";
			} else {
				$msg = "Error Uplaoding";
			}

		} else {
			$msg = "Invalid File Format";
		}
	}
//---------------------------------------------------------------------------------------------
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
        <td width="746" valign="top">CMS Image<br />
          <br /><form action="#" method="post" name="frmChange" enctype="multipart/form-data"><table width="500" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2"><?php echo($msg);?></td>
    </tr>
  <tr>
    <td width="151">Insert Image :</td>
    <td width="341"><input type="file" name="product_image" id="product_image" /></td>
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

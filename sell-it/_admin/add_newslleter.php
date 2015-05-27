<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg="";
?>
<?php
if(isset($_POST['letter_description'])) {
$body=$_POST['letter_description'];
if(isset($body)){
$qry="SELECT * FROM newsletter";
$result=mysql_query($qry) or die(mysql_error());
while($row=mysql_fetch_array($result)){
$to=$to.$row['email'].",";
}
//echo $to;
$email=$mailto;
$mailto=$to;
	$subject="Online NEWSLETTER FROM Total Plastic Website";
	$header = "From: ". $email . "\r\n";
	@mail($mailto, $subject, $body, $header);
header('location:subscriber.php?msg=Newsletter has been sent successfully');
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($HtmlTitle);?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
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
        <td width="746" valign="top">NewsLetter Description <br />
          <br /><form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="frmChange"><table width="500" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2"><?php echo($msg);?></td>
    </tr>
  <!--<tr>
    <td width="151">Heading Of The Page :</td>
    <td width="341"><textarea name="page_heading" cols="68" id="page_heading"></textarea></td>
  </tr>-->
  <tr>
    <td>Letter Description  :</td>
    <td><textarea name="letter_description" cols="68" rows="13" id="page_description"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="submit" />
      <input name="hSubmit" type="hidden" id="hSubmit" value="1" /></td>
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

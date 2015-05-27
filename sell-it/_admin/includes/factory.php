<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
$msg=$_GET['msg'];
?>
<?php
if($_POST['hSubmit']==1){
	$oldPass=$_POST['oldPass'];
	$newPass=$_POST['newPass'];
	$cPass=$_POST['cPass'];
	if($oldPass=="" || $newPass=="" || $cPass==""){
		$msg="<span class=msg_error>All fields are mandatory</span>";
	}else{
		$rsChk=mysql_query("select * from administrator where password=PASSWORD('".$oldPass."')");
		$noChk=mysql_num_rows($rsChk);
		if($noChk==0){
			$msg="<span class=msg_error>You have provided an incorrect password</span>";
		}else{
			if($newPass!=$cPass){
				$msg="<span class=msg_error>New and confirm password does not match.</span>";
			}else{
				mysql_query("update administrator set password=PASSWORD('".$newPass."')");
				$msg="<span class=msg_ok>Your password has been changed</span>";
			}
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hakim Traders</title>
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
        <td width="746" valign="top"><a href="add_page.php"></a><br />
          <?php echo $msg;?><br />
          <table border="1" width="100%" 

cellspacing="0" cellpadding="2" height="40" 

bgcolor="#F0F1F1">
            <tr>
              <td><?php
$qry="SELECT * FROM pages";
$result=mysql_query($qry);
?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#EEEEEE">
                    <tr class="bg1">
                      <td width="187" >Image Name</td>
                      <!--<td width="244">Descriptions</td>-->
                      <td width="220">Edit </td>
                    </tr>
                    <?php
while($row=mysql_fetch_array($result)){
?>
                    <tr class="main">
                      <td valign="top"><?php echo($row['heading']);?></td>
                     <!-- <td valign="top"><?php echo($row['description']);?></td>-->
                      <td valign="top"><a href="page_edit.php?page_id=<?php echo($row['id']);?>">Edit</a> | <!--<a 

href="delpage.php?page_id=<?php echo($row['id']);?>">Delete</a>--> </td>
                    </tr>
                    <?php }?>
                </table></td>
            </tr>
            <tr>
              <td align="center"><form action="addnews.php" method="post">
                <a href="add_image.php">Add new Image</a>
                  
              </form></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

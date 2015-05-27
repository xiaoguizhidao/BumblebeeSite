<?php
if(isset($_REQUEST['hAction']) && $_REQUEST['hAction']=="add_product"){
	$hUrl=$_REQUEST['hUrl'];
	$category_id=addslashes($_REQUEST['category_id']);
	$article_no=addslashes($_REQUEST['article_no']);
	$name=addslashes($_REQUEST['name']);
	$price=addslashes($_REQUEST['price']);
	$m_price=addslashes($_REQUEST['m_price']);
	$description=addslashes($_REQUEST['description']);
	$p_sort=$_POST['p_sort'];

	//---------------------------------------------------------------------------------------------
	if(!empty($_FILES['product_image']) && ($_FILES['product_image']['error'] == 0)) {
		$filename = basename($_FILES['product_image']['name']);
		echo $filename."<br>";
		$ext = substr($filename, strrpos($filename, '.') + 1);
		echo $ext."<br>";
			$img_src = $_FILES["product_image"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			$changedFilename = time().$filename;
			echo $changedFilename."<br>";
			$uploadat="../products/".$changedFilename;
			echo $uploadat."<br>";
	$uploadedfile = $_FILES['product_image']['tmp_name'];
	
	if(move_uploaded_file($uploadedfile,$uploadat)) {
		$uploadedimage = $changedFilename;
	} else {
		$uploadedimage = NULL;
	}
	}
//---------------------------------------------------------------------------------------------
	$qryInsert="insert into ".TBL_PRODUCTS." (article_no, name, description, price, category_id, product_image,sort) values('".$article_no."', '".$name."', '".$description."', '".$price."', '".$category_id."', '".$uploadedimage."','".$p_sort."')";
	
	
	if(mysql_query($qryInsert) or die (mysql_error())){?>
		<script language="javascript">
 window.location="<?php echo $hUrl; ?>";
 </script>
	<?php }else{
		$msg.="<div class=msg_error>There is some problem in uploading this product. Please try again.</div>";
	}
}
?>

<SCRIPT LANGUAGE="JavaScript">
<!-- 

<!-- Begin
function Check(chk)
{
if(document.frmAddProduct.Check_ctr.checked==true){
for (i = 0; i < chk.length; i++)
chk[i].checked = true ;
}else{

for (i = 0; i < chk.length; i++)
chk[i].checked = false ;
}
}

// End -->
</script>
<table width="100%" border="0" cellpadding="3" cellspacing="0">
<form action="#" method="post" enctype="multipart/form-data" name="frmAddProduct">
<tr>
    <td width="25%"><div align="center">Article No : </div></td>
    <td width="75%"><input name="article_no" type="text" id="article_no" class="textfield1"></td>
  </tr>
  <tr>
    <td><div align="center">Product Name : </div></td>
    <td><input name="name" type="text" id="name"></td>
  </tr>
  <tr>
    <td valign="top"><div align="center">Description : </div></td>
    <td><textarea name="description" cols="50" rows="5" id="description"></textarea></td>
  </tr>
  <tr>
    <td><div align="center">Price : </div></td>
    <td><input name="price" type="text" id="price"></td>
  </tr>
  <tr>
    <td><div align="center">Product Image : </div></td>
    <td><input name="product_image" type="file" id="product_image"></td>
  </tr>
  <tr>
    <td><div align="center">Product Sort Order : </div></td>
    <td> <input name="p_sort" type="text" value="0"  size="5"/></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Add Product">
      <input name="category_id" type="hidden" id="category_id" value="<?php echo($_POST['category_id']);?>" />
      <input name="hAction" type="hidden" id="hAction" value="add_product" />
      <input name="hUrl" type="hidden" id="hUrl" value="<?php echo($_REQUEST['hUrl']);?>" /></td>
  </tr>
</form>
</table>

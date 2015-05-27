<?php
if(isset($_REQUEST['hAction']) && $_REQUEST['hAction']=="edit_product"){
	
	$p_id=$_REQUEST['p_id'];
	//$category_id=$_REQUEST['category_id'];
	//$hUrl='categories.php?category_id='.$category_id;
	$hUrl=$_REQUEST['hUrl'];
	$article_no=$_REQUEST['article_no'];
	$name=$_REQUEST['name'];
	$description=addslashes($_REQUEST['description']);
	$price=$_REQUEST['price'];
	$m_price=addslashes($_REQUEST['m_price']);
	//$tech_spec=addslashes($_REQUEST['tech_spec']);
	$p_sort=$_POST['p_sort'];
	if(!empty($_FILES['product_image']) && ($_FILES['product_image']['error'] == 0)) {
		$filename = basename($_FILES['product_image']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
			$img_src = $_FILES["product_image"]["tmp_name"];
			//$changedFilename = $insert_id.".".$ext;
			$changedFilename = time().$filename;
			$uploadat="../products/".$changedFilename;
			$uploadedfile = $_FILES['product_image']['tmp_name'];
			$filename = $uploadat;
			move_uploaded_file($uploadedfile,$uploadat);
		
	}
	$qryUpdate="update ".TBL_PRODUCTS." set article_no='$article_no', name='$name', description='$description', price='$price', sort='$p_sort'";
	if(isset($changedFilename)){
	$qryUpdate.=", product_image='$changedFilename'";
	}
	$qryUpdate.=" where p_id='$p_id'";
	
	
	
	if(mysql_query($qryUpdate) or die(mysql_error())){?>
		
<script language="javascript">
 window.location="<?php echo $hUrl?>";
 </script>
<?php	}else{
		$msg.="<div class=msg_error>There is some problem in editting this product. Please try again.</div>";
	}
}
$p_id=$_REQUEST['p_id'];
$rsSel=mysql_query("select * from products where p_id='".$p_id."' limit 1");
$rowSel=mysql_fetch_array($rsSel);
?>

<table width="100%" border="0" cellpadding="3" cellspacing="0">
<form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" name="frmAddProduct">
<tr>
    <td width="22%"><div align="center">Item No : </div></td>
    <td width="78%"><input name="article_no" type="text" id="article_no" class="textfield1" value="<?php echo($rowSel['article_no']);?>"></td>
  </tr>
  <tr>
    <td><div align="center">Product Name : </div></td>
    <td><input name="name" type="text" id="name" value="<?php echo($rowSel['name']);?>"></td>
  </tr>
  <tr>
    <td><div align="center">Description : </div></td>
    <td><textarea name="description" cols="50" rows="5" id="description"><?php echo($rowSel['description']);?></textarea></td>
  </tr>
  <tr>
    <td><div align="center">Your Price : </div></td>
    <td><input name="price" type="text" id="price" value="<?php echo($rowSel['price']);?>"></td>
  </tr>
  <tr>
    <td><div align="center">Product Image : </div></td>
    <td><input name="product_image" type="file" id="product_image">
      <img src="../products/<?php echo $rowSel['product_image'];?>" width=50 height=50 />(623 *389)</td>
  </tr>

  
  
  <tr>
    <td><div align="center">Product Sort Order : </div></td>
    <td> <input name="p_sort" type="text" value="<?php echo($rowSel['sort']);?>"  size="5"/></td>
  </tr>
  
  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Update Product">
      <input name="hAction" type="hidden" id="hAction" value="edit_product" />
      <input name="hUrl" type="hidden" id="hUrl" value="<?php echo($_REQUEST['hUrl']);?>" />
      <input type="hidden" name="p_id" id="p_id" value="<?php echo($_REQUEST['p_id']);?>"></td>
  </tr>
</form>
</table>

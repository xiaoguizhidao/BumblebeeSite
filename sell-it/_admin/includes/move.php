<?php
if(isset($_REQUEST['action']) && $_REQUEST['action']=="move"){
$category_id=$_REQUEST['cat_id'];
$p_id=$_REQUEST['p_id'];
$rsProduct=mysql_query("select * from products where p_id='$p_id' limit 1");
$rowProduct=mysql_fetch_array($rsProduct);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bg2">
  <tr>
    <td class="bg1">Move Product</td>
  </tr>
  <tr>
    <td><?php echo("Please select which category you wish <strong>".$rowProduct['name']."</strong> to reside in");?></td>
  </tr>
  <form action="<?php echo($_SERVER['PHP_SELF']."?category_id=".$_REQUEST['category_id']);?>" method="post" enctype="multipart/form-data" name="frmEditCat">
  <tr>
    <td>Category Name :<br>
      <select name="lstCats" id="lstCats">
      <?php
      $rsListCats=mysql_query("select category_id, category from categories where status=1");
	  while($rowListCats=mysql_fetch_array($rsListCats)){
	  ?>
      <option value="<?php echo($rowListCats['category_id']);?>" <?php if($rowListCats['category_id']==$_GET['category_id']){ echo(" selected");}?>><?php echo($rowListCats['category']);?></option>
      <?php
	  }
	  ?>
      </select>      </td>
  </tr>
  
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Move">
      <input name="hAction" type="hidden" id="hAction" value="edit_move">
      <input type="hidden" name="hP_id" id="hP_id" value="<?php echo($_REQUEST['p_id']);?>">
      <input name="hCategory_id" type="hidden" id="hCategory_id" value="<?php echo($_REQUEST['category_id']);?>"></td>
  </tr>
  </form>
</table>
<?php }?>
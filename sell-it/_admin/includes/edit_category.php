<?php
if(isset($_REQUEST['action']) && $_REQUEST['action']=="edit_category"){
$category_id=$_REQUEST['cat_id'];
$qryCategory="SELECT * FROM ".TBL_CATEGORIES." WHERE category_id='".$category_id."' LIMIT 1";
$rsCategory=mysql_query($qryCategory);
$rowCategory=mysql_fetch_array($rsCategory);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bg2">
  <tr>
    <td class="bg1">Edit Category</td>
  </tr>
  
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmEditCat">
  <tr>
    <td> :<br>
      <input type="text" name="category" id="category" class="passfieds" value="<?php echo($rowCategory['category']);?>"></td>
  </tr>
  <!--tr>
    <td><span class="section_text">
    category keyword without space<br />
      <input name="cat_key" type="text" class="passfieds" id="cat_key" maxlength="255" value="<?php echo($rowCategory['cat_key']);?>" />
    </span></td></tr-->
  <tr>
    <td>Category Image<br />
      <input type="file" name="cat_image" id="cat_image"  class="passfieds"/><img src="../categories/<?php echo($rowCategory['cat_image']);?>" width="100" height="100" border="0"  /></td>
  </tr> 
  <tr>
    <td>Product Banner<br />
      <input type="file" name="cat_left_image" id="cat_left_image"  class="passfieds"/><img src="../categories/left/<?php echo($rowCategory['cat_left_image']);?>" width="100" height="100" border="0"  /></td>
  </tr><tr>
    <td class="section_text"><br />
      <textarea name="des" cols="15" id="des"><?php echo($rowCategory['des']);?></textarea></td>
  </tr>
  <tr>
    <td>Sort Order :<br>
      <input name="sort" type="text" id="sort" size="2" maxlength="2" class="textfield1" value="<?php echo($rowCategory['sort']); ?>"></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Save">
      <input name="hAction" type="hidden" id="hAction" value="edit_category">
      <input name="hCategory_id" type="hidden" id="hCategory_id" value="<?php echo($_REQUEST['cat_id']);?>"></td>
  </tr>
  </form>
</table>
<?php }?>
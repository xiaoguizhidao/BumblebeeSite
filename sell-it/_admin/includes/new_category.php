<?php
if(isset($_REQUEST['action']) && $_REQUEST['action']=="new_category"){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2"  >
  <tr>
    <td class="bg1">New Category</td>
  </tr>
  <?php if(isset($_GET['category_id'])) { ?>
  <form action="<?php echo $_SERVER['PHP_SELF']."?category_id=".$_REQUEST['category_id']; ?>" method="post" enctype="multipart/form-data" name="frmNewCat">
  <?php } else { ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmNewCat">
  <?php } ?>
  <tr>
    <td class="section_text"><br>
      <input type="text" name="category" id="category" class="passfieds"></td>
  </tr>
  <!--tr>
    <td><span class="section_text">
    Category keyword without space<br />
      <input name="cat_key" type="text" class="passfieds" id="cat_key" maxlength="255" />
    </span></td></tr>
  <tr-->
    <td class="section_text">Category Image<br />
      <input type="file" name="cat_image" id="cat_image" class="passfieds" /></td>
  </tr>
<tr>
    <td class="section_text">Product Banner<br />
      <input type="file" name="cat_left_image" id="cat_left_image" class="passfieds" /></td>
  </tr>
  
  <tr>
    <td class="section_text"><br />
      <textarea name="des" cols="15" rows="5" id="des"></textarea></td>
  </tr>
  <tr>
    <td class="section_text">Sort Order :<br>
      <input name="sort" type="text" id="sort" size="2" maxlength="2" class="passfieds"></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Save">
      <input name="hAction" type="hidden" id="hAction" value="add_category"></td>
  </tr>
  </form>
</table>
<?php }?>
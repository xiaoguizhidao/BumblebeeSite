<?php
if($_REQUEST['action']=="edit_color"){
$qryColor="SELECT * FROM ".TBL_COLORS." WHERE color_id='".$color_id."' LIMIT 1";
$rsColor=mysql_query($qryColor) or die(mysql_error());
$rowColor=mysql_fetch_array($rsColor);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bg2">
  <tr>
    <td class="bg1">Edit Color</td>
  </tr>
  <form action="<?php echo($_SERVER['PHP_SELF']."?color_id=".$_REQUEST['color_id']."&action=edit_color");?>" method="post" enctype="multipart/form-data" name="frmEditCat">
  <tr>
    <td>Color Name :<br>
      <input type="text" name="color" id="color" class="textfield1" value="<?php echo($rowColor['color']);?>"></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Save">
      <input name="hAction" type="hidden" id="hAction" value="edit_color">
      <input name="hColor_id" type="hidden" id="hColor_id" value="<?php echo($_REQUEST['color_id']);?>"></td>
  </tr>
  </form>
</table>
<?php }?>
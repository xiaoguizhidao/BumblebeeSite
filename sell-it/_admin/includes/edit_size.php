<?php
if($_REQUEST['action']=="edit_size"){
$qrySize="SELECT * FROM ".TBL_SIZE." WHERE size_id='".$size_id."' LIMIT 1";
$rsSize=mysql_query($qrySize) or die(mysql_error());
$rowSize=mysql_fetch_array($rsSize);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bg2">
  <tr>
    <td class="bg1">Edit Size</td>
  </tr>
  <form action="<?php echo($_SERVER['PHP_SELF']."?size_id=".$_REQUEST['size_id']."&action=edit_size");?>" method="post" enctype="multipart/form-data" name="frmEditCat">
  <tr>
    <td>Size :<br>
      <input type="text" name="size" id="size" class="textfield1" value="<?php echo($rowSize['size']);?>"></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Save">
      <input name="hAction" type="hidden" id="hAction" value="edit_size">
      <input name="hSize_id" type="hidden" id="hSize_id" value="<?php echo($_REQUEST['size_id']);?>"></td>
  </tr>
  </form>
</table>
<?php }?>
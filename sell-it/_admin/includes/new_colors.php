<?php
if($_REQUEST['action']=="new_color"){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bg2">
  <tr>
    <td class="bg1">New Color</td>
  </tr>
  <form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" name="frmNewColor">
  <tr>
    <td>Color :<br>
      <input type="text" name="color" id="color" class="textfield1"></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Save">
      <input name="hAction" type="hidden" id="hAction" value="add_color"></td>
  </tr>
  </form>
</table>
<?php }?>
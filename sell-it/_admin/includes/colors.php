<script language="javascript">
function confirmation()
{
var r=confirm("Are You Sure Want To Delete ?");
if (r==true)
  {
  window.location="colors.php?color_id=<?php echo($rowColors['color_id']."&action=delete_color");?>";
  }
  else
  return false;
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#EEEEEE">
  <tr class="bg1">
    <td width="75%">Colors</td>
    <td width="25%">&nbsp;</td>
  </tr>
  <?php
  if($_REQUEST['action']=="delete_color"){
  $color_id=$_GET['color_id'];
  $del="delete from ".TBL_COLORS." where color_id='$color_id' ";
  $delete=mysql_query($del);
  }
  
  
   ?>
<?php
$sqlColors="select * from ".TBL_COLORS;
$rsColors=mysql_query($sqlColors) or die(mysql_error());
$noColors=mysql_num_rows($rsColors);
while($rowColors=mysql_fetch_array($rsColors)){
?>
  <tr onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='#EEEEEE'">
    <td><?php echo($rowColors['color']);?></td>
    <td valign="middle"><a href="<?php echo($_SERVER['PHP_SELF']."?color_id=".$rowColors['color_id']."&action=edit_color");?>">Edit</a> | <a onclick="return confirmation()" href="colors.php?color_id=<?php echo($rowColors['color_id']."&action=delete_color");?>">Delete</a></td>
  </tr>
<?php }

?>
</table>

<script language="javascript">
function confirmation()
{
var r=confirm("Are You Sure Want To Delete ?");
if (r==true)
  {
  window.location="size.php?size_id=<?php echo($rowSize['size_id']."&action=delete_size");?>";
  }
  else
  return false;
}
</script>


<table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#EEEEEE">
  <tr class="bg1">
    <td width="75%">Size</td>
    <td width="25%">&nbsp;</td>
  </tr>
  <?php 
 if ($_REQUEST['action']=="delete_size"){ 
$size_id=$_GET['size_id'];
$dqur="delete from ".TBL_SIZE." where size_id='$size_id'";
$delete=mysql_query($dqur);
}
?>

<?php
$sqlSize="select * from ".TBL_SIZE;
$rsSize=mysql_query($sqlSize) or die(mysql_error());
$noSize=mysql_num_rows($rsSize);
while($rowSize=mysql_fetch_array($rsSize)){
?>
  <tr onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='#EEEEEE'">
    <td><?php echo($rowSize['size']);?></td>
    <td valign="middle"><a href="<?php echo($_SERVER['PHP_SELF']."?size_id=".$rowSize['size_id']."&action=edit_size");?>">Edit</a> | <a onclick="return confirmation()" href="size.php?size_id=<?php echo($rowSize['size_id']."&action=delete_size");?>">Delete</a></td>
  </tr>
<?php }

?>
</table>

<script language="javascript">
function confirmation()
{
var r=confirm("Are You Sure Want To Delete ?");
if (r==true)
  {
 window.location="categories.php?category_id2=<?php echo($rowCategories['category_id']."&action=delete_category&category_id=".$rowCategories['parent']); ?>";
  }
  else
  return false;
}
</script>

<?php 
  if (isset($_REQUEST['action']) && $_REQUEST['action']=="delete_category"){
  $category_id2=$_GET['category_id2'];
  $del="delete from ".TBL_CATEGORIES." where category_id='$category_id2'";
  $delete=mysql_query($del) or die(mysql_error());
}
  ?>
  <?php 
  if (isset($_REQUEST['action']) && $_REQUEST['action']=="delete_product"){
  $p_id2=$_REQUEST['p_id2'];
  
  $del="delete from ".TBL_PRODUCTS." where p_id='$p_id2' limit 1";
  $delete=mysql_query($del);
  }
  ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderbtm">
              <tr>
                <td height="27" colspan="2" bgcolor="#e4e4e4" class="main_table_border"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="Lblack">
                    <tr>
                      <td width="190" align="left" style="padding-left:10px;">Caterories / Products</td>
                      <td width="72" align="center"></td>
                      <td width="4" align="center" ></td>
                      <td width="138" align="center" style="padding-left:5px;"></td>
                      <td width="211" align="center" >Rank</td>
                      <td width="87" align="center">Edit</td>
                      <td width="87" align="center">Delete</td>
                    
                      <td width="120" align="center">Action</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                   <?php
$sqlCategories="select * from ".TBL_CATEGORIES;
if(isset($_REQUEST['category_id'])){
$parent=$_REQUEST['category_id'];
$sqlCategories .=" where parent='".$parent."' order by sort";
}else{
$sqlCategories .= " where parent=0 order by sort";
}
$rsCategories=mysql_query($sqlCategories) or die(mysql_error());
$noCategories=mysql_num_rows($rsCategories);
$r=0;
while($rowCategories=mysql_fetch_array($rsCategories)){
$r++;
if($r%2==0){
$bg1="#e4e4e4
";
$bg2="#f9f9ec";
$bg3="#e4e4e4";
}else {
$bg1="#FFDFCB";
$bg2="#e4e4e4
";
$bg3="#f2f2f2";
}
?> <tr>
                      <td width="4%" height="25" align="center" bgcolor="#e4e4e4" class="lft_border"><!--<img src="images/icons/folder-document-24x24.png" width='24' height='24' class='imgborder'>--><?php echo("<a href=".$_SERVER['PHP_SELF']."?category_id=".$rowCategories['category_id']."&p=".$rowCategories['parent']."><img src='images/icons/folder-document-24x24.png' width='24' height='24' class='imgborder'></a> ");?></td>
                      <td width="25%" bgcolor="<?php echo $bg3;?>" class="border2" style="padding-left:5px;"><strong><?php echo $rowCategories['category'];?></strong></td>
                     <td width="15%" align="center" bgcolor="<?php echo $bg3;?>" class="border3">&nbsp;</td>
                      <td width="21%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"><input name="textfield22" type="text" class="ranking" id="textfield22" value="<?php echo $rowCategories['sort'];?>" readonly="readonly"></td>
                     <td width="0%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"></td>
                     <td width="12%" align="center" bgcolor="<?php echo $bg3;?>" class="border2"><a href="<?php echo($_SERVER['PHP_SELF']."?cat_id=".$rowCategories['category_id']."&action=edit_category");?>">Edit</a></td>
                     <td width="10%" align="center" bgcolor="<?php echo $bg3;?>" class="border2"><?php //if($_REQUEST['category_id']){?> <a onclick="return confirmation()" href="categories.php?category_id=<?php echo $rowCategories['parent']?>&category_id2=<?php echo($rowCategories['category_id']."&action=delete_category"); ?>">Delete</a><?php // }?></td>
                     <td width="13%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"><img src="images/icons/icon_play.png" width="16" height="16"></td>
                    </tr><?php }
$sqlProducts="select * from ".TBL_PRODUCTS;
if(isset($_REQUEST['category_id'])){
	$category_id=$_REQUEST['category_id'];
$sqlProducts.=" where category_id='".$category_id."'order by sort";
}else{
$sqlProducts.=" where category_id=0 order by sort";
}

$rsProducts=mysql_query($sqlProducts) or die(mysql_error());
$noProducts=mysql_num_rows($rsProducts);
$r=0;
while($rowProducts=mysql_fetch_array($rsProducts)){
$r++;
if($r%2==0){
$bg1="#e4e4e4
";
$bg2="#f9f9ec";
$bg3="#e4e4e4";
}else {
$bg1="#FFDFCB";
$bg2="#e4e4e4
";
$bg3="#f2f2f2";
}
?><script language="javascript">
function con()
{
var p=confirm("Are You Sure Want To Delete ?");
if (p==true)
  {
  window.location="categories.php?p_id2=<?php echo($rowProducts['p_id']."&action=delete_product"); ?>";
  }
  else
  return false;
}
</script>

                    <tr>
                        <td width="4%" height="25" align="center" bgcolor="#e4e4e4" class="lft_border"><img src="images/news_letter.png" width="24" height="24" class="imgborder"></td>
                        <td width="25%" bgcolor="<?php echo $bg3;?>" class="border2" style="padding-left:5px;"><?php echo $rowProducts['name']." - ".$rowProducts['article_no'];?></td>
                        <td width="15%" align="center" bgcolor="<?php echo $bg3;?>" class="border3"> <a href="add_colors.php?p_id=<?php echo($rowProducts['p_id']);?>">Manage Multiple Images</a></td>
                        <td width="21%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"><input name="textfield22" type="text" class="ranking" id="textfield22" value="<?php echo $rowProducts['sort'];?>" readonly="readonly">&nbsp;</td>
                      <td width="0%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"><!--<a href="gallery.php?p_id=<?php echo($rowProducts['p_id']);?>">Manage Gallery</a> --></td>
                      <td width="12%" align="center" bgcolor="<?php echo $bg3;?>" class="border2"><a href="edit_product.php?p_id=<?php echo($rowProducts['p_id']."&hUrl=categories.php?category_id=".$category_id);?>">Edit</a></td>
                      <td width="10%" align="center" bgcolor="<?php echo $bg3;?>" class="border2"><a href="categories.php?category_id=<?php echo($_GET['category_id']);?>&p_id2=<?php echo($rowProducts['p_id']."&action=delete_product"); ?>">Delete</a></td>
                      <td width="13%" align="center" bgcolor="<?php echo $bg3;?>" class="border4"><a href="<?php echo($_SERVER['PHP_SELF']."?action=move&category_id=".$_GET['category_id']."&p_id=".$rowProducts['p_id']);?>">Move</a></td>
                  </tr>
<?php }
?>
                    <!--<tr>
                      <td height="25" align="center" bgcolor="#E4E4E4" class="lft_border">&nbsp;</td>
                      <td bgcolor="#E4E4E4" class="border2" style="padding-left:5px;">&nbsp;</td>
                      <td align="center" bgcolor="#E4E4E4" class="border3">&nbsp;</td>
                      <td align="center" bgcolor="#E4E4E4" class="border4">&nbsp;</td>
                      <td align="center" bgcolor="#E4E4E4" class="border4">&nbsp;</td>
                      <td align="center" bgcolor="#E4E4E4" ></td>
                      <td align="center" bgcolor="#E4E4E4" class="border2"></td>
                      <td align="center" bgcolor="#E4E4E4" class="border4">&nbsp;</td>
                    </tr>-->
                    <tr>
                      <td height="25" colspan="8" align="left" bgcolor="#e4e4e4" class="lft_border"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                          <tr>
                            <td width="25%" height="30"><?php //echo $b;?>Categories: <?php echo($noCategories);?><BR>
                              Products: <?php echo($noProducts);?></td>
                            <td width="25%"><!--<input name="button7" type="submit" class="buttons" id="button7" value="Go Back">--></td>
                            <?php /*?><td width="27%" align="right"><?php //if($_REQUEST['category_id'] && $_REQUEST['p']==0 ){
							//if((isset($_REQUEST['category_id'])) && ($b==0 || $_REQUEST['p']==42) ){
							?><form action="<?php echo($_SERVER['PHP_SELF']."?category_id=".$_REQUEST['category_id']."&action=new_category&p=".$_REQUEST['p']);?>" method="post"><input name="button5" type="submit" class="buttons" id="button5" value="Add New Category"; ></form><?php //}?></td><?php */?>
                            
                            
                            <td width="27%" align="right"><?php 
							if(isset($_REQUEST['category_id'])){
							?>
							<form action="<?php echo($_SERVER['PHP_SELF']."?category_id=".$_REQUEST['category_id']."&action=new_category");?>" method="post"><input name="button5" type="submit" class="buttons" id="button5" value="Add New Category"; ></form>
							<?php } else { ?>
                 <form action="<?php echo($_SERVER['PHP_SELF']."?action=new_category");?>" method="post"><input name="button5" type="submit" class="buttons" id="button5" value="Add New Category"; ></form>           
							<?php }?></td>
                            
                            
                            <td width="23%" align="center">
							<?php 
							if(isset($_REQUEST['category_id'])){
							?>
							<form action="add_product.php" method="post"><input type="submit" name="submit2" id="submit2" value="Add New Product" />
                            <?php } ?>
							<?php /*?><?php //if( isset($_REQUEST['category_id']) &&  $_REQUEST['p']!=42 && ($b==1 || $b==2 )){?><form action="add_product.php" method="post"><input type="submit" name="submit2" id="submit2" value="Add New Product" /><?php */?>
                            
                            
                            
        <input name="hUrl" type="hidden" value="<?php echo(selfURL()); ?>" />
        <input type="hidden" name="category_id" id="category_id" value="<?php echo($_REQUEST['category_id']);?>" /></form><?php // }?></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
            </table>
<?php 
$category_id1=$_GET['category_id'];
$bread="";
$b=0;
$rsParent=mysql_query("select * from categories where category_id='$category_id1'");
$rowParent=mysql_fetch_array($rsParent);
$id=$rowParent['category_id'];
	$bread='>>'.'<a href="categories.php?category_id='.$id.'" class=sec_main>'.$rowParent['category'].'</a>'.$bread;
	while($rowParent['parent']!=0){
	$b++;
		$category_id1=$rowParent['parent'];
		$rsParent=mysql_query("select * from categories where category_id='$category_id1'");
		$rowParent=mysql_fetch_array($rsParent);
		$id=$rowParent['category_id'];
		$bread='>>'.'<a href="categories.php?category_id='.$id.'" class=sec_main>'.$rowParent['category'].'</a>'.$bread;
	}
?>
 <strong><?php echo $bread;?></strong>
        
        <!-- <td width="10%" align="center"  class="border4"><img src="images/icons/icon_play.png" width="16" height="16"></td>-->
     
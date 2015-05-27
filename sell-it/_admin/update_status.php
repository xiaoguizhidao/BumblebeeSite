<?php 
include("includes/config.php");
$status=$_GET['status'];
$p_id=$_GET['p_id'];
$category_id=$_GET['category_id'];
if($status==1){
$st=0;
}elseif($status==0){
$st=1;
}
$update_qry="update products set status='$st' where p_id='$p_id'";
if(mysql_query($update_qry)or die(mysql_error())){?>
<script>
window.location="categories.php?category_id=<?php echo $category_id;?>"
</script><?php 
}
?>
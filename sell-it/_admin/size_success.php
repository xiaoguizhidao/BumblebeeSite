<?php
session_start();
require_once("includes/restrict.php");
require_once("includes/config.php");
include("includes/variables.php");
include("includes/functions.php");
$msg="";
?>
<?php
 
if(isset($_POST['submit'])){


	$sizename=$_POST['sizename'];
	$sort=$_POST['sort'];
	$qry="insert into sizes(sizename,sort) values('$sizename','$sort')";
	
	if(mysql_query($qry)or die(mysql_error())){
		$msg="Sizes has been added successfully";
		?>
		<script type="text/javascript">
        window.location="sizes.php";
        </script>
		<?php
		
	}else{
		$msg="There is some error in adding Sizes. Please try again.";
	}
}
?>
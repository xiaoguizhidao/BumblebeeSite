<?php 
include("../connection.php");

$id = $_REQUEST['id'];

$query = "SELECT * from `sell_product_name` where `id`= '$id' ";
$result = mysql_query($query);
$show = mysql_fetch_array($result);

$field_name = $show['product_name'];

$query1 = "SELECT * from `sell_product` where `product_name`= '$field_name' ";
$result1 = mysql_query($query1);

$query2 = "SELECT * from `sell_product_name` ";
$result2 = mysql_query($query2);


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
 function showonlyone(thechosenone) {
     $('.newboxes').each(function(index) {
          if ($(this).attr("id") == thechosenone) {
               $(this).show(200);
          }
          else {
               $(this).hide(200);
          }
     });
}
</script>

<style>

.list
{
width:1050px; height:100%; margin-top:20px;
}
.list div
{
width:auto; height:auto; padding:10px 15px; float:left;
}

.list div a img
{
 transition: opacity .5s;
-moz-transition: opacity .5s; /* Firefox 4 */
-webkit-transition: opacity .5s; /* Safari and Chrome */
-o-transition: opacity .5s; /* Opera */

}
.list:hover div a img
{
opacity:0.5; 
}

.list div a img:hover
{
transition: opacity .5s;
-moz-transition: opacity .5s; /* Firefox 4 */
-webkit-transition: opacity .5s; /* Safari and Chrome */
-o-transition: opacity .5s; /* Opera */

}
.list div a img:hover
{opacity:1;

}
</style>
</head>
<center>
<body style="width:100%; margin:0px; padding:0px; height:100%;">
 
<div style="width:1024px; height:100%;">
	<div style="width:1024px; height:100%; position:relative; right:350px;">
    	<div style="color:#a1be40; font-family:Helvetica; font-size:26px;">
        	What's your iPhone worth?<br />
<font size="2px" face="Helvetica" color="#666666" style="position:relative; top:10px;">Select your phone, iPad or Mac below to get started.</font></div>
      </div> 
    </div>

<div class="list" style="overflow:visible;">
<table width="100%">
<tr>
<td style="vertical-align:top; float:left;">
<?php $i = 1; while($row2= mysql_fetch_array($result2)){?> 
         <div style="  padding: 5px;  float:left; ">
            <a id="myHeader<?php echo $i; ?>" href="javascript:showonlyone('newboxes<?php echo $i; ?>');">
			
				<img src="../upload_img/Sell/product/<?php echo $row2['product_image'];?>" onclick="document.getElementById('p1').style.display='none'"  />
				
			</a>
         </div>
		 
<?php $i++; } ?>
		 

		 
         <div class="newboxes" id="newboxes1" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px; height:100%;">		

<iframe src="sell_iphone.php" frameborder="0" scrolling="no" allowtransparency="true" style="height:1200px; position:absolute; width:1024px;"></iframe>

</div> 

</div>
      
	  <div class="newboxes" id="newboxes2" style="display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-1.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
       <div class="newboxes" id="newboxes3" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-1.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
  <div class="newboxes" id="newboxes4" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-1.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
  <div class="newboxes" id="newboxes5" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-1.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
  <div class="newboxes" id="newboxes6" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-1.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
 </td>

  

 </tr>
 </table>
 </div>
<div style="width:100%;   z-index:1111; float:left;" id="p1">
	<img src="images/footer.png" />
</div>			 
</body>
</center>
</html>

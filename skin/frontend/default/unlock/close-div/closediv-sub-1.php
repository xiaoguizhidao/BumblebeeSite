<?php 
include("connection.php");

$query = "SELECT * FROM `sell_product`";
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
<body style="width:100%; margin:0px; padding:0px; height:100%; position:absolute;">

 <div style="width:200px; vertical-align:top; float:left;">
 
	<div style="width:200px; float:left;">
    	
<font size="2px" face="Helvetica" color="#666666" style="position:relative; top:10px;">Which model do I have?</font>
</div>
        

</div>
<div class="list" style=" float:left;">

<table width="100%" height="">
<tr>

<td style="vertical-align:top; float:left;">

 
         <div style="  padding: 5px;  float:left; ">
            <a id="myHeader1" href="javascript:showonlyone('newboxes1');" >
			
				<img src="images/iphone4s.png"  onclick="document.getElementById('p1').style.display='none'"   />
				
			</a>
         </div>
		 
		 
		  <div style="  padding: 5px;  float:left; ">
            <a id="myHeader2" href="javascript:showonlyone('newboxes2');" >
			
				<img src="images/iphone4.png" />
				
			</a>
         </div>
		 
		  <div style="  padding: 5px;  float:left; ">
            <a id="myHeader3" href="javascript:showonlyone('newboxes3');" >
			
				<img src="images/iphone3gs.png" />
				
			</a>
         </div>
		 
		  <div style="  padding: 5px;  float:left; ">
            <a id="myHeader4" href="javascript:showonlyone('newboxes4');" >
			
				<img src="images/iphone3g.png" />
				
			</a>
         </div>
		 
		  <div style="  padding: 5px;  float:left; ">
            <a id="myHeader5" href="javascript:showonlyone('newboxes5');" >
			
				<img src="images/iphone4classic.png" />
				
			</a>
         </div>
		 
		 
		 
		 
		 
         <div class="newboxes" id="newboxes1" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:1000px; z-index:1111;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-2.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:1000px; position:absolute; width:1024px;"></iframe>

</div> 

</div>
      
	  <div class="newboxes" id="newboxes2" style="display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-2.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
       <div class="newboxes" id="newboxes3" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-2.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
  <div class="newboxes" id="newboxes4" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-2.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
 
  <div class="newboxes" id="newboxes5" style="  display: none;padding: 5px; margin-top:0px; width: 1024px; height:100%;"> 
 <div style="width:1024px;">		

<iframe src="closediv-sub-2.html" frameborder="0" scrolling="no" allowtransparency="true" style="height:100%; position:absolute; width:1024px;"></iframe>

</div> 
 </div>
  
 
 </td>

  

 </tr>
 </table>
 </div>
	<div style="width:1024px;   z-index:1111; float:left;" id="p1">
	<img src="images/footer.png" />
</div>	
</body>
</center>
</html>

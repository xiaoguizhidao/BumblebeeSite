<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
//include_once("inc/security.php");
include_once("inc/phpToPDF.php");
include_once("inc/Barcode39.php");
$tradeid = $_GET['trade_id'];
$query="SELECT t.*, DATE_ADD(t.sate_time, INTERVAL 1 MONTH) as expiry, concat(u.first_name, ' ',u.last_name) as fullname, u.*, a.* FROM trades t inner join users u on u.user_id = t.user_id inner join address a on a.add_id = t.address_to_ship where trade_id = '".$tradeid."'";
$result = mysql_query($query);
$resultData = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
<style type="text/css">
p {margin:0; padding:0;}
</style>
</head>
<body>
<section style="width:900px; margin:0 auto;">
<?php
$bc = new Barcode39($resultData['sessid']); 
$bc->barcode_text_size = 3;
$bc->barcode_bar_thick = 3;
$bc->barcode_bar_thin = 1;
$bc->draw("pdf-boxes/".$tradeid.".gif");
?>

<img src="images/logo.jpg" style="float:left; width:200px;" />
<img src="pdf-boxes/<?php echo  $tradeid; ?>.gif" style="float:right;" />


<table width="90%" align="center" style="font:14px arial; margin:20px 0 10px; clear:both; width:500px;">
<div style="clear:both; display:block;"></div>
<h2>Packing Slip</h2>
<p>Place this slip inside the box with your device.</p>
                             <thead align="left"><th>Item</th><th>Offer</th></thead>
                             <?php
							 $psq = "select * from cart where sessid = '".$resultData['sessid']."'";
							 $reks = mysql_query($psq);
							 $mytotal =0;
							 while($prods = mysql_fetch_array($reks)) {
							 ?>
                             <tr height="20"><td><?php echo $prods['item_name'] ?></td><td><?php echo $prods['item_price']; ?></td></tr>
                             <?php
							 $mytotal += substr($prods['item_price'],1);
							 ?>
                             <?php } ?>
                             <tfoot><td colspan="2" style="border-top:2px solid #000;" align="right"><?php echo $mytotal; ?></td></tfoot>
                             </table>
<p>You have until <?php echo date("d/m/y",strtotime($resultData['expiry'])); ?> to ship your device.</p>
<img src="images/logo.jpg" style="width:200px; display:block; margin-top:850px;" />
<img src="images/chekclist.jpg" style="margin:20px 0;" />



<table style="transform:rotate(90deg); -webkit-transform:rotate(270deg); -ms-transform:rotate(270deg); -o-transform:rotate(270deg); -moz-transform:rotate(270deg); width:450px; height:500px; vertical-align:top; font:bold 12px arial; margin-left:50px;">
<tr height="182"><td valign="top" colspan="2"><img src="images/ups.jpg" /></td></tr>
<tr height="80"><td valign="top">
<p><?php echo $resultData['fullname']; ?></p>
<p><?php echo $resultData['address1']; ?><br /><?php if($resultData['address2']){?><?php echo $resultData['address2']; ?><br /><?php } ?><?php echo $resultData['city']. ", ".$resultData['state']. ", ".$resultData['zip_code']. " " .$resultData['country'] ; ?></p>
</td>
<td></td>
</tr>
<tr><td valign="top" colspan="2" style="padding:10px 20px;">BumbleBee Wireless &trade;<br />7213 GLOBAL DR<br />LOUISVILLEKY 40258-1981</td></tr>
</table>
</section>
</body>
</html>
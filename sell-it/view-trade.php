<?php
require_once("_admin/includes/config.php");
require_once("_admin/includes/class.php");
include_once("inc/security.php");
$msg = NULL;
$userObj = new users;
$userid = $userObj->getUserDetail($_SESSION['user_email'])->user_id;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<title>Welcome To Bumblebee</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.account-pages {padding:10px 15px; box-sizing:border-box; font:13px arial;}
.account-pages h2 {margin-bottom:10px;}
.account-pages p, .account-pages strong {margin-bottom:5px;}
.account-pages input[type="submit"] {clear:both; display:block; margin:10px 0; border-radius:7px; font:bold 14px calibri; line-height:22px; height:22px; padding:0 10px; background:-webkit-linear-gradient(top,#fffc62,#ffca00); background:-moz-linear-gradient(top,#fffc62,#ffca00); background:-ms-linear-gradient(top,#fffc62,#ffca00); background:-o-linear-gradient(top,#fffc62,#ffca00); border:1px solid #ffcc00;}
</style>
</head>

<body>
<?php include_once("inc/header.php"); ?>
        <section id="center_main_container">
        <section id="center_container">
        <?php include_once("inc/header2.php"); ?>
<span class="clear"></span>
<section id="center_mid_container">
	<section id="left_menu_container">
    		<section class="left_cat">
            	<ul>
                	<li><a href="trades.php">Your Trades</a></li>
                	<li><a href="account.php">Password &amp; Email</a></li>
                	<li><a href="addresses.php">Stored Addresses</a></li>
                    </ul></section></section>
                    <section id="right_side_container">
                    	<section class="products_heading">Your Transactions</section>
                        <section class="account-pages">
                        <h2>Your Trade Status</h2>
                        
                        <?php
						$qry="SELECT t.*, DATE_ADD(t.sate_time, INTERVAL 1 MONTH) as expiry, concat(u.first_name, ' ',last_name) as fullname, u.*, a.* FROM trades t inner join users u on u.user_id = t.user_id inner join address a on a.add_id = t.address_to_ship where trade_id = ".$_GET['id'];
						$result = mysql_query($qry);
						$resultData = mysql_fetch_array($result);
						?>
                        <?php if($resultData['trade_status']=='1') { ?>
                        <a href="pdf.php?trade_id=<?php echo $_GET['id']; ?>">Download Slip</a>
                        <?php } ?>
						<p><?php if($resultData['trade_status']=='0') {
							echo "Your request is pending";
						}elseif($resultData['trade_status']=='1') {
							echo "Your in process. check your emails for more details.";
						}elseif($resultData['trade_status']=='2') {
							echo "Your process is completed. Money is transfered to your paypal account";
							}
							 ?></p>
                          <h2>Items in this box</h2>
                             <table width="90%" align="center">
                             <thead align="left"><th>Name</th><th>Offer Expires</th><th>Offer</th></thead>
                             <?php
							 $psq = "select * from cart where sessid = '".$resultData['sessid']."'";
							 $reks = mysql_query($psq);
							 $mytotal =0;
							 while($prods = mysql_fetch_array($reks)) {
							 ?>
                             <tr height="20"><td><?php echo $prods['item_name'] ?></td><td><?php echo date('d-m-Y h:i A', strtotime($resultData['expiry'])) ?></td><td><?php echo $prods['item_price']; ?></td></tr>
                             <?php
							 $mytotal += substr($prods['item_price'],1);
							 ?>
                             <?php } ?>
                             </table>
                             <br><br>
                             <strong>Estimated Payment: </strong> $<?php echo $mytotal; ?>
                             <br><br>
                             <strong>Your Email ID: </strong> <?php echo $resultData['user_email']; ?><br>
                             <strong>Paypal ID: </strong> <?php echo $resultData['paypal_id']; ?><br><br>
                             <strong>Your Shipping Address: </strong>
                             <p>
                             <?php echo $resultData['address1']."<br>".$resultData['address2']."<br>".$resultData['city'].", ".$resultData['state'].", ".$resultData['country'].", ".$resultData['zip_code']; ?>
                             </p>
                        </section><!--Account Pages-->
                        
</section></section>
<?php include_once("inc/footer.php"); ?>
</section></section>

</body>
</html>
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
                    	<section class="products_heading">Your Trades</section>
                        <section class="account-pages">
                        <h2>Open</h2>
                        <?php
						$queryP = "select * from trades where (trade_status = '0' or trade_status = '1') and user_id = ".$userid;
						$resultP = mysql_query($queryP);
						if(mysql_num_rows($resultP)>0) {
						?>
                        <table width="90%">
                        <thead><th></th><th>Created</th><th>Status</th><th>View Detail</th></thead>
                        <?php while($rowsP = mysql_fetch_array($resultP)) { ?>
                        <tr align="center"><td width="45%" align="left">
						<?php $trdid = $rowsP['trade_id'];
						$qury = "select item_name from cart where sessid = '".$rowsP['sessid']."'";
						$resl = mysql_query($qury);
						?>
                        <ol>
                        <?php
						while($pros = mysql_fetch_array($resl)) {
							echo "<li>".$pros[0]."</li>";
						}
						?>
                        </ol>
                        </td><td><?php echo date('d-m-Y h:i A',strtotime($rowsP['sate_time'])); ?></td><td>
                        <?php if($rowsP['trade_status']==0) {
							echo "Pending";
						} else {
							echo "Awaiting Receipt";
						}?>
                        </td><td><a href="view-trade.php?id=<?php echo $rowsP['trade_id']; ?>">View Detail</a></td></tr>
                        <?php } ?>
                        </table>
                        <?php } else { ?>
                        <p>No History Found</p>
                        <?php } ?>
                        <h2 style="margin-top:20px;">Completed</h2>
                        <?php
						$queryC = "select * from trades where trade_status = '2' and user_id = ".$userid;
						$resultC = mysql_query($queryC);
						if(mysql_num_rows($resultC)>0) {
						?>
                        <table width="90%">
                        <thead><th></th><th>Created</th><th>Status</th><th>View Detail</th></thead>
                        <?php while($rowsC = mysql_fetch_array($resultC)) { ?>
                        <tr align="center"><td width="45%" align="left">
						<?php
						$quryC = "select item_name from cart where sessid = '".$rowsC['sessid']."'";
						$reslC = mysql_query($quryC);
						?>
                        <ol>
                        <?php
						while($prosC = mysql_fetch_array($reslC)) {
							echo "<li>".$prosC[0]."</li>";
						}
						?>
                        </ol>
                        </td><td><?php echo date('d-m-Y h:i A',strtotime($rowsC['sate_time'])); ?></td><td>
                        Paid / Completed
                        </td><td><a href="view-trade.php?id=<?php echo $rowsC['trade_id']; ?>">View Detail</a></td></tr>
                        <?php } ?>
                        </table>
                        <?php } else { ?>
                        <p>No History Found</p>
                        <?php } ?>
						
                        </section><!--Account Pages-->
                        
</section></section>
<?php include_once("inc/footer.php"); ?>
</section></section>

</body>
</html>
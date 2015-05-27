<div id="sellcart">
<?php
$bsktQry = "select * from cart where sessid = '".$_SESSION['order_id']."'";
$bsktRslt = mysql_query($bsktQry) or die(mysql_error());
$totalprodsincart = mysql_num_rows($bsktRslt); ?>
<span id="butnCart">You have <?php echo $totalprodsincart; ?> items in your box &#9660;</span>
<?php if($totalprodsincart>0): ?>
<ul>
<?php $total = 0; ?>
<?php while($cartProds = mysql_fetch_array($bsktRslt)){ ?>
<li>
<img src="<?php echo $cartProds['item_pic']; ?>" alt="<?php echo $cartProds['item_name']; ?>">
<strong><?php echo $cartProds['item_name']; ?></strong>
<p><strong>Value</strong> <?php echo $cartProds['item_price']; ?></p><a href="delete-item.php?id=<?php echo $cartProds['c_i_id']; ?>">Remove</a>
<span class="clear"></span>
</li>
<?php $total += substr($cartProds['item_price'],1); ?>
<?php } ?>
<li><p style="text-align:right;">Total Amount: <strong>$<?php echo $total; ?></strong></p></li>
<a style="text-align:right; line-height:20px; padding:0 5px;" href="http://bumblebeewireless.com/trade-in-gadgets/">Find Another Item</a>
</ul>
<?php endif; ?>
</div>
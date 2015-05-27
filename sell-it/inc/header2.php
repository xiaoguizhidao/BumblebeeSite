<?php
$topcartq = "select count(item_name) as totalItems, item_price from cart where sessid='".$_SESSION['order_id']."'";
$topcartr = mysql_query($topcartq);
$totalPrice = 0;
$toalitems = 0;
while($myprices = mysql_fetch_array($topcartr)) {
	$totalPrice = $totalPrice+substr($myprices['item_price'],1);
	$toalitems = $myprices['totalItems'];
}
?>
<section id="header"><section id="logo_containe">
        <section class="logo"><a href="http://bumblebeewireless.com/"><img src="images/logo.jpg" border="0"></a></section>
        <section id="fb_icons_containe"><section id="live_chat_container">
        <section class="live_chat">
        <a href="index.php"><img src="images/moving-box.jpg" alt="box"></a>
        <p><?php echo $toalitems." Item(s) of $".$totalPrice; ?></p>
        <!--<img src="images/online.jpg">-->
        </section></section>
            <section class="phone_no">Call us toll-free <span>1.800.220.4888</span></section><section id="topsocial">
            <a href="https://www.facebook.com/Bumblebeewireless" target="_blank"><img src="images/fb_icon.jpg" width="25" height="25" onmouseover="this.src='images/fb_icon_hover.jpg'" onmouseout="this.src='images/fb_icon.jpg'"></a>
            <a href="https://twitter.com/repairbuysell" target="_blank"><img src="images/twiter.jpg" width="25" height="25" onmouseover="this.src='images/twiter_hover.jpg'" onmouseout="this.src='images/twiter.jpg'"></a>
            <a href="https://www.youtube.com/channel/UCuR28wTTOvtRRDLg_FdO6rg" target="_blank"><img src="images/youtube.jpg" width="25" height="25" onmouseover="this.src='images/youtube_hover.jpg'" onmouseout="this.src='images/youtube.jpg'"></a></section>
            <section id="headerLInks">
            <a href="http://bumblebeewireless.com/how-it-works">How It Works</a>
            <!-- SMARTADDON BEGIN -->
<script type="text/javascript">
(function() {
var s=document.createElement('script');s.type='text/javascript';s.async = true;
s.src='http://s1.smartaddon.com/share_addon.js';
var j =document.getElementsByTagName('script')[0];j.parentNode.insertBefore(s,j);
})();
</script>

<a href="http://www.smartaddon.com/?share" title="Share Button" onclick="return sa_tellafriend('http://bumblebeewireless.com','email')"><img alt="Share" src="http://bumblebeewireless.com/s13.png" border="0" style="vertical-align:bottom;" /></a>
<!-- SMARTADDON END -->
            <a href="http://bumblebeewireless.com/blog">Blog</a>
            <a href="http://bumblebeewireless.com/help-centers">Help</a>
            </section>
            </section>
            <ul class="selltopnav">
<li><a href="http://bumblebeewireless.com/trade-in-iphone.html">iPhone</a></li>
<li><a href="http://bumblebeewireless.com/trade-in-cellphone.html">Cell Phone</a></li>
<li><a href="http://bumblebeewireless.com/trade-in-ipad-3.html">iPad</a></li>
<li><a href="http://bumblebeewireless.com/trade-in-tablet.html">Tablets</a></li>
<li><a href="http://bumblebeewireless.com/trade-in-ipad.html">iPod</a></li>
<li><a href="http://bumblebeewireless.com/apple-computers.html">Apple Computers</a></li>
<li><a href="http://bumblebeewireless.com/others-apple-products.html">Other Apple Products</a></li>
</ul>
</section>
</section>
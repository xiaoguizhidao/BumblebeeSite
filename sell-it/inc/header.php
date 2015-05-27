<section id="main_container">
	<section id="contaner"><span>Bumblebee Wireless&trade; Leaders in Buying, Selling, Repairing and Customizing Wireless Technologies. | <a href="http://bumblebeewireless.com/faq/index/categoryshow/cat_id/3/" style="text-decoration:underline;">Click – Ship – Get – Paid™</a></span>
    <section class="top_link">
    <?php
	if(isset($_SESSION['login_status']) && $_SESSION['login_status']==1) {
	?>
    	<ul>
        <li><a href="account.php">My Account</a></li>
        <li><a href="trades.php">Track Orders</a></li>
        <li><a href="logout.php">Log Out</a></li>
        </ul>
        <?php } elseif(!isset($_SESSION['login_status']) || $_SESSION['login_status']!=1) { ?>
        <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Sign Up</a></li>
        </ul>
        <?php } ?>
        </section>
        <div class="clear"></div>
        </section></section>
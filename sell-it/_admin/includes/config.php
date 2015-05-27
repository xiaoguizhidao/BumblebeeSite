<?php
/**
 * Config.php
 *
 */
define("DB_SERVER", "localhost");
define("DB_USER", "sell_user");
define("DB_PASS", "Bumbl3B33");
define("DB_NAME", "sell_it");
$HtmlTitle="Bumblebee Wireless &trade;";
$adminEmail = "umair.arshad@xperts.pk";
//$adminEmail = "info@eurspec.com";
/**
 * connection to database
*/
mysql_pconnect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME);
?>
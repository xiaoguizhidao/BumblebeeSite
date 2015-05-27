<?php
include_once("inc/phpToPDF.php");
$url = "http://bumblebeewireless.com/sell-it/invoice.php?trade_id=".$_GET['invoice'];
phptopdf_url($url,"pdf-boxes/",$_GET['invoice'].".pdf");
$filetoopen = "pdf-boxes/".$_GET['invoice'].".pdf";
header("Content-disposition: attachment; filename=$filetoopen");
header('Content-Type: application/octet-stream');
readfile($filetoopen);
?>

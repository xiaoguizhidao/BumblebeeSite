<?php 
require("../PHPMailer/class.phpmailer.php");
if(isset($_POST['submit1'])) {
$to=$_POST['del'];
//echo $to;
$strto=$to;
//echo $strto;
$mew=$_POST['mess'];
$subj=$_POST['subj'];
//echo $mew; 
//$from = 'sales@abreast.com.pk';
			//$headers = "From: " . $from . "\r\n";
			//$headers .= "MIME-Version: 1.0\r\n";
			//$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//$subject='Online NEWSLETTER FROM Abreast Sports Website';
$message="<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
<td width='429' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
<td colspan='2'><img src='http://www.scanosafety.com/images/logo.png'/></td></tr>
<tr><td height='50' valign='top'><font size='2' face='Tahoma' color='#000000'><strong>Address : </strong><br>Sialkot PAKISTAN.</font></td>
<td height='50'><font size='2' face='Tahoma' color='#000000'></font></td>
</tr></table></td>
<td align='right' valign='top'><table width='50%' border='0' cellspacing='0' cellpadding='0'><tr>
<td width='31%' valign='top'><Strong><font size='2' face='Tahoma' color='#000000'>Contacts :</font></Strong></td><td width='69%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr><td height='18'><Strong><font size='2' face='Tahoma' color='#000000'>Telephone:</font></strong></td><td height='18'><font size='2' face='Tahoma' color='#000000'> + 92 52 0000000 </font></td></tr>
<tr><td height='18'><Strong><font size='2' face='Tahoma' color='#000000'>Fax:</font></strong></td><td height='18'><font size='2' face='Tahoma' color='#000000'> + 92 52 000000 </font></td></tr>
</table></td></tr>
<tr><td><font size='2' face='Tahoma' color='#000000'><Strong>E-Mail :</Strong></font></td><td><a href='mailto:info@scanosafety.com'><font size='2' face='Tahoma' color='#000000'>info@scanosafety.com</font></a></td></tr>
<tr><td><font size='2' face='Tahoma' color='#000000'><Strong>Website :</Strong></font></td><td><a href='http://www.scanosafety.com'><font size='2' face='Tahoma' color='#000000'>http://www.scanosafety.com</font></a></td></tr>
</table></td></tr></table></td></tr>
<tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td height='26' align='center'><font size='3' face='Verdana' color='E80201'><strong>Online Newsletter From scanosafety Sports</strong></font></td></tr>
<tr><td align='center' height='10'></td></tr>
<tr><td align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td height='20' colspan='2' bgcolor='#000000'><font size='2' face='Tahoma' color='#FFFFFF'><Strong>&nbsp;Newsletter Information</Strong></font></td></tr>
<tr><td colspan='2' height='10'></td></tr>


	
<tr><td width='20%' height='20'><font size='2' face='Tahoma'>Subject</font></td><td width='80%' height='20'><font size='2' face='Tahoma'>".$subj."</font></td></tr>
<tr><td height='20' valign='top'><font size='2' face='Tahoma'>Newsletter Content</font></td><td height='20'><font size='2' face='Tahoma'>".$mew."</font></td></tr>
</table></td></tr>


<tr><td height='10'>&nbsp;</td></tr>
</table></td></tr>
<tr><td height='20' align='center'><font size='2' face='Tahoma'>&copy; Copyright 1998 - 2010 <font size='2' face='Verdana' color='#E80201'> Scano Safety </font> All Rights Reserved.</font> </td></tr></table>";


$mail = new PHPMailer();

$mail->IsSMTP(); // send via SMTP
$mail->Host = "localhost"; // SMTP servers
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "info@scanosafety.com"; // SMTP username

$mail->Password = "user"; // SMTP password

$mail->From = 'info@scanosafety.com';
$mail->FromName = 'Scano Safety';
while(strpos($strto,',')>0){
	$mailad=substr($strto,0,strpos($strto,','));
	$strto=substr($strto,strpos($strto,',')+1);
	$mail->AddAddress($mailad,"Online Newsletter From scanosafety");
}
/*$mail->AddAddress("support@dissertationmaster.com","Online NEWSLETTER FROM Abreast Sports Website");
//$mail->AddAddress("support@dissertationmaster.com","Online NEWSLETTER FROM Abreast Sports Website");
*/
$mail->AddReplyTo("info@scanosafety.com","Online Newsletter From Scano Safety");

$mail->WordWrap = 50; // set word wrap

$mail->IsHTML(true); // send as HTML

$mail->Subject = "Online Newsletter From Scano Safety";
$mail->Body = $message;
$mail->AltBody = "This is the text-only body";

if(!$mail->Send())
{
echo "Message was not sent";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}


if(@mail($to, $subject, $mew, $headers) ){
$msg ="Your mail was sent successfully";
}else{
$msg = "We encountered an error sending your mail";
}
}
?>
 <script language="javascript">
window.location="newsletter.php";
</script>

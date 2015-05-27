<?php
if(!isset($_SESSION)) {
session_start();
}
function formatPrice($price,$cur) {
	$qr = "select * from currency where cur_id = ".$cur;
	$rd = mysql_query($qr);
	$cd = mysql_fetch_array($rd);
	$amt = $price * $cd['cur_rate'];
	return $cd['cur_sign'].$amt;
}

class cms {

	function cmsData($pageid) {
		$q = mysql_query("select * from pages where id='".$pageid."'");
		$pagedata = mysql_fetch_object($q);
		return $pagedata;
	}
	
}

class users {

	function getUserDetail($email) {
		$query = "select * from users where user_email = '".$email."'";
		$rest = mysql_query($query);
		if(mysql_num_rows($rest)>0){
			return mysql_fetch_object($rest);
		} else {
			return false;
		}
	}
	
	function validateLogin($user,$password) {
		$q = "select * from users where user_email = '".$user."' and password = '".$password."'";
		$qry = mysql_query($q);
		if(mysql_num_rows($qry)>0) {
			return true;
		} else {
			return false;
		}
	}
	
	function getAddress($user) {
		$user_id = self::getUserDetail($user)->user_id;
		$query = "select * from address where user_id = ".$user_id;
		$result= mysql_query($query);
		if(mysql_num_rows($result)>0) {
			while($addressData = mysql_fetch_object($result)) {
				$myAddresses[] = $addressData;
			}
			return $myAddresses;
		} else {
			return false;
		}
	}
	
	function resetPassword($email,$pass) {
		$password = md5($pass);
		$query = "update users set password = '".$password."' where user_email = '".$email."'";
		if(mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}
	
	function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
	}
	
	
	function randomOrder() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
	}
	
}
?>
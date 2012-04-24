<?php
// Userfunktionen
function login($name, $passwd){
	$_SESSION['user']['login'] = false;
	if(open_db()){
		$salt = @mysql_query("SELECT `salt` FROM $skrupel_user WHERE nick='$name'");
		if($zeiger = mysql_fetch_array($zeiger)){			
			$salt = $zeiger['salt'];
			$pass = cryptPasswd($passwd, $salt);
			$pass = explode(':',$pass, 2);
			$pass = $pass[0];
			$user = @mysql_query("SELECT `id`, `sprache` FROM `$skrupel_user` WHERE `nick`='$name' AND `passwort`='$pass'");
			if($user = mysql_fetch_array($user)){
				$_SESSION['user']['login'] = true;
				$_SESSION['user']['nick'] = $name;
				$_SESSION['user']['id'] = $user['id'];
				$_SESSION['user']['sprache'] = $user['sprache'];
			}
		}
	}
	return $_SESSION['user']['login'];
}
function is_loggedin(){
	return (!empty($_SESSION['user']['login'])?$_SESSION['user']['login']:false);
}
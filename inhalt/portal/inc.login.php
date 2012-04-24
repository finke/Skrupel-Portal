<?php
if(!is_loggedin()){
	$nick = (empty($_POST['nick'])?'':$_POST['nick']);
	$passwd = (empty($_POST['passwd'])?'':$_POST['passwd']);
	if(!login(nick, $passwd)){
		if(!empty($passwd) || !empty($nick)) echo '<span class="error_msg">'.$lang['portal']['login']['login_faild'].'</span>';
		?>
		<form method="POST" action="portal.php?login">
		<label for="login_nick"><?php echo $lang['portal']['login']['username'];?></label>
		<input class="login" type="text" name="nick" id="login_nick" value="<?php echo $nick;?>"/>
		<label for="login_nick"><?php echo $lang['portal']['login']['password'];?></label>
		<input class="login" type="password" name="passwd" id="login_passwd" value="" />
		</form>
		<?php	
	}
}
<?php

require_once 'inc.conf.php';
require_once 'inhalt/inc.hilfsfunktionen.php';

open_db();

$allowed_sites = array('start', 'regist', 'new_game');

if(!empty($_POST['seite']) && in_array($_POST['seite'], $allowed_sites)) $site = $_POST['seite'];
else $seite = 'start';
include ('lang/'.$language;.'/lang.portal.php');
include ('lang/'.$language;.'/lang.portal_'.$seite.'.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $language; ?>">
<head>
	<title>Skrupel - Tribute Compilation - Portal</title>
	<link rel="stylesheet" type="text/css" href="inhalt/css/portal.css" media="all" />
	<script type="text/Javascript" src="inhalt/js/portal.js"></script>
</head>
<body>
	<div>
		<head>
			<img src="Bilder/portal/logo.png" alt="Logo">
			<h1>Skrupel - Tribute Compilation - Portal</h1>
		</head>
		<aside>
			<nav>
			<a href="portal.php"><?php echo $lang['portal']['navi']['start']; ?></a>
			<a href="portal.php?regist"><?php echo $lang['portal']['navi']['regist']; ?></a>
			<a href="portal.php?new_game"><?php echo $lang['portal']['navi']['new_game']; ?></a>
			</nav>
		</aside>
		<div>
		<?php
			include 'inhalt/portal/inc.'.$seite .'.php';
		?>
		</div>
	</div>
</body>
</html>

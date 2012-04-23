<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Skrupel Portal</title>
    <META NAME="Author" CONTENT="Jens Hartjenstein webmaster@tiramon.de">
    <meta name="robots" content="index">
    <meta name="keywords" content="Skrupel,Portal,Online,kostenlos,Browsergame,Rundenbasiert,VGAPlanets">
    <meta name="description" content="Ein online Portal für das Browserspiel Skrupel.de, bei dem sich Spieler auch ohne Hilfe eines Admins anmelden können und Spiele erstellen können.">
    <meta http-equiv="content-language" content="de" >
    <link rel="stylesheet" type="text/css" href="styles/styles.php">
  </head>
  <body>
  <?php require "theme.php"; ?>
  <div id="skrupel_version"><?php
  $sql = "SELECT version FROM $skrupel_info";
  $version = mysql_fetch_assoc( mysql_query( $sql ) );
  echo "Skrupel v{$version["version"]}";  
?></div>
  <div id="portal_version"><a href="http://www.skrupelportal.de/">Portal v<?=PORTALVERSION?></a></div>
<div id="portal_nav">
  <table>
    <tr>
      <td valign="top">
        <table>
  <?php if ($_SESSION["user_id"] ) { ?>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Optionen" onClick="window.location.href = 'meta_optionen.php?fu=1'"><br>
            </td>
          </tr>
 <?php } ?>
          <tr>
            <td> 
  <?php if (!$_SESSION["user_id"]) { ?>
  <input type="button" style="width:120px;" value="Login" onClick="window.location.href = 'login.php'">
  <?php } else { ?>
  <input type="button" style="width:120px;" value="Logout" onClick="window.location.href = 'logout.php'">
  <?php } ?>
            </td>
          </tr>
  <?php if (!$_SESSION["user_id"]) { ?>
          <tr>
            <td>
  <input type="button" style="width:120px;" value="Registrieren" onClick="window.location.href = 'register.php'">
            </td>
          </tr>
  <?php } ?>
        </table>
      </td>
      <td valign="top">
        <table>
  <?php if ($_SESSION["user_id"]) { // && ( $_SESSION["user_id"] == ADMIN || in_array( CREATEGAME, $_SESSION["rights"] ) ) ) { ?>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Spiel erstellen" onClick="window.location.href = 'spiel_alpha.php'">
            </td>
          </tr>
  <?php } ?>
          <tr>
            <td>
  <input type="button" style="width:120px;" value="Aktive Spiele" onClick="window.location.href = 'active.php'">
            </td>
          </tr>
          <tr>
            <td>
  <input type="button" style="width:120px;" value="Wartende Spiele" onClick="window.location.href = 'waiting.php'">
            </td>
          </tr>
          <tr> 
            <td>
  <input type="button" style="width:120px;" value="Beendete Spiele" onClick="window.location.href = 'finished.php'">
            </td>
          </tr>
        </table>
      </td>
      <td valign="top">
        <table>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Stats" onClick="window.location.href = 'stats.php'"><br>
            </td>
          </tr>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Rassen" onClick="window.location.href = 'meta_rassen.php'"><br>
            </td>
          </tr>
        </table>
      </td>
<?php
/*
  if ( ADMIN == $_SESSION["user_id"] )
  { //administratives
?>
      <td valign="top">
        <table>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="User Rechte" onClick="window.location.href = 'user.php'"><br>
            </td>
          </tr>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Offenbarungen" onClick="window.location.href = 'allgemein_alpha.php?fu=1'"><br>
            </td>
          </tr>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Forum" onClick="window.location.href = 'kommunikation_board.php?fu=1&uid=<?=$_SESSION["uid"]?>&sid=<?=$_SESSION["sid"]?>'"><br>
            </td>
          </tr>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Chat" onClick="window.location.href = 'kommunikation_chat.php?fu=1&uid=<?=$_SESSION["uid"]?>&sid=<?=$_SESSION["sid"]?>'"><br>
            </td>
          </tr>
        </table>
      </td>
<?php
  }
*/
?>
      <td valign="top">
        <table>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Skrupel.de" onClick="window.open('http://www.skrupel.de','_blank')"><br>
            </td>
          </tr>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Anleitung" onClick="window.open('http://www.skrupel.de/www/index.php/Spielanleitung','_blank')"><br>
            </td>
          </tr>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Screenshots" onClick="window.open('http://www.skrupel.de/www/index.php/Screenshots','_blank')"><br>
            </td>
          </tr>
          <tr>
            <td> 
  <input type="button" style="width:120px;" value="Einf&uuml;hrungs Filme" onClick="window.open('http://www.skrupel.de/www/index.php/Filme','_blank')"><br>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</div>

<div id="details"></div>
<img src="http://skrupelportal.de/pic/check.png" alt="">
<div id="portal_center">

<?php
  session_start();
  $skrupel_path = "./";
?><html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles/styles.php">
  </head>
  <body style="background-color: black;">
  <div id="portal_center">
<?php
  require "inc/_frame_header.php";
  $supported_versions = array("0.969", "0.97", "0.971", "0.972", "0.973" );
  if (!$_GET["step"])
  {
    //Enter Configuration Data
?><br>
  <form action="install.php?step=1" method="post">
  <table align="center">
    <tr>
      <td>Pfad zu Skrupel</td>
      <td><input type="text" name="skrupel_path" value="../" style="width: 200px;"></td>
    </tr>
    <tr>
      <td>Name der Tabelle f&uuml;r Spiele in vorbereitung</td>
      <td><input type="text" name="skrupel_portal_games" value="skrupel_portal_games" style="width: 200px;"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" value="Weiter"></td>
    </tr>
  </table>
  </form>
<?php
  }
  elseif ($_GET["step"] == 1)
  {
    //Check entered Configuration Data
    $ok = true;
    echo "<br><center>";
    if ( $_POST["skrupel_path"] == "" || $_POST["skrupel_path"] == "./" || $_POST["skrupel_path"] == "." )
    {
      echo "<font color=\"red\">Skrupel und das Portal sollten sich nicht im selben Ordner befinden.</font<br>";
    }
    if ( is_file($_POST["skrupel_path"]."inc.conf.php") )
    {
      echo "<font color=\"green\">Skrupel Konfigurationsdatei gefunden</font><br>";
      $conf_found = true;
    }
    else
    {
      echo "<font color=\"red\">Skrupel Konfigurationsdatei nicht gefunden</font><br>";
      $ok = false;
    }
    if ( is_dir($_POST["skrupel_path"]."admin") )
      echo "<font color=\"green\">Skrupel Admin-Ordner gefunden</font><br>";
    else
    {
      echo "<font color=\"red\">Skrupel Admin-Ordner nicht gefunden</font><br>";
      $ok = false;
    }
    if ( is_dir($_POST["skrupel_path"]."bilder") && is_file($_POST["skrupel_path"]."bilder/logo_login.gif") )
      echo "<font color=\"green\">Skrupel Bilder-Ordner gefunden</font><br>";
    else
    {
      echo "<font color=\"red\">Skrupel Bilder-Ordner nicht gefunden</font><br>";
      $ok = false;
    }

    if ( $conf_found )
    { 
      require $_POST["skrupel_path"]."inc.conf.php";
      if ( mysql_connect("$server","$login","$password") )
      {
        echo "<font color=\"green\">Verbindung zum Datenbank Server erfolgreich getestet</font><br>";
        if ( mysql_select_db($database) )
        {
          echo "<font color=\"green\">Datenbank erfolgreich ausgew&auml;hlt</font><br>";
          $query = mysql_query("SELECT version FROM `$skrupel_info`");
          if ( $data = mysql_fetch_assoc($query) )
          {
            if ( in_array($data["version"],$supported_versions ) )
              echo "<font color=\"green\">Skrupel Version {$data["version"]} wird unterst&uuml;tzt</font><br>";
            else
            {
              echo "<font color=\"red\">Skrupel Version nicht unterst&uuml;tzt (installiert: {$data["version"]} unterst&uuml;tzt: ".implode(", ", $supported_versions).")</font><br>";
              $ok = false;
            }
          }
        }
        else
        {
          echo "<font color=\"red\">Konnte angegebene Datenbank nicht ausw&auml;hlen</font><br>";
          $ok = false;
        }
      }
      else
      {
        echo "<font color=\"red\">Konnte nicht auf angegebenen Datenbank Server verbinden</font><br>";
        $ok = false;
      }
    }
    $file = "inc/conf.php";
    touch( $file );
    if ( is_writable($file) )
    {
       echo "<font color=\"green\">Schreibrechte f&uuml;r $file existieren</font><br>";    
    }
    else
    {      
      if (! chmod($file, 0777) )
      {
        echo "<font color=\"red\">Schreibrechte f&uuml;r $file sind nicht vorhanden</font><br>";
        echo "<font color=\"red\">Keine Rechte f&uuml;r chmod</font><br>";
        $ok = false;
      }
      else
      {        
        echo "<font color=\"green\">Schreibrechte wurde erfolgreich ge&auml;ndert</font><br>";        
        echo "<font color=\"green\">Schreibrechte f&uuml;r $file existieren</font><br>"; 
      }
    }

?><br>
<?php 
  if ($ok)
  {
?>  <form action="install.php?step=install" method="post">
    <input type="hidden" name="skrupel_path" value="<?=$_POST["skrupel_path"]?>">
    <input type="hidden" name="skrupel_portal_games" value="<?=$_POST["skrupel_portal_games"]?>">
    <input type="submit" value="Installieren">
  </form>
<?php 
  }
  else
  {
?>  Bitte korrigieren sie ihre Konfiguration!<br>
  <a href="install.php">zur&uuml;ck</a>
<?php
  }
?>
  </center>
<?php
  }
  elseif ( $_GET["step"] == "install" )
  {
    //Loader Screen while Installation is running
?>
  <br>
  <center><img src="<?=$_POST["skrupel_path"]?>bilder/rad.gif" alt="Eingabe wird verarbeitet"><br>
  Installation l&auml;uft.<br>
  Bitte warten</center>
  <form id="formular" action="install.php?step=doinstall" method="post">
    <input type="hidden" name="skrupel_path" value="<?=$_POST["skrupel_path"]?>">
    <input type="hidden" name="skrupel_portal_games" value="<?=$_POST["skrupel_portal_games"]?>">    
  </form>
  <script language=JavaScript>
   window.setTimeout("document.getElementById('formular').submit()", 100 );
 </script>
<?php
  }
  elseif ( $_GET["step"] == "doinstall" )
  {
    //Creation of Conf file and Database Tables
    echo "<br><center>";
    /*
     * Konfigurationsdatei schreiben
     */
    $file = "inc/conf.php";
    $writeable = true;
    $successfull = true;
    if ( !is_writable($file) )
    {
      $writeable = false;
      echo "<font color=\"red\">Datei nicht schreibbar</font><br>";
      if (! chmod("inc/conf.php", 0777) )
      {
        echo "<font color=\"red\">Keine Rechte f&uuml;r chmod</font><br>";
        $writeable = false;
      }
      else
      {
        echo "<font color=\"green\">Schreibrechte wurde erfolgreich ge&auml;ndert</font><br>";
        $writeable = true;
      }
    }
    if ( !$writeable )
    {
      echo "Bitte geben Sie diesem Script Schreibrechte auf die Datei inc/conf.php und f&uuml;hren Sie es anschlie&szlig;end erneut aus.<br>";   
      $successfull = false;
    }
    else
    {
      $conffile = fopen( "inc/conf.php","w" );
      fwrite( $conffile, "<?php\n");
      fwrite( $conffile, "  \$skrupel_path         = \"{$_POST["skrupel_path"]}\";\n" );
      fwrite( $conffile, "  \$skrupel_portal_games = \"{$_POST["skrupel_portal_games"]}\";\n" );
      fwrite( $conffile, "\n" );
      fwrite( $conffile, "  define( \"ADMIN\", 1 );\n");
      fwrite( $conffile, "  define( \"PORTALVERSION\", \"0.5\" );\n");
      fwrite( $conffile, "  \$conf = array();\n" );
      fwrite( $conffile, "\n" );
      fwrite( $conffile, "  /*\n");
      fwrite( $conffile, "   * Change Theme\n");
      fwrite( $conffile, "   * possible values:\n");
      fwrite( $conffile, "   *  1 - Ingame design (default)\n");
      fwrite( $conffile, "   *  2 - Skrupel Admininterface design\n");
      fwrite( $conffile, "   *  3 - SkrupelPortal\n");
      fwrite( $conffile, "   */\n");
      fwrite( $conffile, "  \$conf[\"theme\"] = 3;\n");
      fwrite( $conffile, "  /*\n");
      fwrite( $conffile, "   * Use Sendmail params\n");
      fwrite( $conffile, "   * possible values:\n");
      fwrite( $conffile, "   *  false - no extra params are used for sendmail (default)\n");
      fwrite( $conffile, "   *  true  - \"-f FROMMAIL TOMAIL\" is used as extra param for sendmail\n");
      fwrite( $conffile, "   */\n");
      fwrite( $conffile, "  //\$conf[\"mail\"][\"extrasendmailparam\"] = true;\n" );
      fwrite( $conffile, "  /*\n");           
      fwrite( $conffile, "   * Number of seconds after creation/last action without activity that\n");
      fwrite( $conffile, "   * have to pass to let a game timeout\n");
      fwrite( $conffile, "   */\n");
      fwrite( $conffile, "  \$conf[\"games\"][\"inactivetimeout\"] = 60*60*24*7*3;");
      fwrite( $conffile, "?>" );
      fclose( $conffile );
      echo "<font color=\"green\">Konfigurationsdatei erfolgreich geschrieben.</font><br>";


      /*
       * Tabbelle einfuegen
       */
      require "inc/_db.php";
      $sql="CREATE TABLE `$skrupel_portal_games` (
                   `id` int(11) NOT NULL auto_increment,
                   `spiel_name` varchar(50) NOT NULL default '',
                   `siegbedingungen` tinyint(1) unsigned NOT NULL default '0',
                   `zielinfo_1` varchar(10) NOT NULL default '',
                   `zielinfo_2` varchar(10) NOT NULL default '',
                   `zielinfo_3` varchar(10) NOT NULL default '',
                   `zielinfo_4` varchar(10) NOT NULL default '',
                   `zielinfo_5` varchar(10) NOT NULL default '',
                   `out` tinyint(1) unsigned NOT NULL default '0',
                   `user_1` int(11) NOT NULL default '0',
                   `user_2` int(11) NOT NULL default '0',
                   `user_3` int(11) NOT NULL default '0',
                   `user_4` int(11) NOT NULL default '0',
                   `user_5` int(11) NOT NULL default '0',
                   `user_6` int(11) NOT NULL default '0',
                   `user_7` int(11) NOT NULL default '0',
                   `user_8` int(11) NOT NULL default '0',
                   `user_9` int(11) NOT NULL default '0',
                   `user_10` int(11) NOT NULL default '0',
                   `rasse_1` varchar(255) NOT NULL default '',
                   `rasse_2` varchar(255) NOT NULL default '',
                   `rasse_3` varchar(255) NOT NULL default '',
                   `rasse_4` varchar(255) NOT NULL default '',
                   `rasse_5` varchar(255) NOT NULL default '',
                   `rasse_6` varchar(255) NOT NULL default '',
                   `rasse_7` varchar(255) NOT NULL default '',
                   `rasse_8` varchar(255) NOT NULL default '',
                   `rasse_9` varchar(255) NOT NULL default '',
                   `rasse_10` varchar(255) NOT NULL default '',
                   `spieler_admin` int(11) NOT NULL default '0',
                   `startposition` tinyint(1) unsigned NOT NULL default '0',
                   `imperiumgroesse` tinyint(1) unsigned NOT NULL default '0',
                   `geldmittel` int(11) NOT NULL default '0',
                   `mineralienhome` tinyint(1) unsigned NOT NULL default '0',
                   `sternendichte` int(11) NOT NULL default '0',
                   `mineralien` tinyint(1) unsigned NOT NULL default '0',
                   `spezien` int(11) NOT NULL default '0',
                   `max` tinyint(3) unsigned NOT NULL default '0',
                   `wahr` tinyint(3) unsigned NOT NULL default '0',
                   `lang` tinyint(3) unsigned NOT NULL default '0',
                   `instabil` tinyint(3) unsigned NOT NULL default '0',
                   `stabil` tinyint(3) unsigned NOT NULL default '0',
                   `leminvorkommen` tinyint(1) unsigned NOT NULL default '0',
                   `umfang` int(11) NOT NULL default '0',
                   `struktur` varchar(255) NOT NULL default '',
                   `modul_0` tinyint(1) unsigned NOT NULL default '0',
                   `modul_2` tinyint(1) unsigned NOT NULL default '0',
                   `modul_3` tinyint(1) unsigned NOT NULL default '0',
                   `team1` int(11) NOT NULL default '0',
                   `team2` int(11) NOT NULL default '0',
                   `team3` int(11) NOT NULL default '0',
                   `team4` int(11) NOT NULL default '0',
                   `team5` int(11) NOT NULL default '0',
                   `team6` int(11) NOT NULL default '0',
                   `team7` int(11) NOT NULL default '0',
                   `team8` int(11) NOT NULL default '0',
                   `team9` int(11) NOT NULL default '0',
                   `team10` int(11) NOT NULL default '0',
                   `nebel` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_mitte` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_aussen` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_min` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_max` tinyint(3) unsigned NOT NULL default '0',
                   `playable` int(11) NOT NULL default '0',
                   `user_1_x` int(10) unsigned,
                   `user_1_y` int(10) unsigned,
                   `user_2_x` int(10) unsigned,
                   `user_2_y` int(10) unsigned,
                   `user_3_x` int(10) unsigned,
                   `user_3_y` int(10) unsigned,
                   `user_4_x` int(10) unsigned,
                   `user_4_y` int(10) unsigned,
                   `user_5_x` int(10) unsigned,
                   `user_5_y` int(10) unsigned,
                   `user_6_x` int(10) unsigned,
                   `user_6_y` int(10) unsigned,
                   `user_7_x` int(10) unsigned,
                   `user_7_y` int(10) unsigned,
                   `user_8_x` int(10) unsigned,
                   `user_8_y` int(10) unsigned,
                   `user_9_x` int(10) unsigned,
                   `user_9_y` int(10) unsigned,
                   `user_10_x` int(10) unsigned,
                   `user_10_y` int(10) unsigned,
                   PRIMARY KEY  (`id`)
                 ) TYPE=MyISAM AUTO_INCREMENT=1 ";
/*
            CREATE TABLE `skrupel_portal_rights` (
                   `user_id` int(10) unsigned NOT NULL default '0',
                   `rights` enum('createGame') NOT NULL default 'createGame',
                   PRIMARY KEY  (`user_id`)
                 ) TYPE=MyISAM ";
*/
      mysql_query($sql);
      if (!($error = mysql_error()))
        echo "<font color=\"green\">Datenbank Tabellen erfolgreich erstellt.</font><br>";
      else
      {
        echo "<font color=\"red\">Konnte Datenbank Tabellen nicht erstellen.<br>(".$error.")</font><br>";
        $successfull = false;
      }
    }
    if ( $_POST["skrupel_path"] != "" && $_POST["skrupel_path"] != "./" )
    {
      //echo system("rm -R bilder");
    }
    if ($successfull)
    {
      echo "<font color=\"green\" size=\"+1\"><b>Installation erfolgreich!</b></font><br>";
      echo "<b>Bitte l&ouml;schen sie nun die install.php aus ihrem portal Ordner,<br>damit niemand mehr im nachhinein ihre Konfiguration ver&auml;ndern kann<br>und dadurch evtl ihre Spiele sch&auml;digen kann.</b>";
    }
    else
      echo "<font color=\"red\" size=\"+1\"><b>Installation fehlgeschlagen!</b></font><br><a href=\"install.php\">Installation erneut starten</a>";
    echo "</center>";
  }
  require "inc/_frame_footer.php";
?>
</div>
</body>
</html>

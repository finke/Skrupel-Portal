<?php
  //update conffile 
  require "../inc/conf.php";
  if ( PORTALVERSION != "0.4a")
    die( "Falsche Portal Version Aktuelle Version: ".PORTALVERSION." ben&ouml;tigt: 0.4a" );
  chdir("..");
  $conffilepath = "inc/conf.php";
  $newfile = "";
  $conf = file($conffilepath);
  foreach ( $conf as $line )
  {
    if ( substr_count( $line, "PORTALVERSION" ) > 0 )
    {
      $line = str_replace( '"0.4a"', '"0.5"', $line );
    }
    $newfile .= $line;
  }
  
  $conffile = fopen( $conffilepath,"w" );
  fwrite( $conffile, $newfile );
  fclose( $conffile );

  //update skrupel_spiele
  require "inc/conf.php";
  require_once $skrupel_path."inc.conf.php";
  require_once "inc/_db.php";

  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_1_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_1_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_2_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_2_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_3_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_3_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_4_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_4_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_5_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_5_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_6_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_6_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_7_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_7_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_8_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_8_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_9_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_9_y INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_10_x INT UNSIGNED NOT NULL" );
  mysql_query( "ALTER TABLE $skrupel_portal_games ADD user_10_y INT UNSIGNED NOT NULL" );

  $sql = "UPDATE $skrupel_spiele SET kommentar = \"".time()."\" WHERE kommentar = \"\""; 
  mysql_query( $sql );
  
?>

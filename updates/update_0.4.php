<?php
  //update conffile 
  chdir("..");
  $conffilepath = "inc/conf.php";
  $newfile = "";
  $conf = file($conffilepath);
  foreach ( $conf as $line )
  {
    if ( substr_count( $line, "PORTALVERSION" ) > 0 )
    {
      $line = str_replace( '"0.4"', '"0.5"', $line );
    }
    $newfile .= $line;
  }
  
  $conffile = fopen( $conffilepath,"w" );
  fwrite( $conffile, $newfile );
  fclose( $conffile );

  //update skrupel_spiele
  require_once "inc/conf.php";
  require_once $skrupel_path."inc.conf.php";
  require_once "inc/_db.php";
  $sql = "UPDATE $skrupel_spiele SET kommentar = \"".time()."\" WHERE kommentar = \"\""; 
  mysql_query( $sql );
  
?>

<?php
  //update conffile 
  $conffilepath = "../inc/conf.php";
  $newfile = "";
  $conf = file($conffilepath);
  foreach ( $conf as $line )
  {
    if ( substr_count( $line, "PORTALVERSION" ) > 0 )
    {
      $line = str_replace( '"0.4"', '"0.4a"', $line );
    }
    $newfile .= $line;
  }
  
  $conffile = fopen( $conffilepath,"w" );
  fwrite( $conffile, $newfile );
  fclose( $conffile );

?>

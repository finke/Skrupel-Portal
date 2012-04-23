<?php
  require_once "inc/initial.php";

  //Database Connection Data loaded from Skrupel Configuration File
  if ( !@mysql_connect( "$server", "$login", "$password" ) )
  {
    header( "Location: error.php?id=no_connect&msg=" . mysql_error() );
  }
  if ( !@mysql_select_db( $database ) )
  {
    header( "Location: error.php?id=no_db&msg=" . mysql_error() );
  }
?>
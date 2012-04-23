<?php
  @include "../inc/conf.php";
  require_once "../inc/browser_check.php";
  if ($browser == "mozilla")
    $file = "mozilla";
  elseif ( $browser == "ie" )
    $file = "ie";
  elseif ( $browser == "konquerer" )
    $file = "ie";
  elseif ( $browser == "epiphany" )
    $file = "mozilla";
  elseif ( $browser == "opera" )
    $file = "ie";
  else
    $file = "ie";
  
  header("Content-type: text/css");
  require_once "skrupel.css";
  require_once $file . ".".($conf["theme"] ? $conf["theme"] : "1" ) . ".css";
?>

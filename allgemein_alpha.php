<?php
  require_once "inc/initial.php";
  if ( $_SESSION["user_id"] != ADMIN )
  {
    header( "Location: index.php" );
    die();
  }
  require_once "inc/_header.php";
  require_once "inc/_frame_header.php";
  require_once "inc/_db.php";
  // HTTP_COOKIE_VAR 0969
  // _COOKIE         0970
  $ftploginname = $HTTP_COOKIE_VARS["ftploginname"] = $_COOKIE["ftploginname"] = $admin_login;
  $ftploginpass = $HTTP_COOKIE_VARS["ftploginpass"] = $_COOKIE["ftploginpass"] = $admin_pass;

  require $skrupel_path."admin/allgemein_alpha.php";
  
  require "inc/_frame_footer.php";
  require "inc/_footer.php";
?>
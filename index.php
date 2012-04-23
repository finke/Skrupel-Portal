<?php
  session_start();
  if ( !is_file("inc/conf.php") )
  {
    header("Location: install.php");
    die("Bitte Konfiguration &uuml;berpr&uuml;fen");
  }
  require_once "inc/conf.php";
  if ( !INSTALLED )
  {
    header("Location: install.php");
    die("Bitte Konfiguration &uuml;berpr&uuml;fen");
  }

  if ( is_file("install.php") )
  {
    die("Bitte erst die install.php l&ouml;schen");
  }
  if ( !is_file($skrupel_path."inc.conf.php") ) 
  {
    header("Location: install.php");
    die("Bitte Konfiguration &uuml;berpr&uuml;fen");
  } 
  
  
  require_once $skrupel_path."inc.conf.php";
  require_once "inc/_db.php";
  
  if ($_POST["login"] && $_POST["pass"])
  {
    require_once "inc/_db.php";
//    $sql   = "SELECT user.*, rights, spiele.sid FROM $skrupel_user AS user LEFT JOIN $skrupel_portal_rights AS portal_rights ON user.id = portal_rights.user_id  LEFT JOIN $skrupel_spiele AS spiele ON phase = 0 AND (user.id = spieler_1 OR user.id = spieler_2 OR user.id = spieler_3 OR user.id = spieler_4 OR user.id = spieler_5 OR user.id = spieler_6 OR user.id = spieler_7 OR user.id = spieler_8 OR user.id = spieler_9 OR user.id = spieler_10) WHERE nick=\"{$_POST["login"]}\" AND passwort=\"{$_POST["pass"]}\" GROUP BY user.id"; 
    $sql   = "SELECT user.*, spiele.sid 
              FROM $skrupel_user AS user 
              LEFT JOIN $skrupel_spiele AS spiele 
              ON phase = 0 
                 AND (user.id = spieler_1 
                      OR user.id = spieler_2 
                      OR user.id = spieler_3 
                      OR user.id = spieler_4 
                      OR user.id = spieler_5 
                      OR user.id = spieler_6 
                      OR user.id = spieler_7 
                      OR user.id = spieler_8 
                      OR user.id = spieler_9 
                      OR user.id = spieler_10) 
              WHERE user.nick=\"{$_POST["login"]}\" 
                    AND user.passwort=\"{$_POST["pass"]}\" 
              GROUP BY user.id"; 
    $query = mysql_query($sql);
//    echo mysql_num_rows($query);
    if ( mysql_num_rows($query) == 1 )
    {
      $data = mysql_fetch_assoc($query);
      $_SESSION["user_id"] = $data["id"];
      $_SESSION["uid"]     = $data["uid"];
      $_SESSION["sid"]     = $data["sid"];
      $_SESSION["name"]    = $data["nick"]; 
      $_SESSION["pass"]    = $data["passwort"];
      $_SESSION["rights"]  = explode(",",$data["rights"]);
    }
  }
  if ($_SESSION["user_id"])
    header("Location: active.php");

  require_once "inc/_header.php";
  if (!$_SESSION["user_id"])
    require "login.php";
  require_once "inc/_footer.php"; 
 ?>

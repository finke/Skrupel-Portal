<?php
  session_start();
  require_once "inc/conf.php";
  require_once $skrupel_path."inc.conf.php";

  require "inc/_db.php";

  if ( $_SESSION["user_id"] )
  { //phase = 0 AND
    $sql   = "SELECT user.uid, spiele.sid FROM $skrupel_user AS user LEFT JOIN $skrupel_spiele AS spiele ON phase = 0 AND (user.id = spieler_1 OR user.id = spieler_2 OR user.id = spieler_3 OR user.id = spieler_4 OR user.id = spieler_5 OR user.id = spieler_6 OR user.id = spieler_7 OR user.id = spieler_8 OR user.id = spieler_9 OR user.id = spieler_10) WHERE user.id=\"{$_SESSION["user_id"]}\" GROUP BY user.id"; 
    $query = mysql_query($sql);
    //echo mysql_num_rows($query);
    if ( mysql_num_rows($query) == 1 )
    {
      
      $data = mysql_fetch_assoc($query);
      $_SESSION["uid"]     = $data["uid"];
      $_SESSION["sid"]     = $data["sid"];      
    }
  }
?>

<?php
  require_once "inc/initial.php";
  if ( !$_SESSION["user_id"] )
  {
    header("Location: index.php" );
  }

  if ( !$_SESSION["uid"] )
  {
    $sql = "SELECT uid FROM $skrupel_user WHERE id = {$_SESSION["user_id"]}";
    $data = mysql_fetch_assoc(mysql_query($sql));
    if ( $data["uid"] )
    {
      $_SESSION["uid"] = $data["uid"];
    }
    else
    {
      function rannum()
      {
        mt_srand((double)microtime()*1000000);
        $num = mt_rand(46,122);
        return $num;
      }
      function genchr()
      {
        do
        {
          $num = rannum();
        } while ( ( $num > 57 && $num < 65 ) || ( $num > 90 && $num < 97 ) );
        $char = chr($num);
        return $char;
      }
      function zufallstring()
      {
        $salt = "";
        for ( $i = 0; $i <20; $i++)
        {
          $salt.= genchr();
        }
        return $salt;
      }

      $_SESSION["uid"] = zufallstring();
      $sql = "UPDATE $skrupel_user set uid=\"{$_SESSION["uid"]}\"WHERE id={$_SESSION["user_id"]}";
      mysql_query($sql);
    }
  }  
  if ( $_SESSION["sid"] )
  {
    
  }
  if ( $_SESSION["uid"] == null || $_SESSION["sid"] == null )
  {
    header( "Location: index.php" );
    die();
  }
  $_GET["uid"]= $_SESSION["uid"];
  $_GET["sid"]= $_SESSION["sid"];
  require_once "inc/_header.php";
  require "inc/_frame_header.php";
  require_once "inc/_db.php";
  require $skrupel_path."inhalt/meta_optionen.php";
  require "inc/_frame_footer.php";
  require_once "inc/_footer.php";
?>

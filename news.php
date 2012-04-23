<?php
  require_once "inc/initial.php";
  require_once "inc/_header.php";
  require_once "inc/_frame_header.php";
  require_once "inc/_db.php";

  $sql   = "SELECT datum, beitrag FROM $skrupel_forum_beitrag WHERE verfasser = \"Gott\" ORDER BY id DESC LIMIT 5"; 
  $query = mysql_query( $sql );
  echo "<table align=\"center\">";
  while ( $news = mysql_fetch_assoc( $query ) )
  {
    echo "<tr><td align=\"right\"><span style=\"font-size:14px; font-weight:bold;\">".strftime( "%d.%m.%Y %T", $news["datum"]) ."</span></td></tr><tr><td>". $news["beitrag"] ."</td></tr>";
  }  
  echo "</table>";
?>
<?php
  require_once "inc/_frame_footer.php";
  require_once "inc/_footer.php";
?>


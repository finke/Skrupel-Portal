<?php
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
require_once "inc/_db.php";

$strings= array( "spiel_name", "zielinfo_1", "zielinfo_2", "zielinfo_3", "zielinfo_4", "zielinfo_5", "rasse_1", "rasse_2", "rasse_3", "rasse_4", "rasse_5", "rasse_6", "rasse_7", "rasse_8", "rasse_9", "rasse_10", "struktur" );
$nullen = array( "modul_0","modul_2","modul_3","team1","team2","team3","team4","team5","team6","team7","team8","team9","team10","user_1_x","user_1_y" );
foreach ($_POST as $key => $value)
{
//  echo $key ."  $value s".is_string($value) ." n". is_numeric($value) ."\n";
  if ( $key == "bla" || $key == "active" ) continue;

  if ( $keys != "" )
    $keys .= ", ";
  if ( $key == "out" )
    $keys .=  "`".htmlspecialchars($key)."`";
  else
    $keys .= htmlspecialchars($key);

  if ( in_array( $key, $nullen) && $value == "" )
    $value = 0;
  
  if ( $values != "" )
    $values .= ", ";
  if ( !in_array( $key, $strings ) )
    $values .= htmlspecialchars($value);
  else
    $values .= "\"".htmlspecialchars($value)."\"";
}

 $sql= "INSERT INTO $skrupel_portal_games (
						$keys 
                                         ) VALUES(
						$values
                                          )";
  //".( $_SESSION["user_id"] && ( $_SESSION["user_id"] == ADMIN || in_array( CREATEGAME, $_SESSION["rights"] ) ) ? 1 : 0 )." 
                                          mysql_query($sql);
  if ( !($error=mysql_error()) )
  {
?>
  <table width="99%" height="100%"><tr>
      <td align="center"><?php 
//      if ( $_SESSION["user_id"] && ( $_SESSION["user_id"] == ADMIN || in_array( CREATEGAME, $_SESSION["rights"] ) ) )
//      { 
       echo "Das Spiel wurde in die Liste wartender Spiele aufgenommen.";
//      }
//      else
//      {
//       echo "Das Spiel wurde vorgemerkt und wird freigeschaltet sobald ein Administrator es �berpr�ft hat.";
//      }
      ?>
      </td>
  </tr></table>
<?php
  }
  else
  {
?>  
  <table width="99%" height="100%"><tr>
      <td align="center">Das Spiel wurde nicht hinzugef&uuml;gt, weil wahrscheinlich schon ein Spiel mit dem selben Namen existiert.<br><!--(<?=$error." ".$sql?>)--></td>
  </tr></table>
<?php    
  }
}
?>

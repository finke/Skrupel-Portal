<?php
  require_once "inc/initial.php";
  require_once "inc/_header.php";
  require_once "inc/_frame_header.php";
  require_once "inc/_db.php";
?>
<table align="center">
  <tr>
    <td>Spieler</td>
    <td>Spiele teilgenommen</td>
    <td>Spiele gewonnen</td>
    <td>Schlachten</td>
    <td>Schlachten gewonnen</td>
    <td>Kolonien erobert</td>
    <td>Lichtjahre geflogen</td>
    <td>gespielte Monate (Runden)</td>
  </tr>
<?php
  require_once "inc/_db.php";
  $sql = "SELECT nick, 
                 stat_teilnahme, 
                 stat_sieg, 
                 stat_schlacht, 
                 stat_schlacht_sieg, 
                 stat_kol_erobert, 
                 stat_lichtjahre, 
                 stat_monate 
          FROM $skrupel_user 
          ORDER BY stat_monate DESC, stat_teilnahme DESC";
  $query = mysql_query( $sql );
  while ( $data = mysql_fetch_assoc( $query ) )
  {
?>
  <tr>
    <td><?=$data["nick"]?></td>
    <td align="right"><?=$data["stat_teilnahme"]?></td>
    <td align="right"><?=$data["stat_sieg"]?></td>
    <td align="right"><?=$data["stat_schlacht"]?></td>
    <td align="right"><?=$data["stat_schlacht_sieg"]?></td>
    <td align="right"><?=$data["stat_kol_erobert"]?></td>
    <td align="right"><?=$data["stat_lichtjahre"]?></td>
    <td align="right"><?=$data["stat_monate"]?></td>
  </tr>
<?php    
  }
?>
</table>
<?php
  require_once "inc/_frame_footer.php";  
  require_once "inc/_footer.php";  
?>
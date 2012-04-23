<?php
  require_once "inc/initial.php";
  require_once "inc/_header.php";
  require_once "inc/_frame_header.php";
  require_once "inc/_db.php";

  $user = array();
  $sql   = "SELECT * FROM $skrupel_user";
  $query = mysql_query( $sql );
  while ( $data = mysql_fetch_assoc($query) )
    $user[$data["id"]]=$data;
  
  if ( $_SESSION["user_id"] == ADMIN && $_GET["remind_user"] && $_GET["remind_game"] && is_numeric($_GET["remind_user"]) && is_numeric($_GET["remind_game"]) )
  {
    $sql   = "SELECT nick, email FROM $skrupel_user WHERE id = {$_GET["remind_user"]}";
    $query = mysql_query( $sql );
    $userd = mysql_fetch_assoc( $query );

    $sql   = "SELECT name, lasttick FROM $skrupel_spiele WHERE id = {$_GET["remind_game"]}";
    $query = mysql_query( $sql );
    $game  = mysql_fetch_assoc( $query );

    $msg     = "Hallo {$userd["nick"]},\n\ndu hattest dich für das Spiel \"{$game["name"]}\" eingetragen. Das Spiel wurde schon vor einiger Zeit gestartet, aber deine Mitspieler warten immernoch darauf das du deinen Zug abgibst.\n\nSolltest du weiterhin interesse haben geb bitte möglichst bald deinen Zug ab. Falls du nicht mehr mitspielen willst geb wenigstens kurz bescheid damit wir uns um einen Ersatz für dich kümmern können und das Spiel nicht weiter blockiert wird.";
    if ( $conf["mail"]["extrasendmailparam"] )
      @mail($userd["email"], "S K R U P E L -> Erinnerung", $msg,"From: $absenderemail\r\n"."Reply-To: tiramon@tiramon.de\r\n"."X-Mailer: PHP/" . phpversion(), "-f $absenderemail {$userd["email"]}");
    else
      @mail($userd["email"], "S K R U P E L -> Erinnerung", $msg,"From: $absenderemail\r\n"."Reply-To: tiramon@tiramon.de\r\n"."X-Mailer: PHP/" . phpversion());
  }

  $sql = "SELECT * FROM $skrupel_spiele WHERE phase = 0 ORDER BY lasttick DESC";
  $query = mysql_query($sql);
?>
<script>
<!--
  
  
  
  function fixdetails( i, xmlskrupelgame )
  {
    var temp;
    temp = goals_details[i];
    if ( i == 1 || i == 5 ) 
    {    
      temp = temp.replace("{1}",xmlskrupelgame.getElementsByTagName('goal_info')[0].firstChild.nodeValue);
    }
    
    return temp;
  }
var goals = new Array();
  goals[0] = 'Just for Fun';
  goals[1] = '&Uuml;berleben';
  goals[2] = 'Todfeind';
  goals[3] = 'Dominanz';
  goals[4] = 'King of the Planet';
  goals[5] = 'Spice';
  goals[6] = 'Team Todfeind';
  
  var goals_details = new Array();
  goals_details[0] ="Es wird gespielt, bis die Runde langweilig wird";
  goals_details[1] ="Spiel endet, sobald nur noch {1} Spieler existiert";
  goals_details[2] ="Jeder Spieler erhält einen Todfeind, den es zu vernichten gilt";
  goals_details[3] ="";
  goals_details[4] ="";
  goals_details[5] ="{1}KT Vormissan m&uuml;ssen im freien Raum an Board der eigenen Flotte gesichert werden";
  goals_details[6] ="Jedes Team aus 2 Spielern erhält 2 Todfeinde, welche es zu vernichten gilt";
-->
</script>
<script>
<!--
  function processReqChange()
  {    
    //only if req shows loadeidd
    if (req.readyState == 4)
    {
      //only if "OK"
      if (req.status == 200)
      {
        games = req.responseXML.getElementsByTagName("skrupelgame");        
        text  = "<?php echo str_replace("<?=\$skrupel_path?>",$skrupel_path,str_replace("\"","'",str_replace("\n","",implode("",file("inc/_frame_header.php"))))); ?>"+ 
        "<?php echo str_replace("{\$skrupel_path}",$skrupel_path,str_replace("\n","",implode("",file("inc/_details_active.html")))); ?>"+
        "<?php echo str_replace("\n","",implode("",file("inc/_frame_footer.php"))); ?>";
        document.getElementById("details").innerHTML = text
        document.getElementById("details").style.display = 'inline';
        document.getElementById("details").style.width = '900px';
        document.getElementById("details").style.height = '640px';
      }
      else
      {
        alert("There was a problem retrieving the XML data:\n" + req.StatusText);
      }
    }
  }
  function loadXMLDocument( url )
  { 
    if (window.XMLHttpRequest)
    {    
      //branch for native XMLHttpRequest
      req = new XMLHttpRequest();
      req.onreadystatechange = processReqChange;
      req.open("GET", url, true);
      req.send(null);
    }    
    else if (window.ActiveXObject)
    {
      //branch for IE/Windows ActiveX version
      isIE = true;
      req = new ActiveXObject("Microsoft.XMLHTTP");
      if (req)
      {
        req.onreadystatechange = processReqChange;
        req.open("GET", url, true);
        req.send();
      }
    }
  }  
  function showDetails( game_id )
  {  
    loadXMLDocument('xml.php?action=details_active&game_id='+ game_id);
  }
  function hideDetails()
  {
    document.getElementById("details").style.display = 'none';
  }
  function showHide( elementid )
  {    
    var estyle = document.getElementById( elementid ).style;
    var other = 'table-row';
    if ( estyle.display == other )
    {
      estyle.display = 'none';
    } 
    else
    {
      estyle.display = other;
    }
  }
  
  function filter()
  {
  }
-->
</script>
<table align="center" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="8" align="center"><h1>Aktive Spiele</h1></td>
  </tr>
<!--
  <tr>
    <td colspan="8" align="center"><input type="checkbox" id="filterbutton" onClick="filter()"> Filtern</td>
  </tr>
-->
<?php
  if ( mysql_num_rows($query) > 0 )
  {
?>
  <tr>
    <td align="center">Spielname</td>
    <td align="center">Spielziel</td>
    <td align="center">Runde</td>
    <td align="center">Kartengr&ouml;&szlig;e</td>
    <td align="center">Letzte Auswertung</td>
    <td align="center">N&auml;chster Autozug</td>
    <td align="center">Status</td>
    <td align="center">Details</td>
  </tr>
<?php
    while ( $data = mysql_fetch_assoc($query) )
    {

      if ($data["spieler_1"] == $_SESSION["user_id"] ||
              $data["spieler_2"] == $_SESSION["user_id"] ||
              $data["spieler_3"] == $_SESSION["user_id"] ||
              $data["spieler_4"] == $_SESSION["user_id"] ||
              $data["spieler_5"] == $_SESSION["user_id"] ||
              $data["spieler_6"] == $_SESSION["user_id"] ||
              $data["spieler_7"] == $_SESSION["user_id"] ||
              $data["spieler_8"] == $_SESSION["user_id"] ||
              $data["spieler_9"] == $_SESSION["user_id"] ||
              $data["spieler_10"] == $_SESSION["user_id"]
             ) 
       {
         echo "<tr name=\"owngame\">"; 
       }
       else
       {
         echo "<tr name=\"othergame\">";
       }
?>

    <td onClick="showHide('game_<?=$data["id"]?>')"><?=$data["name"]?></td>
    <td><?php
          if ($data["ziel_id"] == 0 )
            echo "JustforFun";
          elseif ($data["ziel_id"] == 1 )
            echo "&Uuml;berleben";
          elseif ($data["ziel_id"] == 2 )
            echo "Todfeind";
          elseif ($data["ziel_id"] == 3 )
            echo "Dominanz";
          elseif ($data["ziel_id"] == 4 )
            echo "King of the Planet";
          elseif ($data["ziel_id"] == 5 )
            echo "Spice";
          elseif ($data["ziel_id"] == 6 )
            echo "Teamtodfeind";
        ?></td>
    <td align="center"><?=$data["runde"]?></td>
    <td><?=$data["umfang"]."x".$data["umfang"]?></td>
    <td><?=($data["lasttick"] > 0 ? strftime("%d.%m.%Y %T",$data["lasttick"]) : "Bisher keine Auswertung" )?></td>
    <td align="center"><?=($data["autozug"] > 0 ? strftime("%d.%m.%Y %T",$data["lasttick"]+($data["autozug"]*60*60)) : "Kein Autozug" )?></td>
    <td align="center"><?=($data["phase"] == 0 ? "aktiv" : "beendet" )?></td>
    <td><a href="javascript:showDetails(<?=$data["id"]?>)">Anzeigen</a></td>    
    <?php if ($data["spieler_1"] == $_SESSION["user_id"] ||
              $data["spieler_2"] == $_SESSION["user_id"] ||
              $data["spieler_3"] == $_SESSION["user_id"] ||
              $data["spieler_4"] == $_SESSION["user_id"] ||
              $data["spieler_5"] == $_SESSION["user_id"] ||
              $data["spieler_6"] == $_SESSION["user_id"] ||
              $data["spieler_7"] == $_SESSION["user_id"] ||
              $data["spieler_8"] == $_SESSION["user_id"] ||
              $data["spieler_9"] == $_SESSION["user_id"] ||
              $data["spieler_10"] == $_SESSION["user_id"] 
             ) { ?>
    <td><form method="post" action="<?=$skrupel_path?>index.php" target="_blank"><input type="hidden" name="login_f" value="<?=$_SESSION["name"]?>"><input type="hidden" name="spiel_slot" value="<?=$data["id"]?>"><input type="hidden" name="passwort_f" value="<?=$_SESSION["pass"]?>"><input type="submit" value="Login"></form></td>
    <?php } ?>
  </tr>
  <tr id="game_<?=$data["id"]?>" style="display:none;">
   <td colspan="9">
     <table cellspacing="0" style=" position:relative;left:20px;">
       <tr>
         <td>Spieler</td>
         <td>Rasse</td>
         <td>Zug</td>
         <td>Platz</td>
       </tr>
     <?php
       for ( $i = 1; $i <= 10; $i++ )
       {
         if ($data["spieler_{$i}"] > 0 )
         {
     ?>  <tr>
         <td><?=$user[$data["spieler_{$i}"]]["nick"]?></td>
         <td><?=$data["spieler_{$i}_rassename"]?> (<?=$data["spieler_{$i}_rasse"]?>)</td>
         <td><?=($data["spieler_{$i}_zug"] == 1 ? "Zug abgegeben" : "" )?></td>
         <td align="center"><?=$data["spieler_{$i}_platz"]?></td>
       </tr>           
     <?php
         }
       }
     ?>
     </table>
   </td>
  </tr>
<?php    
    }
  }
  else
  {
?>
  <tr>
    <td colspan="8">Es gibt keine aktiven Spiele.</td>
  </tr>
<?php  
  }
?>  
</table>
<?php  
  
  require "inc/_frame_footer.php";
  require "inc/_footer.php";
?>

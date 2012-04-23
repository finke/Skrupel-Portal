<?php
  session_start();
require "inc/_db.php";
if ($_SESSION["user_id"]) 
{
  
  if ($_GET["action"] == "preparea" && is_numeric($_GET["game_id"]))
  {
    require "inc/_header.php";
    require "inc/_frame_header.php";

    $sql   = "SELECT spiel_name, siegbedingungen, zielinfo_1, zielinfo_2, zielinfo_3, zielinfo_4, zielinfo_5, out, user_1, user_2, user_3, user_4, user_5, user_6, user_7, user_8, user_9, user_10, rasse_1, rasse_2, rasse_3, rasse_4, rasse_5, rasse_6, rasse_7, rasse_8, rasse_9, rasse_10, spieler_admin, startposition, imperiumgroesse, geldmittel, mineralienhome, sternendichte, mineralien, spezien, max, wahr, lang, instabil, stabil, leminvorkommen, umfang, struktur, modul_0, modul_2, modul_3, team1, team2, team3, team4, team5, team6, team7, team8, team9, team10, nebel, piraten_mitte, piraten_aussen, piraten_min, piraten_max FROM $skrupel_portal_games WHERE id = {$_GET["game_id"]} AND spieler_admin = {$_SESSION["user_id"]}";
    $query = mysql_query($sql);
    if (mysql_num_rows($query) == 1)
    {
      $data = mysql_fetch_assoc( $query );
?>  
<script>
<!--
  function sendRequest( url, data )
  { 
    if (window.XMLHttpRequest)
    {    
      //branch for native XMLHttpRequest
      req = new XMLHttpRequest();
      req.onreadystatechange = processReqChange;
      if (req.overrideMimeType) {
        req.overrideMimeType('text/xml');
      }      
      req.open("POST", url, true);
      req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      req.send(data);
    }    
    else if (window.ActiveXObject)
    {
      //branch for IE/Windows ActiveX version
      isIE = true;
      req = new ActiveXObject("Microsoft.XMLHTTP");
      if (req)
      {
        req.onreadystatechange = processReqChange;
        req.open("POST", url, true);
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        req.send(data);
      }
    }
  }
  function processReqChange()
  {    
    //only if req shows loadeidd
    if (req.readyState == 4)
    {
    alert("loaded");
      //only if "OK"
      if (req.status == 200)
      {
        alert("status ok");
        data = req.responseText;
        alert(data);
        
      }
      else
      {
        alert("There was a problem retrieving the XML data:\n" + req.StatusText);
      }
    }
  }
-->
</script>
<br><br><br><br><br>
<center>
  <img src="<?=$skrupel_path?>bilder/radd.gif" height="46" width="51"><br><br>
  Einen Moment Geduld bitte.
  <br><br>
  Das Spiel wird erstellt.
</center>
<script>
  sendRequest("create_game.php","action=create&game_id=<?=$_GET["game_id"]?><?php 
                                                foreach ( $data as $field => $entry)
                                                {
                                                  echo "&{$field}={$entry}";
                                                }
                                              ?>");
</script>
<?php  
    }
    require "inc/_frame_footer.php";
    require "inc/_footer.php";
  }
  elseif ($_GET["action"] == "prepare" && is_numeric($_GET["game_id"]))
  { 
    require "inc/_header.php"; 
    require "inc/_frame_header.php";
    include ($skrupel_path."admin/inc.header.php");

    $sql   = "SELECT * FROM $skrupel_portal_games WHERE id = {$_GET["game_id"]}";
    $query = mysql_query($sql);
    if (mysql_num_rows($query) == 1)
    {
      $data = mysql_fetch_assoc( $query );
      if ( !in_array( $_SESSION["user_id"] , array( $data["user_1"],
                                                    $data["user_2"],
	      					    $data["user_3"],
	 					    $data["user_4"],
	 					    $data["user_5"],
						    $data["user_6"],
						    $data["user_7"],
						    $data["user_8"],
						    $data["user_9"],
						    $data["user_10"]) ) )
     {
       //TODO
       die("hast hier nix zu suchen... jaja hier fehlt noch ne ordentliche Fehlermeldung");
     }						    
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)">Neues Spiel erstellen</td></tr></table></center>
<center>
<img src="<?=$skrupel_path?>bilder/radd.gif" height="46" width="51"><br><br>
Einen Moment Geduld bitte.
<br><br>
Das Spiel wird erstellt.
</center>
<form name="formular" id="formular" method="post" action="create_game.php?action=create">
<?php
  foreach( $data as $key => $value )
  {
    if ( in_array( $key , array( "id", "playable" ) ) ) continue;
    echo "<input type=\"hidden\" name=\"{$key}\" value=\"{$value}\">";
  }
?>
<input type="hidden" name="game_id" value="<?=$_GET["game_id"]?>"> 
<!--
<input type="hidden" name="spiel_name" value="<?=$data["spiel_name"]?>">
<input type="hidden" name="siegbedingungen" value="<?=$data["siegbedingungen"]?>">
<input type="hidden" name="zielinfo_1" value="<?=$data["zielinfo_1"]?>">
<input type="hidden" name="zielinfo_2" value="<?=$data["zielinfo_2"]?>">
<input type="hidden" name="zielinfo_3" value="<?=$data["zielinfo_3"]?>">
<input type="hidden" name="zielinfo_4" value="<?=$data["zielinfo_4"]?>">
<input type="hidden" name="zielinfo_5" value="<?=$data["zielinfo_5"]?>">
<input type="hidden" name="user_1" value="<?=$data["user_1"]?>">
<input type="hidden" name="user_2" value="<?=$data["user_2"]?>">
<input type="hidden" name="user_3" value="<?=$data["user_3"]?>">
<input type="hidden" name="user_4" value="<?=$data["user_4"]?>">
<input type="hidden" name="user_5" value="<?=$data["user_5"]?>">
<input type="hidden" name="user_6" value="<?=$data["user_6"]?>">
<input type="hidden" name="user_7" value="<?=$data["user_7"]?>">
<input type="hidden" name="user_8" value="<?=$data["user_8"]?>">
<input type="hidden" name="user_9" value="<?=$data["user_9"]?>">
<input type="hidden" name="user_10" value="<?=$data["user_10"]?>">
<input type="hidden" name="rasse_1" value="<?=$data["rasse_1"]?>">
<input type="hidden" name="rasse_2" value="<?=$data["rasse_2"]?>">
<input type="hidden" name="rasse_3" value="<?=$data["rasse_3"]?>">
<input type="hidden" name="rasse_4" value="<?=$data["rasse_4"]?>">
<input type="hidden" name="rasse_5" value="<?=$data["rasse_5"]?>">
<input type="hidden" name="rasse_6" value="<?=$data["rasse_6"]?>">
<input type="hidden" name="rasse_7" value="<?=$data["rasse_7"]?>">
<input type="hidden" name="rasse_8" value="<?=$data["rasse_8"]?>">
<input type="hidden" name="rasse_9" value="<?=$data["rasse_9"]?>">
<input type="hidden" name="rasse_10" value="<?=$data["rasse_10"]?>">
<input type="hidden" name="spieler_admin" value="1"><!--<?=$data["spieler_admin"]?>-->
<input type="hidden" name="startposition" value="<?=$data["startposition"]?>">
<input type="hidden" name="imperiumgroesse" value="<?=$data["imperiumgroesse"]?>">
<input type="hidden" name="geldmittel" value="<?=$data["geldmittel"]?>">
<input type="hidden" name="mineralienhome" value="<?=$data["mineralienhome"]?>">
<input type="hidden" name="sternendichte" value="<?=$data["sternendichte"]?>">
<input type="hidden" name="mineralien" value="<?=$data["mineralien"]?>">
<input type="hidden" name="spezien" value="<?=$data["spezien"]?>">
<input type="hidden" name="max" value="<?=$data["max"]?>">
<input type="hidden" name="wahr" value="<?=$data["wahr"]?>">
<input type="hidden" name="lang" value="<?=$data["lang"]?>">
<input type="hidden" name="instabil" value="<?=$data["instabil"]?>">
<input type="hidden" name="stabil" value="<?=$data["stabil"]?>">
<input type="hidden" name="leminvorkommen" value="<?=$data["leminvorkommen"]?>">
<input type="hidden" name="umfang" value="<?=$data["umfang"]?>">
<input type="hidden" name="struktur" value="<?=$data["struktur"]?>">
<input type="hidden" name="modul_0" value="<?=$data["modul_0"]?>">
<input type="hidden" name="modul_2" value="<?=$data["modul_2"]?>">
<input type="hidden" name="modul_3" value="<?=$data["modul_3"]?>">
<input type="hidden" name="out" value="<?=$data["out"]?>">
<input type="hidden" name="nebel" value="<?=$data["nebel"]?>">

<input type="hidden" name="piraten_mitte" value="<?=$data["piraten_mitte"]?>">
<input type="hidden" name="piraten_aussen" value="<?=$data["piraten_aussen"]?>">
<input type="hidden" name="piraten_min" value="<?=$data["piraten_min"]?>">
<input type="hidden" name="piraten_max" value="<?=$data["piraten_max"]?>">

<input type="hidden" name="game_id" value="<?=$_GET["game_id"]?>">

<input type="hidden" name="user_1_x" value="<?=$data["user_1_x"]?>">
<input type="hidden" name="user_2_x" value="<?=$data["user_2_x"]?>">
<input type="hidden" name="user_3_x" value="<?=$data["user_3_x"]?>">
<input type="hidden" name="user_4_x" value="<?=$data["user_4_x"]?>">
<input type="hidden" name="user_5_x" value="<?=$data["user_5_x"]?>">
<input type="hidden" name="user_6_x" value="<?=$data["user_6_x"]?>">
<input type="hidden" name="user_7_x" value="<?=$data["user_7_x"]?>">
<input type="hidden" name="user_8_x" value="<?=$data["user_8_x"]?>">
<input type="hidden" name="user_9_x" value="<?=$data["user_9_x"]?>">
<input type="hidden" name="user_10_x" value="<?=$data["user_10_x"]?>">
<input type="hidden" name="user_1_y" value="<?=$data["user_1_y"]?>">
<input type="hidden" name="user_2_y" value="<?=$data["user_2_y"]?>">
<input type="hidden" name="user_3_y" value="<?=$data["user_3_y"]?>">
<input type="hidden" name="user_4_y" value="<?=$data["user_4_y"]?>">
<input type="hidden" name="user_5_y" value="<?=$data["user_5_y"]?>">
<input type="hidden" name="user_6_y" value="<?=$data["user_6_y"]?>">
<input type="hidden" name="user_7_y" value="<?=$data["user_7_y"]?>">
<input type="hidden" name="user_8_y" value="<?=$data["user_8_y"]?>">
<input type="hidden" name="user_9_y" value="<?=$data["user_9_y"]?>">
<input type="hidden" name="user_10_y" value="<?=$data["user_10_Y"]?>">

<? if ($data["siegbedingungen"]==6) {  ?>
<input type="hidden" name="team1" value="<?=$data["team1"]?>">
<input type="hidden" name="team2" value="<?=$data["team2"]?>">
<input type="hidden" name="team3" value="<?=$data["team3"]?>">
<input type="hidden" name="team4" value="<?=$data["team4"]?>">
<input type="hidden" name="team5" value="<?=$data["team5"]?>">
<input type="hidden" name="team6" value="<?=$data["team6"]?>">
<input type="hidden" name="team7" value="<?=$data["team7"]?>">
<input type="hidden" name="team8" value="<?=$data["team8"]?>">
<input type="hidden" name="team9" value="<?=$data["team9"]?>">
<input type="hidden" name="team10" value="<?=$data["team10"]?>">
<? } ?>
-->

</form>

<script language=JavaScript>
  document.getElementById('formular').submit();
 </script>
<?
      include ($skrupel_path."admin/inc.footer.php");
      require "inc/_frame_footer.php";
      require "inc/_footer.php";
    }
    else
    {
      echo "Konnte Spiel nicht finden";
    }
  } 
  elseif ( ($_GET["action"]=="create" || $_POST["action"]=="create") && is_numeric($_POST["game_id"]) ) 
  {
    $sql = "SELECT spiel_name, spieler_admin, user_1, user_2, user_3, user_4, user_5, user_6, user_7, user_8, user_9, user_10 FROM $skrupel_portal_games WHERE id = {$_POST["game_id"]}";
    $spiel = mysql_fetch_assoc(mysql_query($sql));
    echo mysql_error();
 //   if ($_SESSION["user_id"] == $spiel["spieler_admin"])
    if ( !in_array( $_SESSION["user_id"] , array( $data["user_1"],
                                                    $data["user_2"],
                                                    $data["user_3"],
                                                    $data["user_4"],
                                                    $data["user_5"],
                                                    $data["user_6"],
                                                    $data["user_7"],
                                                    $data["user_8"],
                                                    $data["user_9"],
                                                    $data["user_10"]) ) )

    {
      for ($i = 1; $i <=10;$i++)
      {
        if ($spiel["user_".$i] == -1)
        {
          $sql = "UPDATE $skrupel_portal_games SET user_$i = 0 WHERE id = {$_POST["game_id"]} AND user_$i = -1";
          mysql_query($sql);
        }
      }
      $mailsto = "";
      for ($i = 1; $i <=10;$i++)
      {
        if ($spiel["user_".$i] > 0)
        {
          $mailsto .=  ($mailsto != "" ? "," : "") . $spiel["user_{$i}"];
        }
      }
      define("MAILSTO", $mailsto);
      define("SPIELNAME", $spiel["spiel_name"]);
      $ftploginname = $HTTP_COOKIE_VARS["ftploginname"] = $_COOKIE["ftploginname"] = $admin_login;
      $ftploginpass = $HTTP_COOKIE_VARS["ftploginpass"] = $_COOKIE["ftploginpass"] = $admin_pass;
      $HTTP_GET_VARS["fu"] = 9; //0.969
      $_GET["fu"]          = 9; //0.97+
      $sql = "DELETE FROM $skrupel_portal_games WHERE id = {$_POST["game_id"]}";
      mysql_query($sql); 
      require "inc/_header.php";
      require "inc/_frame_header.php";            
      require $skrupel_path."admin/spiel_alpha.php";  

      // Send mails that the game has started
      @mysql_close();

      require "inc/_db.php";
      
      $sql = "UPDATE $skrupel_spiele SET kommentar = '".time()."' WHERE id={$spiel}";
      mysql_query($sql);

      $sql="SELECT email FROM $skrupel_user WHERE id in (".MAILSTO.")";
      $query= mysql_query( $sql );
      $header    = "From: $absenderemail\r\n"."Reply-To: $absenderemail\r\n"."X-Mailer: PHP/" . phpversion();
      $betreff   = "S K R U P E L -> Spiel gestartet";
      $nachricht="Das Spiel \"".SPIELNAME."\" für das Du Dich angemeldet hast wurde so eben gestartet.\n\nViel Spass und viel Erfolg bei dieser Runde von Skrupel - Tribute Compilation!\n\n------------------------------------------------------------\nDies ist eine automatisch generierte E-Mail\nBitte nicht antworten";
      while ( $data = mysql_fetch_assoc( $query ) )
      {  
        if ( $conf["mail"]["extrasendmailparam"] )
          @mail($data["email"], $betreff, $nachricht, $header, "-f {$absenderemail} {$data["email"]}");
	else
          @mail($data["email"], $betreff, $nachricht, $header);
      }
   
      require "inc/_frame_footer.php";
      require "inc/_footer.php";    
    }      
    else
    {
      if ($_POST["action"] == "create")
      {
        echo "ok";
      }
      else
      {
        require "inc/_header.php";
        require "inc/_frame_header.php";        
?><table width="99%" height="100%"><tr><td align="center">Du versuchst ein Spiel zu starten das nicht von dir erstellt wurde.</td></tr></table><?php         
        require "inc/_frame_footer.php";
        require "inc/_footer.php";
      }
    }
  }  
}
else
{
  require "inc/_header.php";
  require "inc/_frame_header.php";        
?><table width="99%" height="100%"><tr><td align="center">Sie m&uuml;ssen angemeldet und eingelogt sein um ein Spiel zu erstellen.</td></tr></table><?php     
  require "inc/_frame_footer.php";
  require "inc/_footer.php";
}
  
?>

<?php
if ($HTTP_GET_VARS["fu"]==3) {

require_once ($skrupel_path."inc.conf.php");
$lang = array();
include ("../lang/".$language."/lang.admin.spiel_alpha.php");
require ($skrupel_path."admin/inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {


$file=$skrupel_path.'daten/gala_strukturen.txt';
$fp = @fopen("$file","r");
if ($fp) {
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $strukturdaten=explode(':',$buffer);
    if ($strukturdaten[1]==$HTTP_POST_VARS["struktur"]) {
       $spieleranzahlmog=trim($strukturdaten[2]);
    }
}
@fclose($fp); }


?>
<script language="JavaScript" type="text/javascript">

  spielermog = new Array(0,1,<? if (strstr($spieleranzahlmog,'2')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'3')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'4')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'5')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'6')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'7')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'8')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'9')) { echo '1'; } else { echo '0'; } ?>,<? if (strstr($spieleranzahlmog,'10')) { echo '1'; } else { echo '0'; } ?>);

function check() {

  var spieleranzahl=0;

  if (document.formular.user_1.value != '0') { spieleranzahl++; }
  if (document.formular.user_2.value != '0') { spieleranzahl++; }
  if (document.formular.user_3.value != '0') { spieleranzahl++; }
  if (document.formular.user_4.value != '0') { spieleranzahl++; }
  if (document.formular.user_5.value != '0') { spieleranzahl++; }
  if (document.formular.user_6.value != '0') { spieleranzahl++; }
  if (document.formular.user_7.value != '0') { spieleranzahl++; }
  if (document.formular.user_8.value != '0') { spieleranzahl++; }
  if (document.formular.user_9.value != '0') { spieleranzahl++; }
  if (document.formular.user_10.value != '0') { spieleranzahl++; }

//  if ((document.formular.user_1.value == '0') <? for ($n=2;$n<=10;$n++) { ?> && (document.formular.user_<?=$n?>.value == '0')<? } ?>)  {
//      alert("Mindestens ein Spieler muﬂ ausgew‰hlt werden.");
//          return false;
//  }
<? if  ($HTTP_POST_VARS["startposition"]==1) { ?>
  if (spielermog[spieleranzahl]==0) {
    alert ('<?php echo str_replace('{1}',$spieleranzahlmog,$lang['admin']['spiel']['alpha']['nur_spieler'])?>');
    return false;
  }
<? } ?>

<? for ($oprt=1;$oprt<=10;$oprt++) { ?>
  if (document.formular.user_<?=$oprt?>.value >= '1') {
         var anzahle=0;
           <? for ($n=1;$n<=10;$n++) { ?>
             if (document.formular.user_<?=$n?>.value == document.formular.user_<?=$oprt?>.value) { anzahle++; }
           <? } ?>
         if (anzahle!=1) {
           alert("<?php echo $lang['admin']['spiel']['alpha']['max_slot']?>");
           return false;
         }
   }
<? } ?>
<? if ($HTTP_POST_VARS["siegbedingungen"]==6) {  ?>
<? for ($oprt=1;$oprt<=10;$oprt++) { ?>
  if (document.formular.user_<?=$oprt?>.value >= '1' || document.formular.user_<?=$oprt?>.value == '-1') {
    <? for ($op=0;$op<=4;$op++) { ?>
     if (document.formular.team<?=$oprt?>[<?=$op?>].checked == true) {
         var anzahl=0;
           <? for ($n=1;$n<=10;$n++) { ?>
             if (document.formular.team<?=$n?>[<?=$op?>].checked == true) { anzahl++; }
           <? } ?>
         if (anzahl!=2) {
           alert("<?php echo $lang['admin']['spiel']['alpha']['zwei_spieler']?>");
           return false;
         }
     }
    <? } ?>
  if ((document.formular.team<?=$oprt?>[0].checked == false) <? for ($n=1;$n<=4;$n++) { ?> && (document.formular.team<?=$oprt?>[<?=$n?>].checked == false)<? } ?>)  {
      alert("<?php echo $lang['admin']['spiel']['alpha']['team_spieler']?>");
      return false;
  }
  } else {
  if ((document.formular.team<?=$oprt?>[0].checked == true) <? for ($n=1;$n<=4;$n++) { ?> || (document.formular.team<?=$oprt?>[<?=$n?>].checked == true)<? } ?>)  {
      alert("<?php echo $lang['admin']['spiel']['alpha']['kein_team']?>");
      return false;
  }
  }
<? } ?>




<? } ?>
  return true;
}

</script>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=4" onSubmit="return check();">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">


<?

$verzeichnis=$skrupel_path."daten/";
$handle=opendir("$verzeichnis");

$zaehler=0;
while ($file=readdir($handle)) {
   if ((substr($file,0,1)<>'.') and (substr($file,0,7)<>'bilder_') and (substr($file,strlen($file)-4,4)<>'.txt')) 
   {
     if (trim($file)=='unknown' || trim($file)=='CVS') { } 
     else {
       $datei=$skrupel_path.'daten/'.$file.'/daten.txt';
       $fp = @fopen("$datei","r");
       if ($fp) {
         $zaehler2=0;
         while (!feof ($fp)) {
           $buffer = @fgets($fp, 4096);
           $daten[$zaehler][$zaehler2]=$buffer;
           $zaehler2++;
         }
         @fclose($fp); }

         $filename[$zaehler]=$file;

         $zaehler++;	
     }
   }
}
closedir($handle);

  $zeiger = @mysql_query("SELECT * FROM $skrupel_user order by nick");
  $useranzahl = @mysql_num_rows($zeiger);

   ?>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wer_volk']?></td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="1">
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td style="color:#aaaaaa;"><!--<?php echo $lang['admin']['spiel']['alpha']['admin']?>--></td>
<? if ($HTTP_POST_VARS["siegbedingungen"]==6) {  ?>
   <td>&nbsp;&nbsp;</td>
   <td><?php echo $lang['admin']['spiel']['alpha']['teams']?></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['i']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['ii']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iii']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iv']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['v']?></center></td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
<? } ?>
   </tr>
<? for ($k=1;$k<11;$k++) {?>
        <tr>
          <td style="color:<?=$spielerfarbe[$k]?>;"><select name="user_<?=$k?>">
            <?php if ($k > 1) { ?>
             <option value="0" style="background-color:<?=$spielerfarbe[$k]?>;"><?php echo $lang['admin']['spiel']['alpha']['leer_slot']?></option>
             <option value="-1" style="background-color:<?=$spielerfarbe[$k]?>;">Wartet auf Spieler</option>
<? /*for ($n=0;$n<$useranzahl;$n++) {
   $ok = @mysql_data_seek($zeiger,$n);
   $array = @mysql_fetch_array($zeiger);
   $uid=$array["id"];
   $nick=$array["nick"];
   ?>
     <option value="<?=$uid?>" style="background-color:<?=$spielerfarbe[$k]?>;"><?=$nick?></option>     
<? } */?>
  <?php } 
        else
        {
          echo "<option value=\"{$_SESSION["user_id"]}\">{$_SESSION["name"]}</option>"; 
          echo "<option value=\"-1\" style=\"background-color:{$spielerfarbe[$k]};\">Wartet auf Spieler</option>";
        }
        ?>
   </select></td>
          <td>&nbsp;</td>
          <td><select name="rasse_<?=$k?>">          
<?php if ($k == 1) {
   for ($n=0;$n<$zaehler;$n++) { ?>
     <option value="<?=$filename[$n]?>" style="background-color:<?=$spielerfarbe[$k]?>;"><?=$daten[$n][0]?></option>
<? }
  } else 
    echo "<option value=\"-1\" style=\"background-color:{$spielerfarbe[$k]};\">Durch Spieler w‰hlbar</option>";
  ?>          </select></td>
          <td>&nbsp;</td>
          <td><input type="hidden" name="spieler_admin" value="<?=$_SESSION["user_id"]?>"></td>
<? if ($HTTP_POST_VARS["siegbedingungen"]==6) {  ?>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?=$k?>" value="1"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?=$k?>" value="2"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?=$k?>" value="3"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?=$k?>" value="4"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?=$k?>" value="5"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?=$k?>" value="0" checked></center></td>
<? } ?>
        </tr>
<? } ?>
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td><!--<table border="0" cellspacing="0" cellpadding="0"><tr><td><input type="radio" name="spieler_admin" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['niemand']?></td></tr></table>--></td>
   </tr>



</table></center>
           <br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',5,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?
 } include ($skrupel_path."admin/inc.footer.php");
 }
 
?>

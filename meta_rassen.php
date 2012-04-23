<?
require_once "inc/initial.php";

function fixforutf( $string )
{
/*
  $string = str_replace("�","&auml;",$string);
  $string = str_replace("�","&ouml;",$string);
  $string = str_replace("�","&uuml;",$string);
  $string = str_replace("�","&Auml;",$string);
  $string = str_replace("�","&Ouml;",$string);
  $string = str_replace("�","&Uuml;",$string);
*/
  $string = str_replace(array( "�","�","�","�","�","�","�" ),
                        array( "&auml;", "&ouml;", "&uuml;", "&Auml;", "&Ouml;", "&Uuml;", "�szlig;" ),
                        $string);
//  $string = htmlentities($string);
  $string = utf8_encode($string);
  return $string;
}

$bildpfad = $skrupel_path."bilder";
//leicht abgewandelte Original Skrupel Datei aus inhalt/

include ("{$skrupel_path}inc.conf.php");
$file="{$skrupel_path}lang/".$language."/lang.meta_rassen.php";
include ($file);


if ($HTTP_GET_VARS["fu"]==1 || !$HTTP_GET_VARS["fu"]) {
require_once "inc/_header.php";
require_once "inc/_frame_header.php";

include ("{$skrupel_path}admin/inc.header.php");
?><script language=JavaScript>
function link(url) {

        

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
  function processReqChange()
  {    
    //only if req shows loadeidd
    if (req.readyState == 4)
    {
      //only if "OK"
      if (req.status == 200)
      {
        text  = "<?php 
                    $close_button = true; 
                    echo str_replace( "<?=\$skrupel_path?>", 
                                      $skrupel_path, 
                                      str_replace("\"",
                                                  "'",
                                                  str_replace("\n",
                                                              "", 
                                                              implode("", 
                                                                      file("inc/_frame_header.php")
                                                                     )
                                                             )
                                                 )
                                    ); 
                 ?>"+ 
        req.responseText + 
        "<br><center><input type='button' onClick='hideDetails()' value='Fenster schliessen'></center>" +
        "<?php 
           echo str_replace("\n",
                            "",
                            implode("",
                                    file("inc/_frame_footer.php")
                                   )
                           ); 
         ?>";
        document.getElementById("details").innerHTML = text;
        document.getElementById("details").style.display = 'inline';
        document.getElementById("details").style.width = '900px';
        document.getElementById("details").style.height = '540px';
      }
      else
      {
        alert("There was a problem retrieving the XML data:\n" + req.StatusText);
      }
    }
  }
  function hideDetails()
  {
    document.getElementById("details").style.display = 'none';
  }
</script>
<body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><!--<table border="0" cellspacing="0" cellpadding="0"><tr><td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="9"></td></tr><tr><td><table border="0" cellspacing="0" cellpadding="0"><tr>-->
<?
$verzeichnis="{$skrupel_path}daten/";

$handle=opendir("$verzeichnis");

while ($file=readdir($handle)) {
   if ((substr($file,0,1)<>'.') and (substr($file,0,7)<>'bilder_') and (substr($file,strlen($file)-4,4)<>'.txt')) {
    if($file == "unknown" || $file == "CVS") { continue; }
     $a = $verzeichnis . $file . "/daten.txt";
     $name = file( $a );
     ?><!--<td>-->&nbsp;<!--</td><td>--><a href="javascript:loadXMLDocument('meta_rassen.php?fu=2&rasse=<?=$file?>');" border="0"><img src="<?=$skrupel_path?>daten/<?=$file?>/bilder_allgemein/menu.png" border="0" width="186" height="75" alt="<?=$name[0]?>"></a><!--</td>--><?

   }
}
closedir($handle);



?>
<!--  </tr>
</table></td></tr></table>--></center>
<?
include ("{$skrupel_path}admin/inc.footer.php");

require_once "inc/_frame_footer.php";
require_once "inc/_footer.php";

 }
if ($HTTP_GET_VARS["fu"]==2) {
//include ("{$skrupel_path}admin/inc.header.php");
$rasse=$HTTP_GET_VARS["rasse"];
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?
$file=$skrupel_path.'daten/'.$rasse.'/schiffe.txt';
$fp = fopen("$file","r");
if ($fp) {
$zaehler=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $schiff[$zaehler]=$buffer;
    $zaehler++;
}
@fclose($fp); }

$file=$skrupel_path.'daten/'.$rasse.'/daten.txt';
$fp = @fopen("$file","r");
if ($fp) {
$zaehler2=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $daten[$zaehler2]=$buffer;
    $zaehler2++;
}
@fclose($fp); }

$copyright=$daten[1];
$attribute=explode(":",$daten[2]);
$attribute2=explode(":",$daten[4]);

$beschreibung="";
$file=$skrupel_path.'daten/'.$rasse.'/beschreibung_'.$language.'.txt';

if (!file_exists($file)) { $file=$skrupel_path.'daten/'.$rasse.'/beschreibung.txt'; }


$fp = @fopen("$file","r");
if ($fp) {
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $beschreibung=$beschreibung.$buffer;
}
@fclose($fp); }

$file=$skrupel_path.'daten/dom_spezien_art.txt';
$fp = @fopen("$file","r");
if ($fp) {
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $art_b=explode(":",$buffer);
    $art[$art_b[0]]=$art_b[1];
}
@fclose($fp); }

if ($attribute2[0]>=1) {
  $assrasse=$art[(int)$attribute2[1]];
	if ($attribute2[1]==0) {$assrasse="alle";}
} else {
  $assrasse="keine";
}
$assgrad=$attribute2[0];
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td colspan="3"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="10"></td>
  </tr>
<tr><td valign="top" width="100%">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td><center><img src="<?=$skrupel_path?>daten/<?=$rasse?>/bilder_allgemein/<?

		if (@file_exists("{$skrupel_path}daten/$rasse/bilder_allgemein/topic.png")) { echo "topic.png"; } else {
		if (@file_exists("{$skrupel_path}daten/$rasse/bilder_allgemein/topic.gif")) { echo "topic.gif"; }}

		 ?>" border="0" height="135"></center></td>
  </tr>
  <tr>
    <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="10"></td>
  </tr>
  <tr>
    <td style="font-size:12px;"><b><center><?=$daten[0] ?></center></b></td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="20"></td>
   </tr>
   <tr>
     <td width="100%" style="color:#aaaaaa;" valign="top"><?=fixforutf($beschreibung)?></td>
   </tr>
   <tr>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="30"></td>
   </tr>
<? if (strlen($copyright)>=5) { ?>
   <tr>
     <td><center><i><?=$copyright?></i></center></td>
   </tr>
   <tr>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="30"></td>
   </tr>
<? } ?>
</table>
</td><td align="right"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="20" height="20"></td><td align="right"><table border="0" cellspacing="0" cellpadding="0">
     <?
     $file=$skrupel_path.'daten/'.$rasse.'/bilder_basen/2.jpg';
     if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?=$file?>" border="0" width="150" height="100"></td></tr><? }
     $file=$skrupel_path.'daten/'.$rasse.'/bilder_basen/3.jpg';
     if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?=$file?>" border="0" width="150" height="100"></td></tr><? }
     $file=$skrupel_path.'daten/'.$rasse.'/bilder_basen/1.jpg';
     if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?=$file?>" border="0" width="150" height="100"></td></tr><? }
     $file=$skrupel_path.'daten/'.$rasse.'/bilder_basen/4.jpg';
     if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?=$file?>" border="0" width="150" height="100"></td></tr><? }
        ?></table></td></tr></table>

<? if ($attribute[6]>=1) {

   if ($attribute[6]==1) { $klassename="M"; }
   if ($attribute[6]==2) { $klassename="N"; }
   if ($attribute[6]==3) { $klassename="J"; }
   if ($attribute[6]==4) { $klassename="L"; }
   if ($attribute[6]==5) { $klassename="G"; }
   if ($attribute[6]==6) { $klassename="I"; }
   if ($attribute[6]==7) { $klassename="C"; }
   if ($attribute[6]==8) { $klassename="K"; }
   if ($attribute[6]==9) { $klassename="F"; }

?>
<center>
     <table border="0" cellspacing="0" cellpadding="3">
       <td style="color:#aaaaaa;"><?=$lang[metarassen][planetenklasse]?></td>
       <td><?=$klassename?></td>
       <td><img border="0" src="<?=$bildpfad?>/karte/planeten/<?=$attribute[6]?>.gif" width="10" height="10"></td>
     </table>
</center><br>
<? } ?>
<center>
     <table border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][temperatur]?></td>
          <td><? if ($attribute[0]>=1) { echo $attribute[0]-35; echo " Grad"; } else { echo "keine"; } ?></td>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][minenproduktion]?></td>
          <td><? echo $attribute[2]*100; ?> %</td>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][bodenkampfangriff]?></td>
          <td><? echo $attribute[3]*100; ?> %</td>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][assimilation]?></td>
          <td><? echo fixforutf($assrasse); ?></td>
        </tr>
        <tr>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][steuereinahmen]?></td>
          <td><? echo $attribute[1]*100; ?> %</td>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][fabrikproduktion]?></td>
          <td><? echo $attribute[5]*100; ?> %</td>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][bodenkampfverteidigung]?></td>
          <td><? echo $attribute[4]*100; ?> %</td>
          <td style="color:#aaaaaa;"><?=$lang[metarassen][aeffizienz]?></td>
          <td><? echo $assgrad; ?> %</td>
        </tr>
     </table>
</center>
<table border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td colspan="20"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="30"></td>
   </tr>
<?

for ($i=0;$i<$zaehler;$i++) {
   $schiffwert=explode(':',$schiff[$i]);
   $fertigkeiten=trim($schiffwert[17]);
   $spezial='';

  $cybern=@intval(substr($fertigkeiten,48,2));



  $subpartikel=@intval(substr($fertigkeiten,0,2));
  $terra_warm=@intval(substr($fertigkeiten,5,1));
  $terra_kalt=@intval(substr($fertigkeiten,6,1));
  $quark=@intval(substr($fertigkeiten,7,4));
  $sprungtriebwerk=@intval(substr($fertigkeiten,11,11));
  $tarnfeldgen=@intval(substr($fertigkeiten,22,1));
  $subraumver=@intval(substr($fertigkeiten,23,1));
  $scannerfert=@intval(substr($fertigkeiten,24,1));
  $sprungtorbau=@intval(substr($fertigkeiten,25,12));
  $fluchtmanoever=@intval(substr($fertigkeiten,38,2));
  $signaturmaske=@intval(substr($fertigkeiten,40,1));
  $viralmin=@intval(substr($fertigkeiten,41,2));
  $viralmax=@intval(substr($fertigkeiten,43,3));
  $erwtrans=@intval(substr($fertigkeiten,46,2));
  $cybern=@intval(substr($fertigkeiten,48,2));
  $destabil=@intval(substr($fertigkeiten,50,2));
  $overdrive_min=@intval(substr($fertigkeiten,53,1));
  $overdrive_max=@intval(substr($fertigkeiten,54,1));
  $luckyshot=@intval(substr($fertigkeiten,55,1));
  $orbitalschild=@intval(substr($fertigkeiten,56,1));
  $infanterie=@intval(substr($fertigkeiten,57,1));
  $hmatrix=@intval(substr($fertigkeiten,58,1));
  $fuehrung=@intval(substr($fertigkeiten,59,1));
  $fert_reperatur=@intval(substr($fertigkeiten,37,1));
  $strukturtaster=@intval(substr($fertigkeiten,52,1));



  $fert_quark_vorrat=@intval(substr($fertigkeiten,7,1))*113;
  $fert_quark_min1=@intval(substr($fertigkeiten,8,1))*113;
  $fert_quark_min2=@intval(substr($fertigkeiten,9,1))*113;
  $fert_quark_min3=@intval(substr($fertigkeiten,10,1))*113;

  $fert_sub_vorrat=@intval(substr($fertigkeiten,0,2));
  $fert_sub_min1=@intval(substr($fertigkeiten,2,1));
  $fert_sub_min2=@intval(substr($fertigkeiten,3,1));
  $fert_sub_min3=@intval(substr($fertigkeiten,4,1));

  $fert_sprungtorbau_min1=@intval(substr($fertigkeiten,25,3));
  $fert_sprungtorbau_min2=@intval(substr($fertigkeiten,28,3));
  $fert_sprungtorbau_min3=@intval(substr($fertigkeiten,31,3));
  $fert_sprungtorbau_lemin=@intval(substr($fertigkeiten,34,3));

  $fert_sprung_kosten=@intval(substr($fertigkeiten,11,3));
  $fert_sprung_min=@intval(substr($fertigkeiten,14,4));
  $fert_sprung_max=@intval(substr($fertigkeiten,18,4));




  if ($cybern>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $wert=$cybern*220;
    $textneu=str_replace(array('{1}'),array($wert),$lang[metarassen][cybernrittnikk]);
    $spezial.=$textneu;
  }
  if ($destabil>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}'),array($destabil),$lang[metarassen][destabilisator]);
    $spezial.=$textneu;
  }
  if ($erwtrans>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}'),array($erwtrans),$lang[metarassen][erweitertertransporter]);
    $spezial.=$textneu;
  }
  if ($hmatrix==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][hmatrix];
  }
  if ($infanterie==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][infanterie];
  }
  if ($fuehrung==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][fuehrung];
  }
  if ($fluchtmanoever>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    if ($fluchtmanoever==1) {
      $spezial.=$lang[metarassen][lloydsfluchtmanoever][0];
    } else {
      $textneu=str_replace(array('{1}'),array($fluchtmanoever),$lang[metarassen][lloydsfluchtmanoever][1]);
      $spezial.=$textneu;
    }
  }
  if ($luckyshot>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}'),array($luckyshot),$lang[metarassen][luckyshot]);
    $spezial.=$textneu;
  }
  if ($orbitalschild==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][orbitalschild];
  }
  if (($overdrive_min>=1) or ($overdrive_max>=1)) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $wert1=$overdrive_min*10;
    $wert2=$overdrive_max*10;
    $textneu=str_replace(array('{1}','{2}'),array($wert1,$wert2),$lang[metarassen][overdrive]);
    $spezial.=$textneu;
  }
  if ($quark>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_quark_vorrat,$fert_quark_min1,$fert_quark_min2,$fert_quark_min3),$lang[metarassen][quarkreorganisator]);
    $spezial.=$textneu;
  }
  if ($fert_reperatur>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}'),array($fert_reperatur),$lang[metarassen][reperaturunterstuetzung]);
    $spezial.=$textneu;
  }
  if ($scannerfert>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }

    if ($scannerfert==1) {
      $spezial.=$lang[metarassen][scanner][0];
    } else {
      $spezial.=$lang[metarassen][scanner][1];
    }
  }
  if ($signaturmaske==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][signaturmaskierung];
  }
  if ($sprungtorbau>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_sprungtorbau_min1,$fert_sprungtorbau_min2,$fert_sprungtorbau_min3,$fert_sprungtorbau_lemin),$lang[metarassen][sprungtorbau]);
    $spezial.=$textneu;
  }
  if ($sprungtriebwerk>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}','{2}','{3}'),array($fert_sprung_kosten,$fert_sprung_min,$fert_sprung_max),$lang[metarassen][sprungtriebwerk]);
    $spezial.=$textneu;
  }
  if ($strukturtaster==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][strukturtaster];
  }
  if ($subpartikel>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_sub_vorrat,$fert_sub_min1,$fert_sub_min2,$fert_sub_min3),$lang[metarassen][subpartikelcluster]);
    $spezial.=$textneu;
  }
  if ($subraumver>=1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}'),array($subraumver),$lang[metarassen][subraumverzerrer]);
    $spezial.=$textneu;
  }
   if ($tarnfeldgen==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][tarnfeldgenerator];
  }
   if ($terra_warm==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][terraformer][0];
  }
   if ($terra_kalt==1) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $spezial.=$lang[metarassen][terraformer][1];
  }
  if (($viralmin>=1) or ($viralmax>=1)) {
    if (strlen($spezial)>=1) { $spezial.='<br>'; }
    $textneu=str_replace(array('{1}','{2}'),array($viralmin,$viralmax),$lang[metarassen][viralerangriff]);
    $spezial.=$textneu;
  }



?>

   <tr>
     <td colspan="20"><table border="0" cellspacing="0" cellpadding="0"><tr><td style="font-size:11px;"><?=fixforutf($schiffwert[0])?></td><td style="color:#aaaaaa;" valign="bottom">&nbsp;(Techlevel <?=$schiffwert[2]?>)</td></tr></table></td>
   </tr>
   <tr>
     <td colspan="20"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="10"></td>
   </tr>
   <tr>
     <td bgcolor="#aaaaaa"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
     <td bgcolor="#aaaaaa"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="150" height="1"></td>
     <td bgcolor="#aaaaaa"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
     <td colspan="17"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
   </tr>
   <tr>
     <td bgcolor="#aaaaaa" rowspan="4"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
     <td rowspan="4" bgcolor="#000000"><img src="<?=$skrupel_path?>daten/<?=$rasse?>/bilder_schiffe/<?=$schiffwert[3]?>" width="150" height="100"></td>
     <td bgcolor="#aaaaaa" rowspan="4"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][crew]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><?=$schiffwert[15]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][antriebe]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><?=$schiffwert[14]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][cantox]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><?=$schiffwert[5]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td rowspan="4" valign="top" style="color:#aaaaaa;"><?=fixforutf($spezial)?></td>
   </tr>
   <tr>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/masse.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][masse]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><?=$schiffwert[16]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/laser.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][energetik]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><?=$schiffwert[9]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][baxterium]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><nobr><?=$schiffwert[6]?> KT</nobr></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
   </tr>
   <tr>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][tank]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><nobr><?=$schiffwert[13]?> KT</nobr></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/projektil.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][projektile]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><?=$schiffwert[10]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][rennurbin]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><nobr><?=$schiffwert[7]?> KT</nobr></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
   </tr>
   <tr>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][fracht]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><nobr><?=$schiffwert[12]?> KT</nobr></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/hangar.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;"><?=$lang[metarassen][hangar]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><?=$schiffwert[11]?></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
     <td><img src="<?=$bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td style="color:#aaaaaa;">Vomisaan</td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="5" height="1"></td>
     <td><nobr><?=$schiffwert[8]?> KT</nobr></td>
     <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="10" height="1"></td>
   </tr>
   <tr>
     <td bgcolor="#aaaaaa"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
     <td bgcolor="#aaaaaa"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="150" height="1"></td>
     <td bgcolor="#aaaaaa"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
     <td colspan="17"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1"></td>
   </tr>
   <tr>
     <td colspan="20"><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="20"></td>
   </tr>
<?
}
?>
</table>

<?
include ("{$skrupel_path}admin/inc.footer.php");
}

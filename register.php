<?php
  require_once "inc/initial.php";

  if ( $_SESSION["user_id"]) 
  {
    header("Location: index.php"); 
  }
  require_once "inc/_header.php";
  require_once "inc/_frame_header.php";
  //register script aus dem skrupel download
?>  
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Skrupel - Tribute Compilation Anmeldung</title>
<META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
<meta name="robots" content="index">
<meta name="keywords" content=" ">
<META HTTP-EQUIV="imagetoolbar" CONTENT="no">
</head>
<body text="#000000" bgcolor="#000000" scroll="no" background="<?=$skrupel_path?>bilder/hintergrund.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!--
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="0" background="<?=$skrupel_path?>bilder/login.gif">
                         <tr>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1" alt=""></td>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="628" height="1" alt=""></td>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1" alt=""></td>
                         </tr>
                         <tr>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="347" alt=""></td>
                                <td valign="top"><center>
                                <img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="30" alt=""><br>
-->
<center>
                                <img src="<?=$skrupel_path?>bilder/logo_login.gif" width="329" height="208" alt="">
        <br>

<? /////////////////////////////////////////////////////////////////////////////////////////// ?>

<?
//  include ("inc.conf.php"); //Falls dieses Script nicht im Hauptverzeichnis von Skrupel liegt bitte den Pfad entsprechend anpassen

  $conn = @mysql_connect("$server","$login","$password");
  $db = @mysql_select_db("$database",$conn);

  $fu=$HTTP_GET_VARS["fu"];

  if ((!$fu) or ($fu==0)) {
?>

       <table border="0" cellspacing="0" cellpadding="4">
         <tr>
          <td><form action="<? echo $_SERVER["PHP_SELF"]; ?>?fu=1" method="post" name="formular"></td>
          <td align="right">Benutzername&nbsp;</td>
          <td><input type="text" name="loginname" class="eingabe" maxlength="30" style="width:350px;" value=""></td>
          <td></td>
                                 </tr>
                                 <tr>
                                        <td></td>
          <td align="right">E-Mail&nbsp;</td>
          <td><input type="text" name="email" class="eingabe" maxlength="255" style="width:350px;" value=""></td>
                                        <td></td>
                                 </tr>
         <tr>
                                        <td></td>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="submit" value="Anmelden" style="width:350px;"></td>
          <td></form></td>
         </tr>
       </table>

<? } else {

  $fehlermeldung="";
  $email=$HTTP_POST_VARS["email"];
  $loginname=$HTTP_POST_VARS["loginname"];

  if (!strlen($loginname)>=1) { $fehlermeldung=$fehlermeldung."Fehler: Benutzername erforderlich\\n"; }
  if (((strlen($loginname)<4) || (strlen($loginname)>30)) and (strlen($loginname)>=1)) { $fehlermeldung=$fehlermeldung."Fehler: Benutzername darf nur zwischen 4 und 30 Zeichen haben\\n"; }
  if ((!preg_match("/^[a-zA-Z_0-9_\(\)\[\]\-\+\*]+$/",$loginname)) and (strlen($loginname)>=1)) { $fehlermeldung=$fehlermeldung."Fehler: Benutzername muss aus alphanummerischen Zeichen bestehen (0-9,a-z,A-Z)([]()-_+*)\\n"; }

  $zeiger = mysql_query("SELECT count(*) as total FROM $skrupel_user where nick='$loginname'");
  $array = @mysql_fetch_array($zeiger);
  $total=$array["total"];
  if ($total>=1) { $fehlermeldung=$fehlermeldung."Fehler: Benutzername bereits vorhanden\\n";}

  if (!strlen($email)>=1) { $fehlermeldung=$fehlermeldung."Fehler: E-Mail erforderlich\\n"; }

  if (strlen($fehlermeldung)>=1) {
  ?>
  <script language="Javascript">
    alert("<? echo $fehlermeldung; ?>");
    window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>';
  </script>
  <?
  } else {

  $conso=array("b","c","d","f","g","h","j","k","l","m","n","p","r","s","t","v","w","x","y","z");
  $vocal=array("a","e","i","o","u");
  $passwort="";
  @srand((double)microtime()*1000000);
  for($f=1; $f<=5; $f++) {
     $passwort.=$conso[rand(0,19)];
     $passwort.=$vocal[rand(0,4)];
  }

  $zeiger = @mysql_query("INSERT INTO $skrupel_user (nick,passwort,email,optionen) values ('$loginname','$passwort','$email','10111111111000')");
  $nachricht="Willkommen bei Skrupel - Tribute Compilation\n\nDeine Zugangsdaten lauten\n\nBenutzername: $loginname\nPasswort: $passwort\n\nViel Spass!\n\n------------------------------------------------------------\nDies ist eine automatisch generierte E-Mail\nBitte nicht antworten";
  if ($conf["mail"]["extrasendmailparam"])
  {
    @mail($email, 
          "S K R U P E L -> Zugangsdaten", 
    	  $nachricht,
	  "From: $absenderemail\r\n"."Reply-To: $absenderemail\r\n"."X-Mailer: PHP/" . phpversion(), 
	  "-f $absenderemail {$email}");
  }
  else
  {
    @mail($email,
          "S K R U P E L -> Zugangsdaten",
          $nachricht,
          "From: $absenderemail\r\n"."Reply-To: $absenderemail\r\n"."X-Mailer: PHP/" . phpversion());
  }
  ?>
        <br>
        Die Anmeldung war erfolgreich.<br><br>
        Die Zugangsdaten wurden per E-Mail übermittelt.
  <?
  }
}

@mysql_close();
?>

<? /////////////////////////////////////////////////////////////////////////////////////////// ?>
<!--
        </center></td>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="347" alt=""></td>
                         </tr>
                         <tr>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1" alt=""></td>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="628" height="1" alt=""></td>
                                <td><img src="<?=$skrupel_path?>bilder/empty.gif" border="0" width="1" height="1" alt=""></td>
                         </tr>
          </table></td>
        </tr>
</table></center>
</body>
</html>
-->
<center>
<?php
   
  require_once "inc/_frame_footer.php";
  require_once "inc/_footer.php";
?>

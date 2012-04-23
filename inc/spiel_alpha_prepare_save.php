<?php
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
include ($skrupel_path."inc.conf.php");
include ($skrupel_path."admin/inc.header.php");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)">Neues Spiel erstellen</td></tr></table></center>

<form name="formular" id="formular" method="post" action="spiel_alpha.php?fu=100">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">\n';
}
?>
<br><br><br><br><br>
<center>
<img src=<?=$skrupel_path?>"bilder/rad.gif" height="46" width="51"><br><br>
Einen Moment Geduld bitte.
<br><br>
Das Spiel wird erstellt.
</center>
</form>
<script language=JavaScript>
  document.getElementById('formular').submit();
 </script>
<?
include ($skrupel_path."admin/inc.footer.php");
}
?>

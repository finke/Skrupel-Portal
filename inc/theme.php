<?php
  if ( !$conf["theme"] || $conf["theme"] == 1 ) //Ingame Design
  {
    //header imgs
?>
  <!-- Kopfzeile -->
  <img src="<?=$skrupel_path?>bilder/aufbau/1.gif" class="portal_oben" style="left: 0px; width: 348px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/2.gif" class="portal_oben_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/3.gif" class="portal_oben" style="right: 0px; width:402px;" alt="">

  <!-- linker Rand -->
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_1.gif" class="portal_menu" style="top:  41px; height: 43px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_2.gif" class="portal_menu" style="top:  84px; height: 43px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_3.gif" class="portal_menu" style="top: 127px; height: 46px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_4.gif" class="portal_menu" style="top: 173px; height: 45px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_5.gif" class="portal_menu" style="top: 218px; height: 23px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_6.gif" class="portal_menu" style="top: 241px; height: 44px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_7.gif" class="portal_menu" style="top: 285px; height: 46px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/menu_8.gif" class="portal_menu" style="top: 331px; height: 49px;" alt="">

  <img src="<?=$skrupel_path?>bilder/aufbau/4.gif" class="portal_links_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/5.gif" class="portal_links_unten" alt="">

  <!-- rechter Rand -->
  <img src="<?=$skrupel_path?>bilder/aufbau/7.gif" class="portal_rechts_oben" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/9.gif" class="portal_rechts_unten" alt="">  <!-- height: 146px; -->

  <!-- Fusszeile -->
  <img src="<?=$skrupel_path?>bilder/aufbau/10.gif" class="portal_trenner" style="left: 0px; width: 387px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/11.gif" class="portal_trenner_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/12.gif" class="portal_trenner" style="right: 0px; width: 364px;" alt="">

  <img src="<?=$skrupel_path?>bilder/aufbau/13.gif" class="portal_nav" style="left: 0px; width: 56px; z-index:9;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/14.gif" class="portal_nav_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/15.gif" class="portal_nav" style="right: 0px; width: 19px;" alt="">

  <img src="<?=$skrupel_path?>bilder/aufbau/16.gif" class="portal_unten" style="left: 0px; width: 389px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/17.gif" class="portal_unten_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/18.gif" class="portal_unten" style="right: 0px; width: 361px;" alt="">

  <img src="<?=$skrupel_path?>bilder/aufbau/knopp.gif" style="position:absolute; bottom:10px; left:0px; height: 30px; width: 56px; z-index:10;" alt="">
<?php  }
  else if ( $conf["theme"] == 2 ) //admin design
  {
?>
  <!-- Fusszeile -->
  <img src="<?=$skrupel_path?>bilder/aufbau/31.gif" class="portal_trenner" style="left: 0px; width: 387px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/11.gif" class="portal_trenner_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/32.gif" class="portal_trenner" style="right: 0px; width: 364px;" alt="">

  <img src="<?=$skrupel_path?>bilder/aufbau/33.gif" class="portal_nav" style="left: 0px; width: 56px; z-index:9;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/14.gif" class="portal_nav_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/15.gif" class="portal_nav" style="right: 0px; width: 19px;" alt="">

  <img src="<?=$skrupel_path?>bilder/aufbau/16.gif" class="portal_unten" style="left: 0px; width: 389px;" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/17.gif" class="portal_unten_mitte" alt="">
  <img src="<?=$skrupel_path?>bilder/aufbau/18.gif" class="portal_unten" style="right: 0px; width: 361px;" alt="">
  
  <img src="<?=$skrupel_path?>bilder/aufbau/knopp.gif" style="position:absolute; bottom:10px; left:0px; height: 30px; width: 56px; z-index:10;" alt="">
<?php    
  }
  else if ( $conf["theme"] == 3) //portal
  {
?>
      <div style="position:absolute;width:114px;height:470px;border:0px solid green;z-index:2; top:10px; left:10px;">
        <div style="position:absolute;top:10px;left:10px;width:104px;height:450px;background-color: #444444;" ></div>
        <img src="<?=$skrupel_path?>bilder/aufbau/19.gif" style="position:absolute;top:0px;left:0px;" alt="">
        <img src="<?=$skrupel_path?>bilder/aufbau/25.gif" style="position:absolute;top:18px;left:0px" alt="">
        <img src="<?=$skrupel_path?>bilder/aufbau/26.gif" style="position:absolute;top:98px;left:0px;height:274px;width:18px;" alt="">
        <img src="<?=$skrupel_path?>bilder/aufbau/27.gif" style="position:absolute;bottom:14px;left:0px;" alt="">
        <img src="pics/r_us.gif" style="position:absolute;bottom:0px;left:0px;" alt="">
        <img src="<?=$skrupel_path?>bilder/aufbau/30.gif" style="position:absolute;bottom:16px;right:0px;" alt="">
        <img src="<?=$skrupel_path?>bilder/aufbau/29.gif" style="position:absolute;bottom:108px;right:0px;width:18px;height:232px;" alt="">
        <img src="pics/r_i.gif" style="position:absolute;top:84px;right:-30px;" alt="">
        <img src="<?=$skrupel_path?>bilder/logo_login.gif" style="position:absolute;top:13px;left:13px;width:131px;height:83px;" alt="Skrupel Logo">
        <table border="0" style="position:absolute;left:25px;top:120px;width:80px">
<?php if ( !$_SESSION["user_id"] ) { ?>
          <tr><td><a href="login.php">Login</a></td></tr>
          <tr><td><a href="register.php">Registrieren</a></td></tr>
<?php } else { ?>
          <tr><td><a href="logout.php">Logout</a></td></tr>
          <tr><td><a href="meta_optionen.php?fu=1">Optionen</a></td></tr>
          <tr><td><a href="spiel_alpha.php">Spiel erstellen</a></td></tr>
<?php } ?>
          <tr><td><a href="active.php">Aktive Spiele</a></td></tr>
          <tr><td><a href="waiting.php">Wartende Spiele</a></td></tr>
          <tr><td><a href="finished.php">Beendete Spiele</a></td></tr>
          <tr><td><a href="stats.php">Stats</a></td></tr>
          <tr><td><a href="meta_rassen.php">Rassen</a></td></tr>
          <tr><td>&nbsp;</td></tr>
          <tr><td><a href="http://www.skrupel.de/" target="_blank">Skrupel.de</a></td></tr>
          <tr><td><a href="http://www.skrupel.de/www/index.php/Spielanleitung" target="_blank">Anleitung</a></td></tr>
          <tr><td><a href="http://www.skrupel.de/www/index.php/Screenshots" target="_blank">Screenshots</a></td></tr>
          <tr><td><a href="http://www.skrupel.de/www/index.php/Filme" target="_blank">Einf&uuml;hrungs Filme</a></td></tr>
        </table>
        <span style="position:absolute;bottom:20px;left:18px;font-size:9px;text-align:center;width:78px;">
          &copy; 2007 <a href="http://www.tiramon.de/" target="_blank">Tiramon</a><br>
          <br>
          optimized for 1024x768
        </span>
      </div>
      <div style="position:absolute;width:990px;height:100px;border: 0px solid red;z-index:1; top:10px; left:10px;">
        <div style="position:absolute;top:10px;left:0px;width:980px;height:80px;background-color: #444444;"></div>
        <img src="<?=$skrupel_path?>bilder/aufbau/20.gif" style="position:absolute;top:0px;left:114px;height:18px;width:762px;" alt="">
        <img src="pics/r_rs.gif" style="position:absolute;top:0px;right:0px;" alt="">
        <img src="<?=$skrupel_path?>bilder/aufbau/23.gif" style="position:absolute;bottom:0px;right:114px;height:16px;width:732px;" alt="">
      </div>
      <div style="position:absolute; left: 20px; top: 480px;">
        <p>
          <a href="http://validator.w3.org/check?uri=referer"><img
             src="http://www.w3.org/Icons/valid-html401-blue"
             alt="Valid HTML 4.01 Transitional" height="31" width="88" border="0"></a>
        </p>
      </div>

<?php
  }
?>

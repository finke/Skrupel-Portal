<?php
 if ( $_GET["fu"] == 12 )
 {
   require "inc/conf.php";
   require $skrupel_path."admin/spiel_alpha.php";
   die();
 }
 require_once "inc/initial.php";
 require_once "inc/_header.php"; 
 require_once "inc/_frame_header.php";

 //if ($_SESSION["user_id"] == ADMIN || in_array( CREATEGAME,$_SESSION["rights"] ) )
 if ($_SESSION["user_id"] )
 {     
  // HTTP_COOKIE_VAR 0969
  // _COOKIE         0970
  $ftploginname = $HTTP_COOKIE_VARS["ftploginname"] = $_COOKIE["ftploginname"] = $admin_login;
  $ftploginpass = $HTTP_COOKIE_VARS["ftploginpass"] = $_COOKIE["ftploginpass"] = $admin_pass;

  if (!$HTTP_GET_VARS["fu"] && !$_GET["fu"]) 
  {
    $HTTP_GET_VARS["fu"] = 1; //0.969
    $_GET["fu"]          = 1; //0.970+
  }

  if ( $HTTP_GET_VARS["fu"] == 3 || $_GET["fu"] == 3 )
  {
    require "inc/spiel_alpha_3.php";
  }
  elseif ( $HTTP_GET_VARS["fu"] == 9 || $HTTP_GET_VARS["fu"] == 11  || $_GET["fu"] == 9  || $_GET["fu"] == 11)    
  {
    require "inc/spiel_alpha_prepare_save.php";
  }
  elseif ( $HTTP_GET_VARS["fu"] == 100  || $_GET["fu"] == 100) 
  {
    require "inc/spiel_alpha_save.php";        
  }
  else
  {
    require $skrupel_path."admin/spiel_alpha.php";
  }

 }
 else
 {
/*  
?>  
  <table width="99%" height="100%">
    <tr>
      <td align="center">Sie m&uuml;ssen angemeldet und eingelogt sein um ein Spiel zu erstellen.</td>
    </tr>
  </table>
<?php     
*/
?>  
  <table width="99%" height="100%">
    <tr>
      <td align="center"><!-- Zur Zeit darf nur Tiramon spiele erstellen,<br>aber das dürfte sich mit der weiterentwicklung des Portals bald &auml;ndern.-->Du musst eingelogt sein um ein Spiel zu erstellen</td>
    </tr>
  </table>
<?php     
 }
 require_once "inc/_frame_footer.php";
 require_once "inc/_footer.php"; 
?>

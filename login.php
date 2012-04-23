<?php 
  require_once "inc/initial.php";
  if ( $_SESSION["user_id"]) 
  {
    header("Location: index.php"); 
  }
  require_once "inc/_header.php";
  require_once "inc/_frame_header.php";
?>
<form action="index.php" method="post" name="formular">
<center>
 <img src="<?=$skrupel_path?>bilder/logo_login.gif" width="329" height="208" alt="Skrupel Logo"><br>
 <table border="0" cellspacing="0" cellpadding="4" align="center">
   <tr>     
     <td align="right">Benutzername&nbsp;</td>
     <td><input type="text" name="login" class="eingabe" maxlength="50" style="width:350px;" value=""></td>     
    </tr>
    <tr>
      <td align="right">Passwort&nbsp;</td>
      <td><input type="password" name="pass" class="eingabe" maxlength="50" style="width:350px;" value=""></td>      
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="submit" value="Login" style="width:65px;">        
      </td>      
    </tr>
  </table>
</center>
</form>
<?php  
  require_once "inc/_frame_footer.php";
  require_once "inc/_footer.php";
?>

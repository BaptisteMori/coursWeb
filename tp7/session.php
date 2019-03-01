<?php
  session_name("siteCompteur");
  session_start();
  if (key_exists("reinit",$_POST) || key_exists("reinit",$_GET)){
    session_destroy();
    unset($_COOKIE["date"]);
  }
  if (!key_exists("date",$_COOKIE)){
    $date=date("l d-m-y à h:i:s");
    setcookie("date",$date,time()+3000);
  }


?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Compteur de visite</h1>
    <?php
      if (key_exists("compteur",$_SESSION) && key_exists("date",$_COOKIE)){
          echo "<p> vous avez visiter ce site : ".$_SESSION["compteur"]." depuis le ".$_COOKIE["date"]."</p>";
          $_SESSION["compteur"]+=1;
      }else{
        echo "<p>Vous visité ce site pour la premiere fois</p>";
        $_SESSION["compteur"]=1;
      }
    ?>
    <a href="session.php?reinit=1">reinit</a>
    <form action="session.php" method="post">
      <input type="submit" name="reinit" value="remise a zero">
    </form>
    <form action="session.php" method="post">
      <input type="submit" name="t" value="reload">
    </form>
  </body>
</html>

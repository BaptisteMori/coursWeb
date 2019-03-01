<?php
  session_start();
  $content="Erreur, vous n’avez pas le droit d’être ici…";

  if(key_exists("user",$_SESSION)){
    if($_SESSION["user"]["status"]==="admin"){
      $content="Vous êtes bien admin !";
    }
  }

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Partie admin</h1>
    <p><?php echo $content; ?></p>
    <ul>
      <li><a href="index.php">accueil</a> </li>
      <li><a href="connexion.php">connexion/deconnexion</a> </li>
    </ul>
  </body>
</html>

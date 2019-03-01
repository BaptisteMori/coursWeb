<?php
session_start();
require_once 'comptes.php';
$error="";
if(key_exists("login",$_POST)){
  if(key_exists("password",$_POST)){
    $us="";
    foreach ($comptes as $user) {
      if ($user["login"]===$_POST["login"]){
        $us=$user;
        break;
      }
    }
    if($us!==""){
      if (password_verify($_POST["password"],$us["password"])){
        $_SESSION["user"]=$us;
        $error="connexion reussie";
      }else{
        $error="mauvais mot de passe";
      }
    }else{
      $error="login inconnus";
    }
  }else{
    $error="entrer un mot de passe";
  }
}

if(key_exists("deconnexion",$_POST)){
  unset($_SESSION["user"]);
  $error="deconnexion reussie";
}


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Page de connexion/deconnexion</h1>
    <span style="color: tomato;"><?php echo $error; ?></span>
    <?php
      if(key_exists("user",$_SESSION)){
        ?>
          <form action="#" method="post">
            <input type="submit" name="deconnexion" value="deconnexion">
          </form>
        <?php
      }else{
        ?>
          <form action="#" method="post">
            <input type="text" name="login" value="">
            <input type="password" name="password" value="">
            <input type="submit" name="" value="envoyer">
          </form>
        <?php
      }
    ?>

    <ul>
      <li><a href="index.php">accueil</a> </li>
      <li><a href="admin.php">admin</a> </li>
    </ul>
  </body>
</html>

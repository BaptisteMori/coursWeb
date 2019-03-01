<?php
if (!key_exists("langue",$_POST)){
    header("Location: erreur.html");
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>form</title>
  </head>
  <body>
    <?php
      $nom="X";
      if (key_exists("nom",$_POST)){
        if ($_POST["nom"]===''){
          $nom="X";
        }else{
          $nom=$_POST["nom"];
        }
      }
      echo "<h1>Bonjour Monsieur ".$nom."</h1>";

      if (key_exists("couleur",$_POST)){
        echo "<style>body { background-color: ".$_POST["couleur"].";}";
      }

      $tab = array('allemand' => "hallo",
                  'anglais' => "hello",
                  'francais' => "bonjour");
      var_dump($_POST["langue"]);
      foreach ($_POST["langue"] as $value) {
        echo "<p>".$tab[$values]."</p>";
      }
    ?>
  </body>
</html>

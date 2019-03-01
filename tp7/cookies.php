<?php
$date=date("d-m-y à h:i:s");
setcookie("last_visit",$date,time()+30);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>Nous somme le <?php echo $date; ?></p>
    <?php
      if(key_exists("last_visit",$_COOKIE)){
        echo "<p>Votre derniere visite remonte au ".$_COOKIE["last_visit"]."</p>";
      }
    ?>
  </body>
</html>

<?php
  session_start();

  $uperror = array(1 => "UPLOAD_ERR_INI_SIZE",
                   2 => "UPLOAD_ERR_FORM_SIZE",
                   3 => "UPLOAD_ERR_PARTIAL",
                   4 => "UPLOAD_ERR_NO_FILE",
                   6 => "UPLOAD_ERR_NO_TMP_DIR",
                   7 => "UPLOAD_ERR_CANT_WRITE",
                   8 => "UPLOAD_ERR_EXTENSION");

  $name="";
  $image="";
  if (key_exists("user",$_SESSION)){
    $name=", ".$_SESSION["user"]["name"];
  }
  $error="";
  if (key_exists("image",$_FILES)){
    var_dump($_FILES["image"]);
    if ($_FILES["image"]["error"]==0){
      if(exif_imagetype($_FILES["image"]["tmp_name"])==IMAGETYPE_JPEG){

        $img_name=explode("/",$_FILES["image"]["tmp_name"])[4];

        if (move_uploaded_file($_FILES["image"]["tmp_name"],"/users/21602052/www-dev/tp10/img/".$img_name)){
          $error = "upload ok";

          $_SESSION["image"]=$img_name;

        }else{
          $error= "erreur de copie";
        }
      }else{
        $error="ce n'est pas une image de type jpeg";
      }
    }else{
      $error=$uperror[$_FILES["image"]["error"]];
    }
  }

  if (key_exists("image",$_SESSION)){
    $image="<img src='img/".$_SESSION["image"]."' alt=''>";
  }

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Bienvenue <?php echo $name; ?> !</h1>
    <p>Vous etes sur la page d'accueil.</p>
    <ul>
      <li><a href="connexion.php">connexion/deconnexion</a> </li>
      <li><a href="admin.php">admin</a> </li>
    </ul>
    <br>
    <?php echo $image; ?>
    <br>
    <span style="color: tomato;"><?php echo $error; ?></span>
    <form enctype="multipart/form-data" action="index.php" method="post">
      <input type="file" name="image" value="">
      <br>
      <input type="submit" name="" value="envoyer">
    </form>

  </body>
</html>

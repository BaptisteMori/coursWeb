<?php
$user="21602052";
$pass="vih9Theesei9eile";

$bd= new PDO("mysql:host=mysql.info.unicaen.fr;dbname=21602052_bd;port=3306;charset=utf8mb4",$user,$pass);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>gallerie</title>
    <link rel="stylesheet" href="gallerie.css">
  </head>
  <body>
    <?php
      $order="";
      if (key_exists("order",$_GET)){
        $order=" ORDER BY";
        if($_GET["order"]==="author"){
          $order.=" author_name";
        }
      }

      if (!key_exists("id",$_GET)){
        $req="SELECT id,title,thumb_url FROM images".$order;
        $stmt= $bd->query($req);
        echo "<ul>";
        while ($ligne= $stmt->fetch(PDO::FETCH_ASSOC)){
          echo "
          <li>
            <a href='galerie.php?id=".$ligne["id"]."'>
              <img src='".$ligne["thumb_url"]."' atl='".$ligne["title"]."'>
              <h2>".$ligne["title"]."</h2>
            </a>
          </li>";
        }
        echo "</ul>";
      }else{
        $req="SELECT title,thumb_url,image_page_url,author_name,author_url FROM images WHERE id=:id".$order;
        $stmt= $bd->prepare($req);
        $data = array(':id' => $_GET["id"]);
        $stmt->execute($data);
        $result=$stmt->fetch();
        echo "<figure>
          <img src='".$result["thumb_url"]."' alt='".$result["title"]."'>
          <ficaption>
            <a href='".$result["image_page_url"]."'>".$result["title"]."</a>
            <br>
            <a href='".$result["author_url"]."'><p>Auteur : ".$result["author_name"]."</p></a>
          </figcaption>
        </figure>";
        echo "<a href='galerie.php'>retour</a>";
      }
    ?>
  </body>
</html>

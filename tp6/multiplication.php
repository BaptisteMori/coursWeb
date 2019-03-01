<?php

  function multiplication($borne){
    for ($i=1; $i < ($borne+1); $i++) {
      for ($j=1; $j < ($borne+1); $j++) {
        echo "<p>" . ($i*$j) . "</p>";
      }
    }
  }

  if (key_exists("borne",$_GET)){
    if ($_GET["borne"]==0){
      echo "la borne est null";
      die;
    }elseif ($_GET["borne"]==="") {
      echo "la borne est vide";
      die;
    }else{
      $n=$_GET["borne"];
    }
    if ($_GET["borne"]<1 || $_GET["borne"]>100){
      $n=15;
    }

  }else{
    $n=15;
  }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>multiplication</title>
    <style>
      section{
        display:grid;
        grid-template-columns: repeat(<?php echo $n; ?>,1fr);
      }
    </style>
  </head>
  <body>
    <a href="multiplication.php?borne=<?php echo ($n+1); ?>">multiplication suivante</a>
    <section>
      <?php
        echo multiplication($n);
      ?>
    </section>
  </body>
</html>

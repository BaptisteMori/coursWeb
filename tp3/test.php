<?php
  $tab=array();
  for($i=0;$i<100;$i++){
    $tab[$i]=3*$i+2;
  }

  function moyenne($tab){
    $moy=0;
    foreach ($tab as $value) {
      $moy+=$value;
    }
    return ($moy/count($tab));
  }

  function sites($tab){
    $str="";
    foreach ($tab as $key => $value) {
      $str.="<li><a href='$value'>$key</a></li>";
    }
    return $str;
  }

  $site = array('Google' => "http://google.fr", 'Wikipedia' => "http://wikipedia.org");
?>

<!DOCTYPE html>
<html>
  <head>
  	<meta charset="UTF-8" />
  	<title>test</title>
  </head>
  <body>
    <h1>Valeurs</h1>
    <p>
    <?php
      /*
      for($i = 1234; $i<5678;$i++){
        echo "$i\n";
      }
      */


      foreach ($tab as $value) {
        echo $value."\n";
      }

    ?>
    </p>
    <p>
      <?php echo "\n moyenne : ".moyenne($tab); ?>
    </p>
    <nav>
      <ul>
        <?php
          echo sites($site);
        ?>
      </ul>
    </nav>
  </body>
</html>

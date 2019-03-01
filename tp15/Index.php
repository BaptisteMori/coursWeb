<?php
session_start();
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
//set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
//require_once("lib/DataBase.php");
//require_once("model/AnimalStorageMySQL.php");


/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */
//$storage = new AnimalStorageFile($_SERVER['TMPDIR']."/dbanimal.txt");
//$storage = new AnimalStorageMySQL($bd);
$router = new Router();
$router->main();
?>

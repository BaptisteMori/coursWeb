<?php
echo "<p>";
$frg=file_get_contents("fragmentHTML.txt");
echo $frg;
echo "</p><p>";
$frg2=file_get_contents("fragmentPHP.txt");
echo $frg2;
echo "</p>";
ob_start();
include "fragmentPHP.txt";
$val = ob_get_clean();
echo $val;

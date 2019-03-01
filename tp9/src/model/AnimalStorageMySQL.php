<?php

require_once("lib/DataBase.php");

class AnimalStorageMySQL implements AnimalStorage
{

  function __construct($db)
  {
    $this->db=$bd;
  }

  public function read($id){
    return null;
  }

  public function readAll(){
    return null;
  }

  public function create(Animal $a){
    return null;
  }
}

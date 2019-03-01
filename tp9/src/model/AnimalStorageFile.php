<?php
require_once("lib/ObjectFileDB.php");
require_once("AnimalStorageStub.php");
require_once("AnimalStorage.php");

class AnimalStorageFile implements AnimalStorage
{
  private $db;

  function __construct($file)
  {
    $this->db=new ObjectFileDB($file);
  }

  function reinit(){
    $this->db->deleteAll();
    $animal_storage=new AnimalStorageStub();
    foreach ($animal_storage->readAll() as $animal) {
      $this->db->insert($animal);
    }
  }

  public function read($id) {
    if ($this->db->exists($id)) {
      return $this->db->fetch($id);
    } else {
      return null;
    }
  }

  public function readAll() {
    return $this->db->fetchAll();
  }

  public function create(Animal $a){
    return $this->db->insert($a);
  }
}

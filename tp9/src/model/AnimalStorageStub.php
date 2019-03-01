<?php
require_once("AnimalStorage.php");

class AnimalStorageStub implements AnimalStorage {

  private $animals;

  public function __construct() {
    $this->animals = array (
      "denver" => new Animal("Denver","dinosaure","73 000 000"),
      "medor" => new Animal("Médor","chien","3"),
      "felix" => new Animal("Félix","chat","11"),
    );
  }

  public function read($id) {
    if (key_exists($id, $this->animals)) {
      return $this->animals[$id];
    } else {
      return null;
    }
  }

  public function readAll() {
    return $this->animals;
  }

  public function create(Animal $a){

  }
}

?>

<?php
interface AnimalStorage {

  public function read($id);

  public function readAll();

  public function create(Animal $a);

}


?>

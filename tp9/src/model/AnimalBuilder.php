<?php
require_once("model/Animal.php");


class AnimalBuilder
{

  const NAME_REF="nom";
  const SPECIES_REF="espece";
  const AGE_REF="age";


  private $data;
  private $error;

  function __construct($data)
  {
    $this->data=$data;
    $this->error=null;
  }

  public function createAnimal(){
    return new Animal($this->data[$this::NAME_REF],$this->data[$this::SPECIES_REF],$this->data[$this::AGE_REF]);
  }

  public function isValid(){
    if ($this->data[$this::NAME_REF]==""){
      $this->error="nom incomplé";
    }elseif ($this->data[$this::SPECIES_REF]==""){
      $this->error="espece incomplète";
    }elseif ($this->data[$this::AGE_REF]==""){
      $this->error="age incomplé";
    }elseif ($this->data[$this::AGE_REF]<0) {
      $this->error="l'age ne peut etre inferieur a 0";
    }

    if ($this->error==null){
      return true;
    }
    return false;
  }

  public function getData(){
    return $this->data;
  }

  public function getError(){
    return $this->error;
  }
}

<?php
class Animal {

  private $name;
  private $species;
  private $age;

  public function __construct($name, $species, $age) {
    $this->name=$name;
    $this->species=$species;
    $this->age=$age;
  }

  public function getName() {
    return htmlspecialchars($this->name, ENT_QUOTES|ENT_SUBSTITUTE|ENT_HTML5, 'UTF-8');
  }

  public function getSpecies() {
    return htmlspecialchars($this->species, ENT_QUOTES|ENT_SUBSTITUTE|ENT_HTML5, 'UTF-8');
  }

  public function getAge() {
    return htmlspecialchars($this->age, ENT_QUOTES|ENT_SUBSTITUTE|ENT_HTML5, 'UTF-8');
  }
}
?>

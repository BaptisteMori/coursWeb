<?php

require_once("model/Animal.php");
require_once("model/AnimalStorage.php");
require_once("model/AnimalBuilder.php");
require_once("model/AccountStorage.php");
//require_once("model/AnimalStorageStub.php");

class Controller  {

  private $view;
  private $storage;

  public function __construct(View $view, AnimalStorage $storage, AccountStorage $userStorage) {
    $this->view = $view;
    $this->storage = $storage;
  }

  public function showInformation($id) {
    $animal = $this->storage->read($id);
    if ($animal !== null) {
      $this->view->makeAnimalPage($animal);
    } else {
      $this->view->makeUnknowAnimalPage($id);
    }
  }

  public function newAnimal(){
    $newanimal= new AnimalBuilder(null);
    if (key_exists('currentNewAnimal',$_SESSION) && $_SESSION['currentNewAnimal']!==null){

      //$newanimal=$_SESSION['currentNewAnimal'];
      $newanimal= new AnimalBuilder($_SESSION['currentNewAnimal']);
      unset($_SESSION['currentNewAnimal']);
    }
    $this->view->makeAnimalCreationPage($newanimal);
  }

  public function showList() {
    $animalsTab = $this->storage->readAll();
    $this->view->makeListPage($animalsTab);
  }

  public function saveNewAnimal(array $data){
    $newanimal = new AnimalBuilder($data);
    if($newanimal->isValid()){
      $animal=$newanimal->createAnimal();
      $id= $this->storage->create($animal);
      $this->view->displayAnimalCreationSuccess($id);
    }else{
      $_SESSION['currentNewAnimal']=$newanimal->getData();
      $this->view->makeAnimalCreationPage($newanimal);
    }
  }


  public function checkLogin()
  {

  }

}
?>

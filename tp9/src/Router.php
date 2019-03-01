<?php


require_once("view/View.php");
require_once("control/Controller.php");
require_once("model/AnimalStorageStub.php");
require_once("model/AnimalBuilder.php");
require_once("model/AnimalStorageFile.php");
require_once("model/AccountStorageStub.php");

class Router {

  public function main($storage,$userStorage) {
    try {
      $feedback = key_exists('feedback', $_SESSION) ? $_SESSION['feedback'] : '';
  		$_SESSION['feedback'] = '';

      $view = new View($this, $feedback);

      //$storage->reinit();
      $control = new Controller($view, $storage, $userStorage);
      if (key_exists("liste",$_GET)) {
        $control->showList();
      } else if (key_exists("id",$_GET)) {
        $control->showInformation($_GET["id"]);
      } elseif (key_exists("action",$_GET)) {
        if ($_GET["action"]==="nouveau"){
          $control->newAnimal();
        }elseif ($_GET["action"]==="sauverNouveau") {
          $control->saveNewAnimal($_POST);
        }

      }elseif (key_exists("login",$_GET)){
        $view->makeLoginFormPage();
      }elseif (key_exists("checkLogin",$_GET)) {
        $control->checkLogin();
      }
      else {
        $view->makeHomePage();
      }
      $view->render();
    } catch ( Exception $e ){
      $view->makeDebugPage($e);
    }
  }

  public function POSTredirect($url, $feedback){
    $_SESSION['feedback']=$feedback;
    header("Location: " . $url, true, 303);
  }

  public function getUrl(){
    return "https://dev-21602052.users.info.unicaen.fr/tp9/";
  }

  public function getAccueilUrl(){
    return $this->getUrl()."animaux.php";
  }

  public function getLoginUrl(){
    return $this->getUrl()."animaux.php?login";
  }

  public function getCheckLoginUrl()
  {
    return $this->getUrl()."animaux.php?checkLogin";
  }

  public function getListeAnimalUrl(){
    return "https://dev-21602052.users.info.unicaen.fr/tp9/animaux.php?liste";
  }

  public function getAnimalUrl($id) {
    return "https://dev-21602052.users.info.unicaen.fr/tp9/animaux.php?id=".$id;
  }

  public function getAnimalCreationURL(){
    return "https://dev-21602052.users.info.unicaen.fr/tp9/animaux.php?action=nouveau";
  }

  public function getAnimalSaveURL(){
    return "https://dev-21602052.users.info.unicaen.fr/tp9/animaux.php?action=sauverNouveau";
  }

  public function getAnimalAskDeletionURL($id){
    return "https://dev-21602052.users.info.unicaen.fr/tp9/animaux.php?";
  }

  public function getAnimalDeletionURL($id){
    return "https://dev-21602052.users.info.unicaen.fr/tp9/animaux.php?";
  }

}
?>

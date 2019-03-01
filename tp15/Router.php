<?php

require_once("control/Controller.php");
require_once("view/View.php");

class Router
{

  function main()
  {

    $view = new View($this);

    //$control = new Controller();

    try {
      if (key_exists("login",$_GET)){
        $view->makeLoginFormPage();
      }else {
        $view->makeHomePage();
      }
      $view->render();
    }catch ( Exception $e ){
      $view->makeDebugPage($e);
    }
  }

  public function getUrl(){
    return "https://dev-21602052.users.info.unicaen.fr/tp15/";
  }

  public function getAccueilUrl(){
    return $this->getUrl()."Index.php";
  }

  public function getLoginUrl(){
    return $this->getUrl()."Index.php?login";
  }

}

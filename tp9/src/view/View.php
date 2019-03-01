<?php

require_once("model/Animal.php");
require_once("model/AnimalBuilder.php");
require_once("Router.php");

class View {

  private $title;
  private $content;
  private $router;
  private $menu;
  private $feedback;

  public function __construct(Router $router, $feedback) {
    $this->router = $router;
    $this->title = null;
    $this->content = null;
    $this->feedback = $feedback;
    $this->menu = "<ul>
                    <li><a href='".$this->router->getAccueilUrl()."'>Accueil</a></li>
                    <li><a href='".$this->router->getListeAnimalUrl()."'>Liste</a></li>
                    <li><a href='".$this->router->getAnimalCreationURL()."'>Creation</a></li>
                    <li><a href='".$this->router->getLoginUrl()."'>Login</a></li>

                  </ul>";
  }

  public function render() {
    $title = $this->title;
		$content = $this->content;
    $menu = $this->menu;
    $feedback = $this->feedback;
    include("template.php");

  }

  public function makeTestPage() {
    $this->title = "Lorem ipsum";
    $this->content = "Lorem ipsum dolor sit amet, consectetur adipisicing elit,
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
    ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
    laborum.";
  }

  public function makeAnimalPage(Animal $animal) {
    $this->title = $animal->getName();
    $this->content = $animal->getName()." est un animal de l'espèce ".$animal->getSpecies()
    ." qui a ".$animal->getAge()." ans.";
  }

  public function makeUnknowAnimalPage($name) {
    $this->title = "Animal inconnu";
    $this->content = "L'animal ".$name." est inconnu";
  }

  public function makeHomePage() {
    $this->title = "Bienvenue !";
		$this->content = "Ceci est un site sur les animaux";
  }

  public function makeListPage($array) {
    $this->title = "Liste des animaux";
    $this->content = "";
    foreach ($array as $nom => $animal) {
      $this->content .= "<a href='".$this->router->getAnimalUrl($nom)."'>".$animal->getName()."</a><br />";
    }
  }

  public function makeAnimalCreationPage(AnimalBuilder $animalbuild){
    $name="";
    $species="";
    $age="";
    if ($animalbuild->getData()!=null){
      if ($animalbuild->getData()["nom"]!=""){
        $name=$animalbuild->getData()["nom"];
      }
      if ($animalbuild->getData()["espece"]!=""){
        $species=$animalbuild->getData()["espece"];
      }
      if ($animalbuild->getData()["age"]!=""){
        $age=$animalbuild->getData()["age"];
      }
    }


    $this->title = "Ajouter un animal";
    $this->content = "
    <h2 style='color: red'>".$animalbuild->getError()."</h2>
    <form action=\"".$this->router->getAnimalSaveURL()."\" method=\"POST\">
      <label>Nom :</label><input type=\"text\" name=\"".$animalbuild::NAME_REF."\" value=\"".$name."\">
      <label>Espece :</label><input type=\"text\" name=\"".$animalbuild::SPECIES_REF."\" value=\"".$species."\">
      <label>age :</label><input type=\"number\" name=\"".$animalbuild::AGE_REF."\" value=\"".$age."\">
      <input type=\"submit\" value=\"enregistrer\">
    </form> ";
  }

  public function makeAnimalDeletionPage($id){
    $this->title="Suppression de ";
  }

  public function displayAnimalCreationSuccess($id){
    $this->router->POSTredirect($this->router->getAnimalUrl($id),"creation reussi");
  }

  public function makeLoginFormPage()
  {
    $this->title = "Login Page";
    $this->content = "
    <h2 style='color: red'></h2>
    <form action='".$this->router->getCheckLoginUrl()."' method=\"POST\">
      <label>Login :</label><input type=\"text\" name='login'>
      <label>Password :</label><input type=\"password\" name='password' >
      <input type=\"submit\" value=\"Login\">
    </form> ";
  }

  public function makeDebugPage($variable) {
	   $this->title = 'Debug';
	   $this->content = '<pre>'.var_export($variable, true).'</pre>';
  }

  public function makeErrorPage(){
    $this->title="Error";
    $this->content="";
  }

}
?>

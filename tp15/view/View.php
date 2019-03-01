<?php

class View {

  private $title;
  private $content;
  private $router;
  private $menu;

  public function __construct(Router $router) {
    $this->router = $router;
    $this->title = null;
    $this->content = null;
    $this->menu = "<ul>
                      <li><a href='".$this->router->getAccueilUrl()."'>Accueil</a></li>
                      <li><a href='".$this->router->getLoginUrl()."'>Login</a></li>
                   </ul>";
  }

  public function render() {
    $title = $this->title;
		$content = $this->content;
    $menu = $this->menu;
    include("template.php");

  }

  public function makeHomePage() {
    $this->title = "Bienvenue !";
		$this->content = "Ceci est un site sur les Accounts";
  }

  public function makeLoginFormPage()
  {
    $this->title = "Login Page";
    $this->content = "
    <h2 style='color: red'></h2>
    <form action='' method=\"POST\">
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

<?php
require "MVC/model/modelSpecial.php";
require dirname(__DIR__) . "/requireLink.php";

class controller {
  private $displayMethod;
  public function __construct($server, $database, $user, $password) {
    $this->displayMethod = new modelSpecial($server, $database, $user, $password);
  }
  /* ---- general method ---*/

  public function loadTwig() {

  $loader = new Twig_Loader_Filesystem('MVC/view'); //folder wich contain the template
  $twig = new Twig_Environment($loader, array(
    'cache' => false,
    'charset' => "utf-8",
    'debug' => true
  ));

  //for enabled the dump in twig = to var_dump in php
    $twig->addExtension(new Twig_Extension_Debug());

    return $twig;
  }
  
  public function checkViewDefault() {
    $message = "";
    $tabError = array();

    if(isset($_POST['login'])) {
      $email = $_POST['email'];
      if(empty($email)) {
        $message = 'error';
      }
    }

    $templateIndex = $this->loadTwig()->loadTemplate('user.html.twig');
    return $templateIndex->render(array(
      "myMessage" => $message
    ));
  }
  /* ---- specific method ----- */
}

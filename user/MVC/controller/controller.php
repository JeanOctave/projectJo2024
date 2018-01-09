<?php
require "MVC/model/modelSpecial.php";
require dirname(__DIR__) . "/requireLink.php";

class controller {
  private $displayMethod;
  private $pathUser = "http://localhost/Developpement/dev/jo2024/user/";

  public function __construct($server, $database, $user, $password) {
    $this->displayMethod = new modelSpecial($server, $database, $user, $password);
  }
  /* ---- general method ---*/

  //setTable DataBase
  public function setTable($table) {
    $this->displayMethod-> inform($table);
  }
  //loaded my twig
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
  //stay Session enable
  public function staySessionEnable($email, $password) {
    /* call request selectWhere */
    $fields = array("lastName", "mail", "salt", "pswd");
    $where = array(
      "mail" => $email,
      "pswd" => $password
    );
    $unUtilisateur = $this->displayMethod-> selectWhere($fields, $where);
    return $unUtilisateur;
  }

  /* ---- specific method ----- */

  /* ----- Session ----- */
   public function initSession() {
     return session_start();
   }
   public function destroySession() {
      $_SESSION = array();
      session_destroy();
      unset($_SESSION);
   }
   public function getSessionCo($lastName, $mail, $pswd) {
      $_SESSION['lastName'] = $lastName;
      $_SESSION['mail'] = $mail;
      $_SESSION['pswd'] = $pswd;
   }
  /* ------------ */

  /* ------ My View -----*/
  /* check and request for Sign in and Sign Up */
    public function checkViewDefault() {
      $message = "";
      $tabError = array();
      $this->setTable('user');

      if(isset($_POST['submit'])) {
        sleep(1);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['pswd']);

        $unUtilisateur = $this->staySessionEnable($email, $password);

        /* check fields */
        if($unUtilisateur['mail'] !== $email || $unUtilisateur['pswd'] !== $password) {
          $message = "error Sign in";
          $tabError[][] = "mail or password invalid";
        }

        /* if no errors */
        if(count($tabError) == 0) {
          //call method for retrevial session
          $this->getSessionCo($unUtilisateur['lastName'], $email, $password);
        }

      }

      //disconnect session
      if(isset($_POST['disconnect'])) {
        $this->destroySession();
        header('location: user.php');
      }

      $templateIndex = $this->loadTwig()->loadTemplate('user.html.twig');
      return $templateIndex->render(array(
        "myMessage" => $message,
        "inputErrors" => $tabError,
        "session" => $_SESSION,
        "home" => $this->returnHome(),
        "contact" => $this->returnContact()
      ));
    }

    public function checkViewContact() {
        $message = "";
        $tabError = array();
        $this->setTable('user');

        if(isset($_POST['submit'])) {
          sleep(1);
          $email = htmlspecialchars($_POST['email']);
          $password = htmlspecialchars($_POST['pswd']);

          $unUtilisateur = $this->staySessionEnable($email, $password);
          /* check fields */
          if($unUtilisateur['mail'] !== $email || $unUtilisateur['pswd'] !== $password) {
            $message = "error Sign in";
            $tabError[][] = "mail or password invalid";
          }
          /* if no errors */
          if(count($tabError) == 0) {
            //call method for retrevial session
            $this->getSessionCo($unUtilisateur['lastName'], $email, $password);
          }
  
        }
          //disconnect session
          if(isset($_POST['disconnect'])) {
            $this->destroySession();
            header('location: user.php');
          }

        $templateContact = $this->loadTwig()->loadTemplate('contact.html.twig');
        return $templateContact->render(array(
          "session" => $_SESSION,
          "home" => $this->returnHome(),
          "contact" => $this->returnContact()
        ));
    }
    
    /* ------- */
    
    /* ----- Link page -----*/
    // method return home
    public function returnHome() {
      $linkReturnHome = $this->pathUser . "user.php?page=1";
      return $linkReturnHome;
    }
    //method go to Activities
    public function returnActivities() {
      $linkReturnActivities = $this->pathUser . "user.php?page=2";
      return $linkReturnActivities;
    }
    //method go to Activities
    public function returnGames() {
      $linkReturnGames = $this->pathUser . "user.php?page=3";
      return $linkReturnGames;
    }
    // method go to the page contact
    public function returnContact() {
      $linkReturnContact = $this->pathUser . "user.php?page=4";
      return $linkReturnContact;
    }
  /* -------- */
}

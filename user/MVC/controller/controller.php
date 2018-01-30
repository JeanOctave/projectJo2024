<?php
require dirname(__DIR__) . "/model/modelSpecial.php";
require dirname(__DIR__) . "/requireLink.php";

class controller {
  private $displayMethod;
  private $pathUser = "http://localhost/Developpement/prod/jo2024/user/";
  private $tabPActivities;

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
    //for enabled the dump in twig = to var_dump in php.
    $twig->addExtension(new Twig_Extension_Debug());

    return $twig;
  }
  public function loadTwigAjax() {
    $path = dirname(__DIR__) . '/view';
    $loader = new Twig_Loader_Filesystem($path); //folder wich contain the template
    $twig = new Twig_Environment($loader, array(
      'cache' => false,
      'charset' => "utf-8",
      'debug' => true
    ));
    //for enabled the dump in twig = to var_dump in php.
    $twig->addExtension(new Twig_Extension_Debug());

    return $twig;
  }
  //method send Email Admin
  public function sendEmailAdmin($tabEmail) {
    if($_SERVER['SERVER_NAME'] == 'localhost'){

      $transport = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
      $transport->setUsername('thermos1111@gmail.com');
      $transport->setPassword('pzprsoqneiaxoobw');
    }
    else{
    
      $transport = new Swift_MailTransport();
    
    }
    
    $mailer = new Swift_Mailer($transport);
  
    $message = (new Swift_Message($tabEmail['subject']))
      ->setFrom(['thermos1111@gmail.com'])
      ->setTo([$tabEmail['email']])
      ->setContentType("text/html")
      ->setCharset('utf-8')
      ->setBody($tabEmail['message']);

    $result = $mailer->send($message);

    return $result;
  }
  //stay Session enable
  public function staySessionEnable($email, $passwordCrypted) {
    /* call request selectWhere */
    $fields = array("lastName", "mail", "salt", "pswd");
    $where = array(
      "mail" => $email,
      "pswd" => $passwordCrypted
    );
    $unUtilisateur = $this->displayMethod-> selectWhere($fields, $where);
    return $unUtilisateur;
  }
  //get the salt
  public function getTheSalt($mail) {
    $fields = array("salt");
    $where = array(
      "mail" => $mail
    );
    $theSalt = $this->displayMethod-> selectWhere($fields, $where);
    return $theSalt;
  }
  //pagination for activities
  public function paginationActivities($perPage, $getVariable) {
    //call method for choice the table and count data
    $this->setTable('selectAllActivities');
    $count = $this->displayMethod->selectCount('idEvent');
    $nbIn = $count['nbValue'];
    //number of pages and if float ex: 2,5 rise to number above
    $nbPage = ceil($nbIn / $perPage);
    
    //checked if variable exist
    if(isset($_GET[$getVariable]) && $_GET[$getVariable] > 0 && $_GET[$getVariable] <= $nbPage) {
     $currentPage = $_GET[$getVariable];
    } 
    else {
     $currentPage = 1;
    }
    //start data and number of data by number ex: select * from mytable limit 0, 2, start to 0 and 2 by page
    $start = ($currentPage-1) * $perPage;
    $nbResult = $perPage;
    $results = $this->displayMethod->selectLimit($start, $nbResult);

    return array("results" => $results, "nbPage" => $nbPage);

  }
  //pagination Games
  public function paginationGames($perPage, $getVariable) {
    //call method for choice the table and count data
    $this->setTable('selectAllGames');
    $count = $this->displayMethod->selectCount('idEvent');
    $nbIn = $count['nbValue'];
    //number of pages and if float ex: 2,5 rise to number above
    $nbPage = ceil($nbIn / $perPage);
    
    //checked if variable exist
    if(isset($_GET[$getVariable]) && $_GET[$getVariable] > 0 && $_GET[$getVariable] <= $nbPage) {
     $currentPage = $_GET[$getVariable];
    } 
    else {
     $currentPage = 1;
    }
    //start data and number of data by number ex: select * from mytable limit 0, 2, start to 0 and 2 by page
    $start = ($currentPage-1) * $perPage;
    $nbResult = $perPage;
    $results = $this->displayMethod->selectLimit($start, $nbResult);

    return array("results" => $results, "nbPage" => $nbPage);

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
      $messageSignUp = "";
      $tabError = array();
      //setTable sport for the list
      $this->setTable('sport');
      //select all sports for the list
      $sports = $this->displayMethod-> selectAll();
      //login user
      if(isset($_POST['submit'])) {
        $this->setTable('user');
        sleep(1);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['pswd']);
        //get salt user
        $theSalt = $this->getTheSalt($email);
        //crypted password
        $passwordCrypted = crypt($password, $theSalt['salt']);
        
        $unUtilisateur = $this->staySessionEnable($email, $passwordCrypted);
        /* check fields */
        if($unUtilisateur['mail'] !== $email || !password_verify($password, $unUtilisateur['pswd'])) {
          $message = "error Sign in";
          $tabError[][] = "mail or password invalid";
        }
        /* if no errors */
        if(count($tabError) == 0) {
          //call method for retrevial session
          $this->getSessionCo($unUtilisateur['lastName'], $email, $passwordCrypted);
        }

      }
      //register user
      if(isset($_POST['Su'])) {
        $tabPref = array();
        $thePreferences = "";
        $preferencesUser = $_POST['prf'];
        $repeatPass = $_POST['repeatPass'];
        
        //call method for choised several data in the select
        $myPreference = $this->multipleSelect($tabPref, $thePreferences, $preferencesUser);

        //crypt password
        $salt = md5(uniqid());
        $passwordCrypted = crypt($_POST['password'], $salt);

        $tabInsert = array(
          "firstName" => $_POST['fname'],
          "lastName" => $_POST['lname'],
          "mail" => $_POST['email'],
          "salt" => $salt,
          "active" => '1',
          "pswd" => $passwordCrypted,
          "preference" => $myPreference,
        );
        
        //check Sign up
        if(!password_verify($repeatPass, $passwordCrypted)) {
          $tabError[][] = "the two passwords are not identical";
        }
        if(count($tabError) == 0) {
          $messageSignUp = "Successful registration, you can connect";
          $this->displayMethod-> insertUser($tabInsert);
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
        "sucessSignUp" => $messageSignUp,
        "inputErrors" => $tabError,
        "session" => $_SESSION,
        "home" => $this->returnHome(),
        "contact" => $this->returnContact(),
        "activities" => $this->returnActivities(),
        "games" => $this->returnGames(),
        "scoreboard" => $this->returnScoreboard(),
        "sports" => $sports
      ));
    }

    public function checkViewContact() {
      $message = "";
      $messageSignUp = "";
      $tabError = array();
      $sucessMessageSend = "";
      //setTable sport for the list
      $this->setTable('sport');
      //select all sports for the list
      $sports = $this->displayMethod-> selectAll();
      //login user
      if(isset($_POST['submit'])) {
        $this->setTable('user');
        sleep(1);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['pswd']);
        //get salt user
        $theSalt = $this->getTheSalt($email);
        //crypted password
        $passwordCrypted = crypt($password, $theSalt['salt']);
        
        $unUtilisateur = $this->staySessionEnable($email, $passwordCrypted);
        /* check fields */
        if($unUtilisateur['mail'] !== $email || !password_verify($password, $unUtilisateur['pswd'])) {
          $message = "error Sign in";
          $tabError[][] = "mail or password invalid";
        }
        /* if no errors */
        if(count($tabError) == 0) {
          //call method for retrevial session
          $this->getSessionCo($unUtilisateur['lastName'], $email, $passwordCrypted);
        }

      }
      //register user
      if(isset($_POST['Su'])) {
        $tabPref = array();
        $thePreferences = "";
        $preferencesUser = $_POST['prf'];
        $repeatPass = $_POST['repeatPass'];
        
        //call method for choised several data in the select
        $myPreference = $this->multipleSelect($tabPref, $thePreferences, $preferencesUser);

        //crypt password
        $salt = md5(uniqid());
        $passwordCrypted = crypt($_POST['password'], $salt);

        $tabInsert = array(
          "firstName" => $_POST['fname'],
          "lastName" => $_POST['lname'],
          "mail" => $_POST['email'],
          "salt" => $salt,
          "active" => '1',
          "pswd" => $passwordCrypted,
          "preference" => $myPreference,
        );
        
        //check Sign up
        if(!password_verify($repeatPass, $passwordCrypted)) {
          $tabError[][] = "the two passwords are not identical";
        }
        if(count($tabError) == 0) {
          $messageSignUp = "Successful registration, you can connect";
          $this->displayMethod-> insertUser($tabInsert);
        }
       
      }

      //disconnect session
      if(isset($_POST['disconnect'])) {
        $this->destroySession();
        header('location: user.php');

      }
      //send email to Admin
      if(isset($_POST['sendEmail'])) {
        $email = $_POST['mail'];
        $subject = $_POST['subject'];
        $messageEmail = $_POST['message'];
        $templateEmail = $this->loadTwig()->loadTemplate('emailAdmin.html.twig');
        $emailUser = $templateEmail->render(array(
          "email" => $email,
          "subject" => $subject,
          "message" => $messageEmail
        ));
  
        $tabEmail = array(
          "email" => "jo.coubertin2024@gmail.com",
          "subject" => $subject,
          "message" => $emailUser
        );
       $sendEmail = $this->sendEmailAdmin($tabEmail);
       if($sendEmail) {
         $sucessMessageSend = "Email send";
       }
      }

      $templateIndex = $this->loadTwig()->loadTemplate('contact.html.twig');
      return $templateIndex->render(array(
        "myMessage" => $message,
        "sucessSignUp" => $messageSignUp,
        "inputErrors" => $tabError,
        "session" => $_SESSION,
        "home" => $this->returnHome(),
        "contact" => $this->returnContact(),
        "activities" => $this->returnActivities(),
        "games" => $this->returnGames(),
        "scoreboard" => $this->returnScoreboard(),
        "sports" => $sports,
        "successSendEmail" => $sucessMessageSend
      ));
    }

    public function checkViewActivities() {
      $message = "";
      $messageSignUp = "";
      $tabError = array();

      //setTable sport for the list
      $this->setTable('sport');
      //select all sports for the list
      $sports = $this->displayMethod-> selectAll();
      //login user
      if(isset($_POST['submit'])) {
        $this->setTable('user');
        sleep(1);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['pswd']);
        //get salt user
        $theSalt = $this->getTheSalt($email);
        //crypted password
        $passwordCrypted = crypt($password, $theSalt['salt']);
        
        $unUtilisateur = $this->staySessionEnable($email, $passwordCrypted);
        /* check fields */
        if($unUtilisateur['mail'] !== $email || !password_verify($password, $unUtilisateur['pswd'])) {
          $message = "error Sign in";
          $tabError[][] = "mail or password invalid";
        }
        /* if no errors */
        if(count($tabError) == 0) {
          //call method for retrevial session
          $this->getSessionCo($unUtilisateur['lastName'], $email, $passwordCrypted);
        }

      }
      //register user
      if(isset($_POST['Su'])) {
        $tabPref = array();
        $thePreferences = "";
        $preferencesUser = $_POST['prf'];
        $repeatPass = $_POST['repeatPass'];
        
        //call method for choised several data in the select
        $myPreference = $this->multipleSelect($tabPref, $thePreferences, $preferencesUser);

        //crypt password
        $salt = md5(uniqid());
        $passwordCrypted = crypt($_POST['password'], $salt);

        $tabInsert = array(
          "firstName" => $_POST['fname'],
          "lastName" => $_POST['lname'],
          "mail" => $_POST['email'],
          "salt" => $salt,
          "active" => '1',
          "pswd" => $passwordCrypted,
          "preference" => $myPreference,
        );
        
        //check Sign up
        if(!password_verify($repeatPass, $passwordCrypted)) {
          $tabError[][] = "the two passwords are not identical";
        }
        if(count($tabError) == 0) {
          $messageSignUp = "Successful registration, you can connect";
          $this->displayMethod-> insertUser($tabInsert);
        }
       
      }

      //disconnect session
      if(isset($_POST['disconnect'])) {
        $this->destroySession();
        header('location: user.php');

      }

      $this->setTable("selectAllActivities");
      if(isset($_GET['labelEvents'])) {
        $fields = array("labelEvents", "descriptions", "dateEvent", "labelMedia", "link", "labelPlace");
        $where = array(
          "labelEvents" => $_GET['labelEvents']
        );

        $selectAActivities = $this->displayMethod-> selectWhere($fields, $where);

        $templateIndex = $this->loadTwig()->loadTemplate('aActivities.html.twig');
        return $templateIndex->render(array(
          "myMessage" => $message,
          "sucessSignUp" => $messageSignUp,
          "inputErrors" => $tabError,
          "session" => $_SESSION,
          "home" => $this->returnHome(),
          "contact" => $this->returnContact(),
          "activities" => $this->returnActivities(),
          "games" => $this->returnGames(),
          "scoreboard" => $this->returnScoreboard(),
          "sports" => $sports,
          "aActivities" => $selectAActivities
        ));
      }
      else {
          $pagination = $this->paginationActivities('2', 'p');
       
    
          $templateIndex = $this->loadTwig()->loadTemplate('activities.html.twig');
          return $templateIndex->render(array(
            "myMessage" => $message,
            "sucessSignUp" => $messageSignUp,
            "inputErrors" => $tabError,
            "session" => $_SESSION,
            "home" => $this->returnHome(),
            "contact" => $this->returnContact(),
            "activities" => $this->returnActivities(),
            "games" => $this->returnGames(),
            "scoreboard" => $this->returnScoreboard(),
            "sports" => $sports,
            "allActivities" => $pagination['results'],
            "nbPage" => $pagination['nbPage']
          ));
        }
    }

    public function checkViewGames() {
      $message = "";
      $messageSignUp = "";
      $tabError = array();
      //setTable sport for the list
      $this->setTable('sport');
      //select all sports for the list
      $sports = $this->displayMethod-> selectAll();
      //login user
      if(isset($_POST['submit'])) {
        $this->setTable('user');
        sleep(1);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['pswd']);
        //get salt user
        $theSalt = $this->getTheSalt($email);
        //crypted password
        $passwordCrypted = crypt($password, $theSalt['salt']);
        
        $unUtilisateur = $this->staySessionEnable($email, $passwordCrypted);
        /* check fields */
        if($unUtilisateur['mail'] !== $email || !password_verify($password, $unUtilisateur['pswd'])) {
          $message = "error Sign in";
          $tabError[][] = "mail or password invalid";
        }
        /* if no errors */
        if(count($tabError) == 0) {
          //call method for retrevial session
          $this->getSessionCo($unUtilisateur['lastName'], $email, $passwordCrypted);
        }

      }
      //register user
      if(isset($_POST['Su'])) {
        $tabPref = array();
        $thePreferences = "";
        $preferencesUser = $_POST['prf'];
        $repeatPass = $_POST['repeatPass'];
        
        //call method for choised several data in the select
        $myPreference = $this->multipleSelect($tabPref, $thePreferences, $preferencesUser);

        //crypt password
        $salt = md5(uniqid());
        $passwordCrypted = crypt($_POST['password'], $salt);

        $tabInsert = array(
          "firstName" => $_POST['fname'],
          "lastName" => $_POST['lname'],
          "mail" => $_POST['email'],
          "salt" => $salt,
          "active" => '1',
          "pswd" => $passwordCrypted,
          "preference" => $myPreference,
        );
        
        //check Sign up
        if(!password_verify($repeatPass, $passwordCrypted)) {
          $tabError[][] = "the two passwords are not identical";
        }
        if(count($tabError) == 0) {
          $messageSignUp = "Successful registration, you can connect";
          $this->displayMethod-> insertUser($tabInsert);
        }
       
      }

      //disconnect session
      if(isset($_POST['disconnect'])) {
        $this->destroySession();
        header('location: user.php');

      }
      $this->setTable("selectAllGames");
      if(isset($_GET['labelEvents'])) {
        $fields = array("labelEvents", "descriptions", "dateEvent", "labelMedia", "link", "labelPlace");
        $where = array(
          "labelEvents" => $_GET['labelEvents']
        );

        $selectAGames = $this->displayMethod-> selectWhere($fields, $where);

        $templateIndex = $this->loadTwig()->loadTemplate('aGames.html.twig');
        return $templateIndex->render(array(
          "myMessage" => $message,
          "sucessSignUp" => $messageSignUp,
          "inputErrors" => $tabError,
          "session" => $_SESSION,
          "home" => $this->returnHome(),
          "contact" => $this->returnContact(),
          "activities" => $this->returnActivities(),
          "games" => $this->returnGames(),
          "scoreboard" => $this->returnScoreboard(),
          "sports" => $sports,
          "aGames" => $selectAGames
        ));
      }
      else {
         
          $pagination = $this->paginationGames('2', 'p');
    
          $templateIndex = $this->loadTwig()->loadTemplate('games.html.twig');
          return $templateIndex->render(array(
            "myMessage" => $message,
            "sucessSignUp" => $messageSignUp,
            "inputErrors" => $tabError,
            "session" => $_SESSION,
            "home" => $this->returnHome(),
            "contact" => $this->returnContact(),
            "activities" => $this->returnActivities(),
            "games" => $this->returnGames(),
            "scoreboard" => $this->returnScoreboard(),
            "sports" => $sports,
            "allGames" => $pagination['results'],
            "nbPage" => $pagination['nbPage']
          ));
        }
      }

    public function checkViewScoreboard() {
      $message = "";
      $messageSignUp = "";
      $tabError = array();
      //setTable sport for the list
      $this->setTable('sport');
      //select all sports for the list
      $sports = $this->displayMethod-> selectAll();
      //login user
      if(isset($_POST['submit'])) {
        $this->setTable('user');
        sleep(1);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['pswd']);
        //get salt user
        $theSalt = $this->getTheSalt($email);
        //crypted password
        $passwordCrypted = crypt($password, $theSalt['salt']);
        
        $unUtilisateur = $this->staySessionEnable($email, $passwordCrypted);
        /* check fields */
        if($unUtilisateur['mail'] !== $email || !password_verify($password, $unUtilisateur['pswd'])) {
          $message = "error Sign in";
          $tabError[][] = "mail or password invalid";
        }
        /* if no errors */
        if(count($tabError) == 0) {
          //call method for retrevial session
          $this->getSessionCo($unUtilisateur['lastName'], $email, $passwordCrypted);
        }

      }
      //register user
      if(isset($_POST['Su'])) {
        $tabPref = array();
        $thePreferences = "";
        $preferencesUser = $_POST['prf'];
        $repeatPass = $_POST['repeatPass'];
        
        //call method for choised several data in the select
        $myPreference = $this->multipleSelect($tabPref, $thePreferences, $preferencesUser);

        //crypt password
        $salt = md5(uniqid());
        $passwordCrypted = crypt($_POST['password'], $salt);

        $tabInsert = array(
          "firstName" => $_POST['fname'],
          "lastName" => $_POST['lname'],
          "mail" => $_POST['email'],
          "salt" => $salt,
          "active" => '1',
          "pswd" => $passwordCrypted,
          "preference" => $myPreference,
        );
        
        //check Sign up
        if(!password_verify($repeatPass, $passwordCrypted)) {
          $tabError[][] = "the two passwords are not identical";
        }
        if(count($tabError) == 0) {
          $messageSignUp = "Successful registration, you can connect";
          $this->displayMethod-> insertUser($tabInsert);
        }
      
      }

      //disconnect session
      if(isset($_POST['disconnect'])) {
        $this->destroySession();
        header('location: user.php');

      }

      $scoreBoard = $this->displayMethod-> selectCountriesMedal();
      /*$idCountries = 0;
      if(isset($_POST['detail'])) {
        $idCountries = $_POST['countries'];
      }*/
      
      $templateIndex = $this->loadTwig()->loadTemplate('scoreboard.html.twig');
        return $templateIndex->render(array(
          "myMessage" => $message,
          "sucessSignUp" => $messageSignUp,
          "inputErrors" => $tabError,
          "session" => $_SESSION,
          "home" => $this->returnHome(),
          "contact" => $this->returnContact(),
          "activities" => $this->returnActivities(),
          "games" => $this->returnGames(),
          "scoreboard" => $this->returnScoreboard(),
          "sports" => $sports,
          "scoreboards" => $scoreBoard,
          //"countries" => $idCountries
        ));
    } 
     
    /* ------- */
    /* ----- methods Ajax ---- */
    public function selectaGames($keys) {
      $aGames = $this->displayMethod-> selectaGames($keys);
      return $aGames;
    }
    public function selectaActivities($keys) {
      $aActivities = $this->displayMethod-> selectaActivities($keys);
      return $aActivities;
    }
    public function selectCompetitorCountries($tabC) {
      $aCompetitorCountries = $this->displayMethod-> selectCompetitorCountries($tabC);
      return $aCompetitorCountries;
    }
    /* -------- */
    //method for multiple select in html
    public function multipleSelect(Array $tab, String $values, $post) {
       //browse the multiple POST
       foreach($post as $value) {
        //Post typed by user go in array
        $tab[] = $value;
        //if data in array to above to 1 add the , between the data in array
        if(count($tab) > 1) {
          $values = implode(',', $tab);
        }
        //else nothing
        else {
          $values = implode('', $tab);
        }
      }
      return $values;
    }
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
    //method go to scorboard
    public function returnScoreboard() {
      $linkReturnScoreBoard = $this->pathUser . "user.php?page=4";
      return $linkReturnScoreBoard;
    }
    // method go to the page contact
    public function returnContact() {
      $linkReturnContact = $this->pathUser . "user.php?page=5";
      return $linkReturnContact;
    }
  /* -------- */
}
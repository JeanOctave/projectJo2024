<?php
  require 'model.php';

  class modelSpecial extends model {

    public function __construct($server, $database, $user, $password) {
      parent::__construct($server, $database, $user, $password); //heritage model
    }

    	// Registration
	    public function creat_user($tab){
	    	$salt = sha1(uniqid(rand()));
	    	$mdpcrypter = crypt($_POST['A'])
	    	$tab = array(
	    		':firstName' => $_POST['A'],
	    		':lastName ' => $_POST['A'],
	    		':mail' => $_POST['A'],
	    		':salt' => $salt,
	    		':active ' => 1,
	    		':pswd ' => $mdpcrypter,
	    		':preference' => $_POST['A']
	    	);

	    	$requete = "call p_add_participant(:firstName, :lastName, :mail, :salt, :active, :pswd, :preference)";
			$insert = $this->pdo->prepare($requete);
			$resultats = $insert->execute($donnees);
			return $resultats;

	    }
  }

 ?>

<?php
  require 'model.php';

  class modelSpecial extends model {

    public function __construct($server, $database, $user, $password) {
      parent::__construct($server, $database, $user, $password); //heritage model
    }

    //method insert table user
    public function insertUser($tab) {
      $data = array(
        ":firstName" => $tab['firstName'],
        ":lastName" => $tab['lastName'],
        ":mail" => $tab['mail'],
        ":salt" => $tab['salt'],
        ":active" => $tab['active'],
        ":pswd" => $tab['pswd'],
        ":preference" => $tab['preference']
      );

      $request = "call checkHeritageForU(:firstName, :lastName, :mail, :salt, :active, :pswd, :preference)";
      $insert = $this->pdo->prepare($request);
      $insert->execute($data);
    }
  }

 ?>

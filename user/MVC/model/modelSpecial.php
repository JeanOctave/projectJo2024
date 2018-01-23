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

    //method filter Games
    public function selectaGames($key) {
      $request = "select labelEvents, link, descriptions from selectAllGames where labelEvents like '".$key['value']."'";
      $select = $this->pdo->prepare($request);
      $select->execute($key);
      $result = $select->fetchAll();

      return $result;
    }
    //method filter Activities
    public function selectAActivities($key) {
      $request = "select labelEvents, link, descriptions from selectAllActivities where labelEvents like '".$key['value']."'";
      $select = $this->pdo->prepare($request);
      $select->execute($key);
      $result = $select->fetchAll();

      return $result;
    }
    //method limit value on page
    public function selectLimit($start, $nbResult) {
      if($this->pdo != null) {
        $request = "select labelEvents, link, descriptions from ".$this->table." limit ".$start.", " .$nbResult.";";
        $select = $this->pdo->prepare($request);
        $select->execute();
        $results = $select->fetchAll();
        return $results;
        } else {
        return null;
      }
    }
  }

 ?>

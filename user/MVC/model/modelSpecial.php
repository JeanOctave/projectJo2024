<?php
  require 'model.php';

  class modelSpecial extends model {

    public function __construct($server, $database, $user, $password) {
      parent::__construct($server, $database, $user, $password); //heritage model
    }
  }

 ?>

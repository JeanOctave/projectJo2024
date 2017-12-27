<?php
require "MVC/model/modelSpecial.php";

class controller {
  private $displayMethod;
  public function __construct($server, $database, $user, $password) {
    $this->displayMethod = new modelSpecial($server, $database, $user, $password);
  }
  /* ---- general method ---*/

  
  /* ---- specific method ----- */

  
}
 ?>
<?php
require "MVC/controller/controller.php";
$controller = new controller('localhost', 'jo2024', 'root', '');
$controller->initSession();
//retrivial data a page
$page = isset($_GET['page']) ? $_GET['page'] : 0;

//switch in page
switch($page) {
    case 1:
      echo $controller->checkViewDefault();
    break;
    case 2:
      echo $controller->checkViewActivities();
    break;
    case 3:
      echo $controller->checkViewGames();
    break;
    case 4:
      echo $controller->checkViewScoreboard();
    break;
    case 5:
      echo $controller->checkViewContact();
    break;
    default:
      echo $controller->checkViewDefault();
}


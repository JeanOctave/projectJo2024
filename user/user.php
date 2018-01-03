<?php
session_start();
require "MVC/controller/controller.php";


$controller = new controller('localhost', 'jo2024', 'root', '');
//retrivial data a page
$page = isset($_GET['page']) ? $_GET['page'] : 0;

//switch in page
switch($page) {
    case 1:
    break;
    case 2:
    break;
    case 3:
    break;
    case 4:
    break;
    default:
       
       echo $controller->checkViewDefault();

}


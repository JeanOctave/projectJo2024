<?php
session_start();
require "MVC/controller/controller.php";
require "loadTwig.php";

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
        $templateIndex = $twig->loadTemplate('user.html.twig');
        echo $templateIndex->render(array());
}


<?php
session_start();
require "MVC/controller/controller.php";
require "loadTwig.php";

$templateIndex = $twig->loadTemplate('user.html.twig');
echo $templateIndex->render(array());
<?php

  require_once __DIR__ . '/vendor/autoload.php';


  $loader = new Twig_Loader_Filesystem('MVC/view'); //folder wich contain the template
  $twig = new Twig_Environment($loader, array(
    'cache' => false,
    'charset' => "utf-8",
    'debug' => true
  ));

  //for enabled the dump in twig = to var_dump in php
  $twig->addExtension(new Twig_Extension_Debug());

  
?>
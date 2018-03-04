<?php
// Load Config
  require_once 'config/config.php';

   // Autoload Core Libraries
  //en lugar de usar el require+once varias veces usamos spl_autoload_register
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  


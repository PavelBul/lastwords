<?php

class Config {
  public $action = '', $force = '';


  public function __construct(){
      function __autoload($className){
          $fileName = $className.".php";
          include_once($fileName);
      }

      $this->action = strtolower($_REQUEST['action']);
      $this->force = strtolower($_REQUEST['force']);
  }

  public function loadView($view, $data = null){
      include("views/".$view.".html");
  }
}

$config = new Config();
?>
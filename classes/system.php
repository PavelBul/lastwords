<?php

class System {
  public $action = '';
  public static $errMsg = array();

  //Загрузка классов
  //action, force

  public function __construct(){
      function __autoload($className){
          $fileName = $className.".php";
          include_once($fileName);
      }

      $this->action = strtolower($_REQUEST['action']);
  }

  //Загрузка видов

  public function loadView($view, $data = null){
      include("views/".$view.".html");
  }

  public static function errorDisplay()
  {
      if (!empty(self::$errMsg[0]))
      {
          foreach (self::$errMsg as $errMsg)
          {
              echo "$errMsg <br>";
          }
      }
  }

}

$system = new System();
?>
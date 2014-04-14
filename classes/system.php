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
      session_start();
  }

  //Загрузка видов

  public function loadView($view, $data = null){
      include("views/".$view.".html");
  }

  //Вывод ошибок
  public static function displayErrors()
  {
      if (!empty(self::$errMsg[0]))
      {
          foreach (self::$errMsg as $errMsg)
          {
              echo "$errMsg <br>";
          }
      }
  }

  public function redirect($url,$sec = 0)
  {
     echo "<meta http-equiv='refresh' content='$sec; url=$url'/>";
  }

}

$system = new System();
$user = new User();
?>
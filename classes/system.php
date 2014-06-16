<?php

class System {
  private $executeTime = 0;

  public $action = '', $l = array();
  public static $errMsg = array();


  //Загрузка классов
  //action
   public function __construct(){
      session_start();
      $this->executeTime = microtime(true);

      function __autoload($className){
          $fileName = $className.".php";
          include_once($fileName);
      }

      $this->action = strtolower($_REQUEST['action']);
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

  public function getMemaryUsage(){
      $size = memory_get_usage();
      $size = $size/1024/1024;
      return $size;
  }

  public function getExecuteTime(){
      return microtime(true) - $this->executeTime;
  }



}

$system = new System();
$user = new User();
$language = new Language();
$l = $language->getWords();

?>
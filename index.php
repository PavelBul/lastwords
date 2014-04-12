<?php
  function __autoload($className){
     $fileName = "classes/".$className.".php";
     include_once($fileName);
  }

  $user = new Users();
  $user->setUserInfo("Pavel","pavel@pavel.ru","asdasd");
  $user->registrNewUser();


?>
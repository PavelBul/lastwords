<?php
  //Личный кабинет пользователя
  require("classes/system.php");

  //Если пользователь не залогинен, нет доступа к этой странице
  if ($user->checkLogin())
    {
        $system->redirect('./index.php');
        exit;
    }

  switch($config->action){

      default:

      break;
   }

?>
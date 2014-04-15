<?php
  require("classes/system.php");

  //Вьюхи
  switch($system->action){
      default:
          echo $user->getId();
          echo $user->getStatus();

          $data['titleText'] = 'Добро пожаловать!';
          $system->loadView('header',$data);
          $system->loadView('index');
          $system->loadView('footer');
      break;
  }


?>
<?php
  require("classes/system.php");
  //Вьюхи
  switch($config->action){
      default:
          $data['titleText'] = 'Добро пожаловать!';
          $system->loadView('header',$data);

          $system->loadView('index');
          $system->loadView('footer');
      break;
  }

?>
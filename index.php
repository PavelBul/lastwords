<?php
  require("classes/config.php");

  switch($config->force){

  }

  switch($config->action){
      default:
          $data['titleText'] = 'Добро пожаловать!';
          $config->loadView('header',$data);

          $config->loadView('index');
          $config->loadView('footer');
      break;

      case 'registration':
          $data['titleText'] = 'Регистрация!';
          $config->loadView('header',$data);

          $config->loadView('registration');
          $config->loadView('footer');
      break;
  }

?>
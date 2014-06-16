<?php
  require("classes/system.php");
  //Вьюхи
  switch($system->action){
      default:

          include('views/header.html');
          include('views/index.html');
          include('views/footer.html');

      break;

      case "setlanguage":
          switch ($_GET['language']){
              case "ru":
                  $language->setLanguage("ru");
              break;

              case "eng":
                  $language->setLanguage("eng");
              break;
          }

          $system->redirect("index.php");
      break;
  }


?>
<?php
  //Личный кабинет пользователя
  require("classes/system.php");
  //Если пользователь не залогинен, нет доступа к этой странице
  if (!$user->checkLogin())
    {
        $system->redirect('./index.php');
        exit;
    }

  switch($system->action){
      default:
          $users = new Users();
          $data = $users->getUserInfo($user->getId());
          if ($user->getStatus() == 0){
              include('views/cabinetconfigs.html');
          } else {
              include('views/cabinet.html');
          }
      break;

      case "setsettings":
          $users = new Users();
          if (!Validation::isEmpty($_POST['userName'])){
             if (Validation::isOnlyText($_POST['userName'])){
                 $users->setUserName($user->getId(),$_POST['userName']);
             } else {
                 System::$errMsg[] = $language->l['eFieldNameOnlyChars'];
             }
          }

          if (!Validation::isEmpty($_POST['userSurname'])){
              if (Validation::isOnlyText($_POST['userSurname'])){
                  $users->setUserSurname($user->getId(),$_POST['userSurname']);
              } else {
                  System::$errMsg[] = $language->l['eFieldSurnameOnlyChars'];
              }
          }

          if (!Validation::isEmpty($_POST['userPatronymic'])){
              if (Validation::isOnlyText($_POST['userPatronymic'])){
                  $users->setUserPatronymic($user->getId(),$_POST['userPatronymic']);
              } else {
                  System::$errMsg[] = $language->l['eFieldPatronymicOnlyChars'];
              }
          }

          if (!Validation::isEmpty($_POST['userOldPass'])){
                  $data = $users->getUserInfo($user->getId());
                  if ($data['user_pass'] == sha1($_POST['userOldPass'])){
                      if (!Validation::isEmpty($_POST['userNewPass']) && !Validation::isEmpty($_POST['userNewPass2'])){
                          if (sha1($_POST['userNewPass']) === sha1($_POST['userNewPass2'])){
                              $users->setUserPassword($user->getId(),sha1($_POST['userNewPass']));
                          } else {
                              System::$errMsg[] = $language->l['eNewPasswordsNotMatch'];
                          }
                      } else {
                          System::$errMsg[] = $language->l['eNewPasswordsEmpty'];
                      }
                  } else {
                      System::$errMsg[] = $language->l['eOldPasswordNotCorrect'];
                  }

          }

          if (!Validation::isEmpty($_POST['secretWord'])){
              $users->setUserSecretWord($user->getId(),sha1($_POST['secretWord']));

          }
          $users->setUserStatus($user->getId(),1);
          $data = $users->getUserInfo($user->getId());

          include('views/header.html');
          include('views/cabinetconfigs.html');
          include('views/footer.html');
      break;
   }

?>
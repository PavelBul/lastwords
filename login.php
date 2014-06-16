<?php
require("classes/system.php");
switch($system->action){
    //Вход
    case 'login':
       $users = new Users();
       if (Validation::isEmpty($_POST['userEmail']) || Validation::isEmpty($_POST['userPass'])){
          System::$errMsg[] = "Важные поля не были заполнены!";
       }

       if (!Validation::validateEmail($_POST['userEmail'])){
          System::$errMsg[] = "Не верно введен email";
       }

       $userID = $users->searchUserByEmailAndPass($_POST['userEmail'],sha1($_POST['userPass']));
       if (!$userID)
       {
          System::$errMsg[] = "Пара логин и пароль не совпадают!";
          include('views/index.html');
       } else {
          $user->setLogin(true);
          $user->setLoginID($userID);
          $user->setUserStatus();
          $users->setUserLoginDate($userID);
          $system->redirect('cabinet.php',0);

       }

    break;

    case 'logout':
        session_destroy();
        $system->redirect('index.php',0);
    break;

    default:
        $system->redirect('./index.php');
    break;
}



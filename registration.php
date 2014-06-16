<?php
require("classes/system.php");
echo $user->getStatus();
if ($user->checkLogin())
{
    $system->redirect('./cabinet.php');
    exit;
}

//Обработчики форм
switch($system->action){

    //Регистрация нового пользователя
    case 'registrnewuser':
        $users = new Users();

        //Валидация данных
        if (validation::isEmpty($_POST['userEmail']) || validation::isEmpty($_POST['userPass1']) || validation::isEmpty($_POST['userPass2'])){
            System::$errMsg[] = $language->l['eAllFields'];
        }

        if ($_POST['userPass1'] != $_POST['userPass2']){
            System::$errMsg[] = 'Пароли не совпадают!';
        } else {
            $userPass = sha1($_POST['userPass1']);
        }

        if (!Validation::validateEmail($_POST['userEmail'])){
            System::$errMsg[] = 'Неверно введен email';
        }

        if ($users->searchUserByEmail($_POST['userEmail']))
        {
            System::$errMsg[] = 'Пользователь с таким Email уже существует!';
        }

        if (System::$errMsg[0]){
            include('views/header.html');
            include('views/registration.html');
            include('views/footer.html');
        } else {
            $userIp = Client::getClientIP();
            if ($users->insertNewUser($_POST['userEmail'],$userPass,$userIp)){
                $user->setLoginID($users->searchUserByEmailAndPass($_POST['userEmail'],$userPass));
                $user->setLogin(true);
                $system->redirect('./cabinet.php');
            } else {
                $system->redirect('./registration.php',0);
            }

        }

    break;

    default:
        include('views/header.html');
        include('views/registration.html');
        include('views/footer.html');
    break;
}


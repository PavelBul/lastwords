<?php
require("classes/system.php");
//Обработчики форм
switch($system->action){

    //Регистрация нового пользователя
    case 'registrnewuser':
        $users = new Users();

        //Валидация данных
        if (validation::isEmpty($_POST['userName']) || validation::isEmpty($_POST['userEmail']) || validation::isEmpty($_POST['userPass1']) || validation::isEmpty($_POST['userPass2'])){
            System::$errMsg[] = 'Обязательные поля были не заполнены!';
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
            $data['titleText'] = 'Регистрация';
            $system->loadView('header',$data);
            $system->loadView('registration',$data);
            $system->loadView('footer',$data);
        } else {
            $userIp = Client::getClientIP();
            if ($users->insertNewUser($_POST['userName'],$_POST['userEmail'],$userPass,$userIp)){
                //Вывод об успешной регистрации
                echo "Регистрация прошла.";
            } else {
                $system->redirect('./registration.php',0);
            }

        }

    break;

    default:
        $data['titleText'] = 'Регистрация';
        $system->loadView('header',$data);
        $system->loadView('registration', $data);
        $system->loadView('footer');

    break;
}



<?php
require("classes/system.php");
//Обработчики форм
switch($system->action){


    //Регистрация нового пользователя
    case 'registrnewuser':
        $user = new Users();

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


        if (System::$errMsg[0]){
            $data['titleText'] = 'Регистрация';
            $system->loadView('header',$data);
            $system->loadView('registration',$data);
            $system->loadView('footer',$data);
        } else {
            $userIp = Client::getClientIP();
            $user->insertNewUser($_POST['userName'],$_POST['userEmail'],$userPass,$userIp);
        }

    break;

    default:
        $data['titleText'] = 'Регистрация';
        $system->loadView('header',$data);
        $system->loadView('registration', $data);
        $system->loadView('footer');
    break;
}



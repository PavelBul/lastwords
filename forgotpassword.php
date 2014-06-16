<?php
require("classes/system.php");
print_r($_SESSION);

if ($user->checkLogin())
{
    $system->redirect('./cabinet.php');
    exit;
}

switch($system->action){
    default:

        include('views/header.html');
        include('views/forgotpassword.html');
        include('views/footer.html');

    break;

    case "forgotpass":
        $users = new Users();

        if (Validation::isEmpty($_POST['userEmail'])){
            System::$errMsg[] = $language->l['eAllFields'];
        }

        if (!Validation::validateEmail($_POST['userEmail'])){
            System::$errMsg[] = $language->l['eEmailFieldNotCorrect'];
        }


        if (!$userID=$users->searchUserByEmail($_POST['userEmail'])){
            System::$errMsg[] = $language->l['eUserWithEmailNotFound'];
        }

        if (System::$errMsg[0]){
            include('views/header.html');
            include('views/forgotpassword.html');
            include('views/footer.html');
        } else {
            //Нет ошибок, отправляем письмо с кодом востановления пароля
            $secretString = $users->userPassReset($userID);
            $data['userEmail'] = Validation::stripTags($_POST['userEmail']);

            //Тут должна быть отправка письма
            //TODO
            include('views/header.html');
            include('views/forgotpasswordsucces.html');
            include('views/footer.html');

        }

    break;

    case "changepassword":
        if (Validation::isEmpty($_GET['ss'])){
            $system->redirect("forgotpassword.php");
            exit;
        }else{
            $users = new Users();
            $rpInfo = $users->getPassResetInfo($_GET['ss']);
            if ($rpInfo['rp_user_id']){
                $user->setLoginID($rpInfo['rp_user_id']);
                $_SESSION['ss'] = $_GET['ss'];
                include('views/header.html');
                include('views/changepassword.html');
                include('views/footer.html');
            } else {
                $system->redirect('index.php');
            }

        }
    break;

    case "resetpassword":
        if (isset($_SESSION['ss'])){
            if (Validation::isEmpty($_POST['newPassword']) || Validation::isEmpty($_POST['newPassword2'])){
               System::$errMsg[] = $language->l['eAllFields'];
            }

            if (sha1($_POST['newPassword']) != sha1($_POST['newPassword2'])){
                System::$errMsg[] = $language->l['ePasswordsNotMatch'];
            }

            if (!System::$errMsg[0]){
                $users = new Users();
                $users->setUserPassword($user->getId(),sha1($_POST['newPassword']));
                $users->unsetUserPassReset($user->getId());
                session_destroy();
                include('views/header.html');
                include('views/forgetpasswordcomplite.html');
                include('views/footer.html');
            }
            else{
                include('views/header.html');
                include('views/changepassword.html');
                include('views/footer.html');
            }
        }else{
            $system->redirect("index.php");
        }
    break;
}


?>
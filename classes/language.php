<?php
//Язык интерфейса

class Language {
    //Язык по дефолту
    private $language = "ru";
    public $l = array();

    function __construct(){
       //Язык интерфейса
       if (isset($_SESSION['language'])) $this->language = $_SESSION['language'];
       $this->words();
   }

   //Возвращает массив с языком
   public function getWords(){
       return $this->l;
   }

   //Значения слов
   private function  words(){
       switch ($this->language){
           case ("ru"):
               $this->l['titleText'] = 'Добро пожаловать!';
               $this->l['registration'] = 'Регистрация';
               $this->l['home'] = 'Главная';
               $this->l['enterUemail'] = 'Введите Ваш email';
               $this->l['enterUpassword'] = 'Введите Ваш пароль';
               $this->l['repeatUpassword'] = 'Повторите пароль';
               $this->l['forgotPassword'] = 'Забыли пароль';
               $this->l['recoverPassword'] = 'Восстановление пароля';
               $this->l['changePassword'] = 'Изменение пароля';
               $this->l['enterNewPassword'] = 'Введите новый пароль';
               $this->l['enterOldPassword'] = 'Введите ваш текущий пароль';
               $this->l['changePasswordComplite'] = 'Вы успешно изменили пароль';
               $this->l['passwordSettings'] = 'Настройки паролей';
               $this->l['complite'] = 'Готово';
               $this->l['enter'] = 'Войти';
               $this->l['logout'] = 'Выход';
               $this->l['save'] = 'Сохранить';
               $this->l['onThisEmail'] = 'На почту';
               $this->l['mailWasSendWithInstructions'] = 'было отправленно письмо с интрукцией по изменению пароля';

               $this->l['userConfigs'] = 'Настройки пользователя';
               $this->l['personalInformation'] = 'Персональная информация';
               $this->l['enterUname'] = 'Введите имя';
               $this->l['enterUsurname'] = 'Введите фамилию';
               $this->l['enterUpatronymic'] = 'Введите отчество';
               $this->l['enterSecretWord'] = 'Введите секретное слово';
               $this->l['secretWord'] = 'Секретное слово';
               //Тексты ошибок
               $this->l['eAllFields'] = "Обязательные поля были не заполнены!";
               $this->l['eEmailFieldNotCorrect'] = "Поле Email введено неверно!";
               $this->l['eUserWithEmailNotFound'] = "Пользователь с таким Емайл не найден!";
               $this->l['ePasswordsNotMatch'] = "Пароли не совпадают!";
               $this->l['eFieldNameOnlyChars'] = "Поле имя, может содержать только буквы!";
               $this->l['eFieldSurnameOnlyChars'] = "Поле фамилия, может содержать только буквы!";
               $this->l['eFieldPatronymicOnlyChars'] = "Поле отчество, может содержать только буквы!";
               $this->l['eOldPasswordNotCorrect'] = "Старый пароль введен не верно!";
               $this->l['eNewPasswordsEmpty']= "Поля новый пароль и поле повторите пароль обязательны для заполнения!";
               $this->l['eNewPasswordsNotMatch']= "Поля новый пароль и поле повторите пароль не совпадают!";
               break;

           case ("eng"):
               $this->l['titleText'] = 'Welcome!';
               $this->l['registration'] = 'Registration';
               $this->l['home'] = 'Home';
               $this->l['enterUemail'] = 'Enter you email';
               $this->l['enterUpassword'] = 'Enter you password';
               $this->l['repeatUpassword'] = 'Repeat you password';
               $this->l['forgotPassword'] = 'Forgot password';
               $this->l['recoverPassword'] = 'Password reset';
               $this->l['complite'] = 'Complite';
               $this->l['enter'] = 'Enter';
               $this->l['logout'] = 'Logout';


               //Errors texts
               $this->l['eAllFields'] = "All fields are required!";
               $this->l['eEmailFieldNotCorrect'] = "The Email entered is incorrect!";
               $this->l['eUserWithEmailNotFound'] = "User with this E-mail was not found!";
               break;
       }
   }

   public function setLanguage($lang){
       $this->language = $lang;
       $_SESSION['language'] = $lang;
   }

   public function getLanguage(){
      return $this->language;
   }
}
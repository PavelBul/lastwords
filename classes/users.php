<?php

class Users {
  private $_userName, $_userEmail, $_userPassword;

  public function registrNewUser()
  {
      if (!empty($this->_userName) && !empty($this->_userEmail) && !empty($this->_userPassword)){
          echo "Новый пользователь зарегистрирован!";
      }
      else {
          echo "Не все поля заполнены!";
      }
  }

  public function  setUserInfo($userName,$userEmail,$userPassword){
      $this->_userName = $userName;
      $this->_userEmail = $userEmail;
      $this->_userPassword = $userPassword;
  }

}

?>
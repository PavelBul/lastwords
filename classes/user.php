<?php
//Класс работы с пользователем

class User {
    private  $login = false, $id = '', $status = '';

    function __construct(){
          if (isset($_SESSION['userID'])) $this->id = $_SESSION['userID'];
          if (isset($_SESSION['userLogin'])) $this->login = $_SESSION['userLogin'];
          if (isset($_SESSION['userStatus'])) $this->status = $_SESSION['userStatus']; else {
              $this->setUserStatus();
          }
    }

    public function checkLogin(){
        return $this->login;
    }

    public function setUserStatus(){
         $query = db::run()->prepare("SELECT `user_status` FROM `lw_users` WHERE id=?");
         $query->bind_param('i',$this->id);
         $query->execute();
         $query->store_result();
         if ($query->num_rows){
             $query->bind_result($status);
             $query->fetch();
             $this->status = $status;
             $_SESSION['userStatus'] = $status;
         } else {
           return false;
         }
    }

    //Пользователь залогинен?
    public function setLogin($var){
        $this->login = $var;
        $_SESSION['userLogin'] = $var;
    }

    //Установка ID пользователя в сесиию
    public function setLoginID($id){
        $this->id = $id;
        $_SESSION['userID'] = $id;
    }

    //Получаем id залогиненого пользователя
    public function getId()
    {
        return $this->id;
    }

    public function getStatus(){
        return $this->status;
    }
}
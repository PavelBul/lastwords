<?php

class Users {

  //Добавление нового пользователя в бд
  public function insertNewUser($userName,$userEmail,$userPass,$userIp = ''){
    $query = db::run()->prepare('INSERT INTO `lw_users` SET user_name=?, user_email=?, user_pass=?, reg_ip=? ');
    $query->bind_param('ssss',$userName,$userEmail,$userPass,$userIp);
    if ($query->execute()) return true; else return false;
  }

  //Поиск пользователя по Email, если пользователь существует возвразает id пользователя
  public function searchUserByEmail($userEmail){
     $query = db::run()->prepare("SELECT id FROM `lw_users` WHERE user_email=? ");
     $query->bind_param('s',$userEmail);
     $query->execute();
     $query->store_result();
     if ($query->num_rows) {
         $query->bind_result($id);
         $query->fetch();
         return $id;
     }
     else{
         return false;
     }
  }



}

?>
<?php

class Users {

  public function insertNewUser($userName,$userEmail,$userPass){
    echo "Пользователь добавлен!";

  }

  //Поиск пользователя по Email
  public function searchUserByEmail($userEmail){
     $query = db::run()->prepare("SELECT id FROM `users` WHERE user_email=?");
     $query->bind_param('s',$userEmail);
     $query->execute();
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
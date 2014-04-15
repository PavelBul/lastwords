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
     } else {
         return false;
     }
  }

  //Поиск пользователя по email
  public function searchUserByEmailAndPass($email,$pass){
      $query = db::run()->prepare("SELECT id FROM `lw_users` WHERE user_email=? AND user_pass=?");
      $query->bind_param('ss',$email,$pass);
      $query->execute();
      $query->store_result();
      if ($query->num_rows){
          $query->bind_result($id);
          $query->fetch();
          return $id;
      } else {
          return false;
      }
  }

  //Установка секретного слова
  public function setUserSecretWord($id,$word){
      $query = db::run()->prepare("UPDATE `lw_users` SET secret_word=? WHERE id=?");
      $query->bind_param('si',$word,$id);
      if ($query->execute()) return true; else return false;
  }

  //Удаление пользователя
  public function deleteUser($id){
      $query = db::run()->prepare("DELETE FROM `lw_users` WHERE id=?");
      $query->bind_param('i',$id);
      if ($query->execute()) return true; else return false;
  }

  //Обновление пароля
  public function updateUserPassword($id,$pass){
      $query = db::run()->prepare("UPDATE `lw_users` SET user_pass=? WHERE id=?");
      $query->bind_param('si',$pass,$id);
      if ($query->execute()) return true; else return false;
  }

  //Обновление статуса пользователя
  public function setUserStatus($id,$status){
      $query = db::run()->prepare("UPDATE `lw_users` SET user_status=? WHERE id=?");
      $query->bind_param("ii",$status,$id);
      if ($query->execute()) return true; else return false;
  }

  //Получение списка пользователей
  public function getUsersList($limit = 20,$desc = false){
      if ($desc) {
          $sql = "SELECT * FROM `lw_users` ORDER BY id DESC LIMIT ?";
      } else {
          $sql = "SELECT * FROM `lw_users` ORDER BY id LIMIT ?";
      }

      $query = db::run()->prepare($sql);
      $query->bind_param("i",$limit);
      $query->execute();
      $result = $query->get_result();
      if (!$result) return false;

      $usersInfo = array();
      while ($row = $result->fetch_assoc()){
          $usersInfo[] = $row;
      }
      return $usersInfo;
  }

  //Получение информации о пользователе
  public function getUserInfo($id){
      $query = db::run()->prepare("SELECT * FROM `lw_users` WHERE id=?");
      $query->bind_param('i',$id);
      $query->execute();
      $result = $query->get_result();
      if (!$result) return false;
      $userInfo = $result->fetch_assoc();
      return $userInfo;
  }

  public function setUserUseSW($id,$use){
      $query = db::run()->prepare("UPDATE `lw_users` SET use_sw=? WHERE id=?");
      $query->bind_param('ii',$use, $id);
      if ($query->execute()) return true; else return false;
  }


}

?>
<?php

class Users {

  //Добавление нового пользователя в бд
  public function insertNewUser($userEmail,$userPass,$userIp = ''){
    $query = db::run()->prepare('INSERT INTO `lw_users` SET  user_email=?, user_pass=?, reg_ip=? ');
    $query->bind_param('sss',$userEmail,$userPass,$userIp);
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

  //Установка имени
  public function setUserName($id, $name){
      $query = db::run()->prepare("UPDATE `lw_users` SET user_name=? WHERE id=?");
      $query->bind_param('si',$name,$id);
      if ($query->execute()) return true; else return false;
  }

  //Установка фамилии
  public function setUserSurname($id, $surname){
      $query = db::run()->prepare("UPDATE `lw_users` SET user_surname=? WHERE id=?");
      $query->bind_param('si',$surname,$id);
      if ($query->execute()) return true; else return false;
  }

  //Установка отчества
  public function setUserPatronymic($id, $patronymic){
      $query = db::run()->prepare("UPDATE `lw_users` SET user_patronymic=? WHERE id=?");
      $query->bind_param('si',$patronymic,$id);
      if ($query->execute()) return true; else return false;
  }

  //обновление даты входа
  public function setUserLoginDate($id){
      $now = date("Y-m-d H:i:s");
      $query = db::run()->prepare("UPDATE `lw_users` SET user_login_date=? WHERE id=?");
      $query->bind_param('si',$now,$id);
      if ($query->execute()) return true; else return false;
  }

  //Обновление пароля
  public function setUserPassword($id,$pass){
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

  //Установка значения, использует ли пользователь секретное слово
  public function setUserUseSW($id,$use){
      $query = db::run()->prepare("UPDATE `lw_users` SET use_sw=? WHERE id=?");
      $query->bind_param('ii',$use, $id);
      if ($query->execute()) return true; else return false;
  }


  //Заявка на востановления пароля
  public function  userPassReset($userID){
      $query = db::run()->prepare("INSERT INTO `lw_reset_password` SET rp_user_id=?, rp_secret_string=?");
      $secretString = sha1(uniqid()).uniqid().sha1(uniqid());
      $query->bind_param('is',$userID,$secretString);
      if ($query->execute()) {
          $query->store_result();
          return $query->insert_id;
      } else return false;
  }

  //Информация о восстановлении пароля
  public function getPassResetInfo($secretString){
      $query = db::run()->prepare("SELECT * FROM `lw_reset_password` WHERE rp_secret_string=?");
      $query->bind_param('s',$secretString);
      if ($query->execute()){
          $result = $query->get_result();
          if (!$result) return false;
          return $result->fetch_assoc();
      } else return false;
  }

  //Удаление заявок пользователя
  public function unsetUserPassReset($userID){
      $query = db::run()->prepare("DELETE FROM `lw_reset_password` WHERE rp_user_id=?");
      $query->bind_param('i',$userID);
      if ($query->execute()) return true; else return false;
  }


}

?>
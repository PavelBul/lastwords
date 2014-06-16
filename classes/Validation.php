<?php
//класс валидаии данных

class Validation {
  public static function validateEmail($email)
  {
      if (filter_var($email,FILTER_VALIDATE_EMAIL)) return true; else return false;
  }

  public static function isEmpty($var){
    $var = trim($var);
    if (empty($var)) return true; else return false;
  }

  public static function stripTags($var){
      return stripcslashes(strip_tags($var));
  }

  public static function isOnlyText($str){
      if (preg_match('/^[a-zA-Zа-яА-ЯёЁчЧрРтТуУфФцЦъЪьЬыЫюЮэЭщЩшШхХ]*$/', $str)) return true; else return false;
  }

  public static  function isOnlyNums($str){
      if (preg_match('/^[0-9]*$/', $str)) return true; else return false;
  }

}

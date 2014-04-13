<?php

class Validation {
  public static function validateEmail($email)
  {
      if (filter_var($email,FILTER_VALIDATE_EMAIL)) return true; else return false;
  }

  public static function isEmpty($var){
    $var = trim($var);
    if (empty($var)) return true; else return false;
  }

}
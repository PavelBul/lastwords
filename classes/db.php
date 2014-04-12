<?php
//Класс работы с базой данных

class db {
   private static $_instance = NULL;
   private static $host = 'localhost', $user = 'root', $password = '', $dbName = 'lastwords';
   private function __construct() {}
   private function __clone() {}

   public static function run(){
       if (self::$_instance == NULL){
           self::$_instance = new mysqli(self::$host,self::$user,self::$password,self::$dbName);
           if (self::$_instance->connect_errno) die("Ошибка подключения к базе данных!");
           self::$_instance->query("SET NAMES utf8");
       }
       return self::$_instance;
   }

   final function __destruct(){
       self::$_instance = NULL;
   }
}

?>
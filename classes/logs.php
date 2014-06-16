<?php
//Логи

class Logs {

  private $fileDir = '../logs/log.txt';

  //Запись произвольной строки в log файл
  public function writeString($text)
  {
      file_put_contents($this->fileDir, PHP_EOL.$text, FILE_APPEND);
  }

}
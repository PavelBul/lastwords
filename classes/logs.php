<?php

class Logs {

  public function zap($text)
  {
     $file = fopen('logs.txt',"a+");
     fwrite($file, $text);
      fclose($file);s
  }

}
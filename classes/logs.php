<?php

class Logs {

  public function zap($text)
  {
     $file = fopen('logs.txt',"wr");
     fwrite($file, $text);
  }

}
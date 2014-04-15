<?php
/**
 * Author: Bpo-scripts.ru
 * Date: 13.04.14
 * Time: 23:51
 * Email: mail@bpo-scripts.ru
 */

class Logs {
$text = "";
$lo = fopen("log.txt","wr");
  function zap()
  {
fwrite($lo, $text);


  }

}
<?php

class Conexao{

  public static $instance;

  public static function getConexao(){
    if(!isset(self::$instance)){
      self::$instance = new PDO("mysql:host=localhost;dbname=presentes","root","");
      self::$instance->setAttribute(PDO:ATR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } return self::$instance;
  }
}

?>
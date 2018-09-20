<?php

class Connection{

  private static $_instance;

  private static function ___construct($host,$dbname,$dbuser,$dbpwd) {
    new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpwd);
  }

  public static function getInstance(){

    self::$_instance= new Connection(HOST,DB_NAME,DB_USER,DB_PWD);
    return self::$_instance;
  }
}

?>

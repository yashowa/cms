<?php

class Connection {

  public  static $_instance;
  private $_host;
  private $_dbname;
  private $_dbuser;
  private $_dbpwd;

  public static function ___construct($host,$dbname,$dbuser,$dbpwd) {

    $this->_dbname=$dbname;
    $this->_user=$dbuser;
    $this->_dbpwd=$dbpwd;
    //return new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpwd);
  }

  public static function getInstance(){

  //  var_dump($toto);

    //var_dump(self::$_instance);

    try {
      $co = new PDO("mysql:host=".HOST.";dbname=".DB_NAME, DB_USER, DB_PWD,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
     self::$_instance = $co;
     return $co;
  }
}

?>

<?php
Class Router
{
  public $_status;

  public static function setStatus(bool $value){
    $this->$_status=$value;
  }
  public static function routes($list){

    return $list;

  }
  function ___construct(){

  }

  public static function getRoutes($co){
    //return array('test'=>"pouet");
    $routes = $co->query("SELECT * FROM `deb_page`");
    $routes->setFetchMode(PDO::FETCH_OBJ);
    $resultats=array();
    while( $resultat = $routes->fetch() )
    {
        $resultats[]=$resultat;
    }
    return $resultats;
  }

  public static function getCurrentRoute(){
    return $_SERVER['REQUEST_URI'];
  }
}
?>

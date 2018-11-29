<?php


class BaseController
{

  private $_page_name;
  public $_connexion;
  public static $_querystring;

/*
*get $routes
* get the routes cms in database
params : connexion PDO object to local //table
*/
  public function getRoutes(){
        self::$querystring=$_SERVER['REQUEST_URI'];
      $this->_connexion = Connection::getInstance();
      return  Router::getRoutes($this->_connexion);
  }

  public function ___construct(){
    $this->_connexion = Connection::getInstance();
  }


  public function index(){

  }

  /*
  method render get the template file to view the pagen
  * params: string template name and params
  */
  public function render($tpl, $params=null){
    //echo 'render du basecontroller incluera'.ROOT."/views/".$tpl;
    include(ROOT.'//views//'.$tpl);
  }

/*
setter page name from controller
* params: string name of page
*
*/
  public function setPageName($name){
    $this->$_page_name = $name;
  }

  /*getter page name  from controller*/
  public function getPageName(){
    return $this->$_page_name;
  }


  public function getPageLink($page){
    echo'lol';
  }

  static function pageNotFound($error=null){
      include(ROOT.'/views/404.php');
  }
}

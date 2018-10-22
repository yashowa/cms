<?php


class BaseController
{

  private $_page_name;
  public $_connexion;

/*
*get $routes
* get the routes cms in database
params : connexion PDO object to local //table
*/
  public function getRoutes(){
      $this->_connexion = Connection::getInstance();
      return  Router::getRoutes($this->_connexion);
  }

  public function ___construct(){
      $this->_connexion = Connection::getInstance();
  }


  public function index(){

  }

  /*
  method render get the template file to view the page
  * params: string template name and params
  */
  public function render($tpl, $params=null){
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
}

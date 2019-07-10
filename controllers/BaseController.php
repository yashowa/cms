<?php
session_start();

class BaseController
{

  private $_page_name;
  public $_connexion;
  public $_querystring;
  public $action;
  public $table;

/*
*get $routes
* get the routes cms in database
params : connexion PDO object to local //table
*/
  public function getRoutes(){
      return Router::getRoutes($this->_connexion);
  }
  public function  getAdminRoutes(){
      return Router::getSortedAdminRoutes($this->_connexion);
  }

  public function __construct(){
    $this->_querystring=$_SERVER['REQUEST_URI'];
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
    include('views/'.$tpl);
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

  public static function isValid($field,$format){

      if($field==""){
         return false;
      }

      switch ($format){
          case 'password':
          return true;
              break;
          case 'name':
          return true;
              break;
          case 'email':
          return true;
              break;
          case 'profile':
          return true;
          break;
          case 'email':
          return true;
          break;
          case 'small text':
          if (strlen($field)<=72){
            return true;
          }
          break;
      }
      return false;

  }

}

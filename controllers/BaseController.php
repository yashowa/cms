<?php

class BaseController
{

  private $_page_name;

  public function ___construct(){

  }
  public function index(){
    $this->render('home.php');
  }

  public function render($tpl, $params=null){
    include(ROOT.'//views//'.$tpl);
  }

  public function setPageName($name){
    $this->$_page_name = $name;
  }
  public function getPageName(){
    return $this->$_page_name;
  }
}

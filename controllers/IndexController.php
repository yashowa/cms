<?php

class IndexController
{

  public function ___construct(){
    var_dump($_SESSION);
    echo 'lol';
  }
  public function index(){
    $this->render('home.php');
  }

  public function render($tpl){
    include(ROOT.'//views//'.$tpl);
  }
}

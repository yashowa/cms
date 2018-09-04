<?php

class IndexController extends BaseController
{

  public function ___construct(){

  //  $this->setPageName('')

  }

  public function index(){

    $params=array(
      'page_name'=>"Accueil",
    );

    $this->render('home.php',$params);
  }


}

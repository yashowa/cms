<?php

class IndexController extends BaseController
{

  public function index(){
    $params=array(
      'page_name'=>"Accueil",
      'routes'=>$this->getRoutes()
    );

    $this->render('home.php',$params);
  }

}

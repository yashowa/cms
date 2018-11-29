<?php

class PageController extends BaseController
{

  public function index(){
    $params=array(
      'page_name'=>"Page",
      'routes'=>$this->getRoutes(),
      'content'=>'Lorem ipsum'
    );
    $this->render('page.php',$params);
  }

  public function test(){
    echo 'lol';
    exit;
  }
  public function getPageName(){
    $page= $this->getRoutes();

  }

}

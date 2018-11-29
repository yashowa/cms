<?php

class PageController extends BaseController
{

  public function index(){
    echo parent::_querystring;
    $params=array(
      'page_name'=>"Page",
      'routes'=>$this->getRoutes(),
      'content'=>$this->getPageInfosFromAlias()
    );
    $this->render('page.php',$params);
  }

  public function test(){
    echo 'lol';
    exit;
  }
  public function getPageInfosFromAlias($alias){
    $pages = $this->getRoutes();
    foreach($pages as $page ){
      if($page->alias == $alias){
        return $page;
      }
      continue;
    }
  }
}

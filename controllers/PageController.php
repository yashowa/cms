<?php

class PageController extends BaseController
{
  public function index(){
    $alias =explode('/',$this->_querystring)[2];
    $pageDatas = $this->getPageInfosFromAlias($alias);
    $params=array(
      'page_name'=>"$pageDatas->name",
      'routes'=>$this->getRoutes(),
      'content'=>$pageDatas->content
    );
    $this->render('page.php',$params);
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

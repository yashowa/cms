<?php

class DashboardController extends BaseController
{
  public function index(){

    $alias =explode('/',$this->_querystring)[2];
    $pageDatas = $this->getPageInfosFromAlias($alias);
    $params=array(
      'page_name'=>"Espace d'administration",
      'routes'=>$this->getAdminRoutes()
    );
      $this->render('admin/home.php',$params);
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

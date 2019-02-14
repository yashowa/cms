<?php



class AdminUserController extends BaseController{

  public function index(){


    $alias =explode('/',$this->_querystring)[2];
    var_dump($alias);
    exit;
    $pageDatas = $this->getPageInfosFromAlias($alias);
    $params=array(
      'page_name'=>"$pageDatas->name",
      'routes'=>$this->getAdminRoutes(),
      'content'=>$pageDatas->content
    );
    $this->render('admin/page.php',$params);
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

 ?>

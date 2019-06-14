<?php



class AdminUserController extends BaseController{

  public function index(){


    $alias =explode('/',$this->_querystring)[2];
    $action =explode('/',$this->_querystring)[3];

    //var_dump($alias);

    $pageDatas = $this->getPageInfosFromAlias($alias);
    $params=array(
      'page_name'=>"$pageDatas->name",
      'routes'=>$this->getAdminRoutes(),
      'content'=>$pageDatas->content,
      'users'=>UserController::getList()
    );

    $this->render('admin/users.php',$params);
  }

  public function getPageInfosFromAlias($alias){
    $pages = $this->getAdminRoutes();
    foreach($pages as $page ){
      if($page->alias == $alias){
        return $page;
      }
      continue;
    }
  }
  public function add(){

  }
  public function delete($userId){

  }
  public function update($userId){

  }

}

 ?>

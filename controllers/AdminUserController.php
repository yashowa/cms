<?php


/*
class AdminUserController
role gestion and crud of users admin in website
*/
class AdminUserController extends BaseController{

  public function index(){
$parsedQueryString=explode('/',$this->_querystring);

      $alias =explode('/',$this->_querystring)[2];

      $pageDatas = $this->getPageInfosFromAlias($alias);
      echo"<pre>";
      var_dump($pageDatas);
      echo "</pre>";
      $params=array(
        'page_name'=>$pageDatas->name,
        'routes'=>$this->getAdminRoutes(),
        'content'=>$pageDatas->content,
        'users'=>UserController::getList()
      );

if (count($parsedQueryString) >=4){
      $action =explode('/',$this->_querystring)[3];
}
      //var_dump($alias);


    if(method_exists($this,$action)){

        $this->$action();
    }elseif ($action=="new") {
      $params['page_name']="Nouvel utilisateur";
      $params['submit']="Ajouter l'utilisateur";
      $params['url'] = "/admin/user/add";
      $this->render('/admin/user-form.php',$params);

    }elseif ($action =="edit" || (int)$action!=0) {

      $params['page_name']="Modifier l'utilisateur";
      $params['submit']=$params['page_name'];
      $params['user'] = UserController::getUser($action);
      $params['url'] = "admin/user/update";
      $this->render('admin/user-form.php',$params);
    } else {
      $this->render('admin/users.php',$params);
    }
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
      UserController::create($_POST);
      //var_dump($_POST);
      header('Location:/admin/user');
  }
  public function delete($userId){

  }
  public function update($userId){
  UserController::update($_POST);
  }
}

 ?>

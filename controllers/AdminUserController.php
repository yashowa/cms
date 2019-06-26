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
     /* echo"<pre>";
      var_dump($pageDatas);
      echo "</pre>";*/

      $params=array(
        'page_name'=>$pageDatas->name,
        'routes'=>$this->getAdminRoutes(),
        'content'=>isset($pageDatas->content)?$pageDatas->content:"",
        'users'=>UserController::getList()
      );

    if (count($parsedQueryString) >=4){ //s'il y'a une action de decrite dans l'url
        $action =explode('/',$this->_querystring)[3];
    //var_dump($alias);
        if(method_exists($this,$action)){
          $this->$action();
        }elseif ($action=="new") {
          $params['page_name']="Nouvel utilisateur";
          $params['submit']="Ajouter l'utilisateur";
          $params['url'] = "/admin/user/add";
          $this->render('/admin/user-form.php',$params);
        }elseif ($action =="edit" || (int)$action!=0) {// si l'action est un userid on passe en mode edition de l'user

            $user = UserController::getUser($action);
            $params['page_name']="Modifier l'utilisateur";
            $params['submit']=$params['page_name'];
            $params['user'] = $user;
            $params['url'] = "/admin/user/".$user['id_user']."/update";

            if(count($parsedQueryString)>4 && $parsedQueryString[4]=='update'){

                $update = $this->update($user['id_user']);
                if(isset($update['errors'])){
                  $params['errors'] = $update['errors'];
                }else{
                  $params['user'] =  UserController::getUser($action);
                  $params['success'] = "Mise à jour de l'utilisateur ".$user['firstname'] ."effectuée avec succès";
                }
            }
            elseif(count($parsedQueryString)>4 && $parsedQueryString[4]=='delete'){

                $delete = $this->delete($user['id_user']);

                if(isset($delete['errors'])){
                  return  json_encode($delete['errors']);
                }else{

                    $params['user'] =  UserController::getUser($action);
                    $params['success'] = "Suppression de l'utilisateur ".$user['firstname'] ."effectuée avec succès";
                    return  json_encode($params);
                }
            }
          $this->render('admin/user-form.php',$params);
        }
      } else {
        $this->render('admin/users.php',$params);
        echo'ok';
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
  /*method add
  *role delete user
  */
  public function add(){
      UserController::create($_POST);
      //var_dump($_POST);
      header('Location:/admin/user');
  }
  /*method delete
  @param userId
  *role delete user
  */
  public function delete($userId){
        return UserController::delete($userId);
  }
  public function update($userId){
      return UserController::update($_POST,$userId);
  }
}

 ?>

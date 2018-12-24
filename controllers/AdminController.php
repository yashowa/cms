<?php


class AdminController extends BaseController
{

  public function index(){
    //verification de la _connexion
    if (!UserController::isAuth()){
      $this->render('admin/form-login.php');
    }
    $params=array(
      'page_name'=>"Espace d'administration",
      'routes'=>$this->getRoutes()
    );

//var_dump($params);
    $this->render('admin/home.php',$params);
  }
}


?>

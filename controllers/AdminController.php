<?php


<<<<<<< HEAD
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


=======
/*
  admin controller
$this->getRoutes()*/
class AdminController extends BaseController{


 public function index(){
   if(AuthController::isLogged()){
         header('Location:view/admin/index.php');
   }else{
         $params=array(
           'page_name'=>"Login",
           'routes'=>$this->getRoutes(),
         );
         $this->render('login.php',$params);
   }
 }

 /*
 this method renders views from admin folder and override baseController*/

}
>>>>>>> 592a913fb42c84635744d994f613df8c45a3c9d8
?>

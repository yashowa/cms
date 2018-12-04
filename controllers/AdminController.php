<?php


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
?>

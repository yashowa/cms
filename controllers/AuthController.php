<?php


class AuthController extends BaseController{

  public static function isLogged(){
     if(isset($_SESSION['user'])){
        return  true;
     }
     return false;
  }
}

 ?>

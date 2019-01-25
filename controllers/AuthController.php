<?php
session_start();


class AuthController extends BaseController{

  public static function isLogged(){
    var_dump($_SESSION);
     if(isset($_SESSION['user'])){
        return  true;
     }
     return false;
  }
}

 ?>

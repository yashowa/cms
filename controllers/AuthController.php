<?php


/*
class AuthController
check authentication of user logged or not
*/

class AuthController extends BaseController{

  public static function isLogged(){
    //var_dump($_SESSION);
     if(isset($_SESSION['user'])){
        return  $_SESSION['user'];
     }
     return false;

  }
}

 ?>

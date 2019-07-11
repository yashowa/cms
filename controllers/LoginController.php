<?php

class LoginController extends BaseController
{
  public function index(){

    $action =explode('/',$this->_querystring)[2];
    echo $action.'<br>';
    $this->connect($action,$_POST);

    $params=array(
      'page_name'=>"Connexion",
        'routes'=>$this->getSortedAdminRoutes(),
    );
    $this->render('login.php',$params);
  }

public function connect($type,$datas){


}

}

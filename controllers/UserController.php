<?php



class UserController extends BaseController
{
  public function index(){

    $params=array(
      'page_name'=>"Accueil",
      'routes'=>$this->getRoutes()
    );

//var_dump($params);
    $this->render('home.php',$params);
  }

  public static function isConnected(){
 return false;
  }
  public static function isAuth(){
    return false;
  }
}

?>

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

var_dump($_POST);
      $result =Connection::getInstance()->query('SELECT * FROM deb_users' );
      $result->setFetchMode(PDO::FETCH_OBJ);

    //return true;
    return false;
  }
}

?>

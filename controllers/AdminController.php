<?php
session_start();



class AdminController extends BaseController
{

  public $method;
  public function index(){
    //verification de la _connexion

    //echo $this->_querystring;

    if (AuthController::isLogged()){
      $params=array(
        'page_name'=>"Espace d'administration",
        'routes'=>$this->getRoutes()
      );
          $this->render('admin/home.php',$params);
          exit;
    }else{

      $queryStringArray = explode('/',$this->_querystring);
      //exit;
      var_dump($queryStringArray);
      if(count($queryStringArray)>2 && $queryStringArray[2]!=""){
        $action = $queryStringArray[2];
        $method = $action;
        echo "methode: ". $action;
        if(method_exists($this,$action)){
          echo 'methode oki';
          $this->$action();//){
            //die('ok');
        //  }else{

          //};
        }else{
            die('methoode exist pas ');
        }
      }else{
        header('Location:/admin/login');
      }

    }







//var_dump($params);

//header('Location:/admin/login');
      //  return $this->render('admin/form-login.php');
  }

  public function login(){
  //  die('loooooooooooooooo');

    $email = $_POST['email'];
    $passwd=$_POST['password'];
var_dump($_POST);
if(isset($email)&& $email!='' && isset($passwd) & $passwd!=''){

}else{

               $this->render('admin/form-login.php');
}

$sql="SELECT * FROM deb_users WHERE email='$email' AND passwd='$passwd'";

    $co = Connection::getInstance()->query($sql);
    $co->setFetchMode(PDO::FETCH_OBJ);
    $result=$co->fetch();
    if(count($result)>0){
        $_SESSION['user'] = $result;
        var_dump($result);
        exit;
    }else{
      trigger_error('Conexion failed');
    }
  }

  public function logout(){
    unset($_SESSION['user']);
  }
}

?>

<?php
session_start();



class AdminController extends BaseController
{

  public $method;
  public function index(){
    //verification de la _connexion

//echo $this->_querystring;
$queryStringArray = explode('/',$this->_querystring);
var_dump($queryStringArray);
//exit;


var_dump($queryStringArray);
if(count($queryStringArray)>2 && $queryStringArray[2]!=""){
  $action = $queryStringArray[2];
  $method = $action;
  echi $action;
  exit;
  echo "methode: ". $action;
  if(get_class_methods($this,$action)){
    if($this->$action()){

    }else{
      return $this->render('admin/form-login.php');
    };
  }

}else{
  header('Location:/admin/login');
}

  if (AuthController::isLogged()){
    $params=array(
      'page_name'=>"Espace d'administration",
      'routes'=>$this->getRoutes()
    );
        $this->render('admin/home.php',$params);

        exit;

    }


//var_dump($params);

//header('Location:/admin/login');
      //  return $this->render('admin/form-login.php');
  }

  public function login(){

    $email = $_POST['email'];
    $passwd=$_POST['passwd'];
die('login');

    $co = Connection::getInstance()->query("SELECT * FROM deb_users WHERE `email`=$email'. AND `paswd`=.$paswd" );
    $co->setFetchMode(PDO::FETCH_OBJ);
    $result=$co->fetch();
    if(count($result)>0){
        $_SESSION['user'] = $result;
        return $result;
    }else{
      trigger_error('Conexion failed');
    }
  }

  public function logout(){
    unset($_SESSION['user']);
  }
}

?>

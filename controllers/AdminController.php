<?php
//session_start();

class AdminController extends BaseController
{


  public $method;
  public function index(){
    //verification de la _connexion


    //echo $this->_querystring;

      $queryStringArray = explode('/',$this->_querystring);

      var_dump($queryStringArray);

      if(!AuthController::isLogged() && $queryStringArray[2]!='login'){
        header('Location:/admin/login');
      }


      if($queryStringArray[2]!=""){
        $action=$queryStringArray[2];


$cl =ucfirst($action).'Controller';
var_dump(method_exists($this,$action));
echo($cl);
var_dump(interface_exists('Admin'.ucfirst($action).'Controller',true));
echo 'li';
var_dump(($action=='dashboard'));
echo'la';
exit;
        if(method_exists($this,$action)){
          $this->$action();
          die ('merd');
        }elseif(interface_exists('Admin'.ucfirst($action).'Controller')) {
          die("exist");
          $className = 'Admin'.ucfirst($action).'Controller';
          $class = new $className();
        }elseif($action=='dashboard') {
          die('dash');
          $className = ucfirst($action).'Controller';
          die($className);
          $class = new $className();

        }else{
          die('other');
            header('Location:/pageNotFound/');
        }
      }else{
        die('lol');
      }
      /*exit;
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
      }
*/
      // si il ya une methode derrier
    /*  if($queryStringArray[1]=='admin'){
        if (AuthController::isLogged()){
          // on redirige soit vers la methode soit vers le controlleur associé

          $params=array(
            'page_name'=>"Espace d'administration",
            'routes'=>$this->getAdminRoutes()
          );
              $this->render('admin/home.php',$params);
        }
        header('Location:/admin/');
      }

    if (AuthController::isLogged()){
      if($queryStringArray[2]=='admin'){
        header('Location:/admin/');
      }
          //exit;
    }else{

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
*/

/*
      $params=array(
        'page_name'=>"Espace d'administration",
        'routes'=>$this->getAdminRoutes()
      );
          $this->render('admin/home.php',$params);
*/
//var_dump($params);

//header('Location:/admin/login');
      //  return $this->render('admin/form-login.php');
  }

  public function login(){

    if (isset($_POST['email']) && isset( $_POST['password'])){
        $email = $_POST['email'];
        $passwd=$_POST['password'];
      }

    var_dump($_POST);
    if(isset($email)&& $email!='' && isset($passwd) & $passwd!=''){
          $sql="SELECT * FROM deb_users WHERE email='$email' AND passwd='".md5($this->encrypt($passwd))."'";
        echo $sql;

       echo "<br>".md5($this->encrypt($passwd,KEY_PWD));

          $co = Connection::getInstance()->query($sql);
          $co->setFetchMode(PDO::FETCH_OBJ);
          $result=$co->fetch();
          if($result){
              //if(count($result)>0){}
              $_SESSION['user'] = $result;
                          header('Location:/admin/dashboard');
          }else{
            $error ="erreur de connexion, login ou mot de passe erronné";
            $params['error'][]=$error;
            trigger_error('Connexion failed');
                     $this->render('admin/form-login.php',$params);
          }
    }else{
      var_dump($params);
         $this->render('admin/form-login.php',$params);
    }

  }

  public function logout(){
    unset($_SESSION['user']);
  }

  private function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
  }

  private function decrypt($encrypted_string, $encryption_key) {
      $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
      return $decrypted_string;
  }
}

?>

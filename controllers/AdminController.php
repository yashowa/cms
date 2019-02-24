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
      }else{
          // $this->render('admin/form-login.php',$params);
          // si on est connecté avec une action definie
        if($queryStringArray[2]!="" &$queryStringArray[2]!='dashboard'){
            $action=$queryStringArray[2];
            $cl =ucfirst($action).'Controller';
            echo "la methode $action renvoie \n";
            var_dump(method_exists($this,$action));
            echo "nom du controller \n";
            echo($cl);
          //  var_dump(interface_exists('Admin'.ucfirst($action).'Controller',true));
          //  exit;
          // sinon on est redirigé vers e tableau de bord
        }else{
              $action='dashboard';
                      //header('Location:/admin/dashboard');
        }

        if(method_exists($this,$action)){
          $this->$action();
        }elseif($action!='dashboard'){
          $className = 'Admin'.ucfirst($action).'Controller';
          $class = new $className();
          $class->index();
        }else{

          $className = ucfirst($action).'Controller';
          $class = new $className();
          $class->index();
        }
    }
}

  public function login(){

    if (isset($_POST['email']) && isset( $_POST['password'])){
        $email = $_POST['email'];
        $passwd=$_POST['password'];
      }

      $params=array(
        'page_name'=>"Deb CMS ",
      );
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

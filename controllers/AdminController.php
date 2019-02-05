<?php
//session_start();



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
              var_dump($result);
              exit;
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
    exit;

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

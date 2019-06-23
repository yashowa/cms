<?php
/*
class AdminController
role: gestion of website Administration*/
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
        if(isset($queryStringArray[2]) && $queryStringArray[2]!="" && $queryStringArray[2]!='dashboard'){
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

    if(isset($email)&& $email!='' && isset($passwd) & $passwd!=''){
          $sql="SELECT * FROM deb_users WHERE email='$email'";
      //AND passwd='".$this->encrypt($passwd)."'";
        echo $sql;
          echo "<br>";

       //echo "<br>".md5($this->encrypt($passwd,KEY_PWD));

          $co = Connection::getInstance()->query($sql);
          $co->setFetchMode(PDO::FETCH_OBJ);
          $result=$co->fetch();
      echo"<pre>";
          var_dump($result);
      echo"</pre>";
          if($result && password_verify($passwd,$result->passwd)){
              //if(count($result)>0){}
              echo "success";
              $_SESSION['user'] = $result;
              header('Location:/admin/dashboard');
          }else{
            $error ="erreur de connexion, login ou mot de passe erronné";
            $params['error'][]=$error;
            trigger_error('Connexion failed');
                     $this->render('admin/form-login.php',$params);
          }
    }else{
            echo"<pre>";
      var_dump($params);
            echo"</pre>";
         $this->render('admin/form-login.php',$params);
    }
  }
  public function logout(){
    unset($_SESSION['user']);
      header('Location:/admin');
  }
}

?>

<?php
class UserController extends BaseController
{
    public function index()
    {

        $params = array(
            'page_name' => "Accueil",
            'routes' => $this->getRoutes()
        );

//var_dump($params);
        $this->render('home.php', $params);
    }

    public static function isConnected()
    {
        return false;
    }

    public static function isAuth()
    {

        var_dump($_POST);
        $result = Connection::getInstance()->query('SELECT * FROM deb_users');
        $result->setFetchMode(PDO::FETCH_OBJ);

        //return true;
        return false;
    }

    public static function getList()
    {
        $list = array();
        $result = Connection::getInstance()->query('SELECT firstname, lastname,email, id_profile,id_user FROM deb_users');

        while ($row = $result->fetch()) {
            $list[] = $row;
        }
        if (!$list) {
            die ('problème de connexion');
        }
        return $list;
    }

    public static function getUser($id)
    {
        $result = Connection::getInstance()->query('SELECT firstname, lastname,email, id_profile,id_user,passwd FROM deb_users WHERE id_user = ' . $id);
        $user = $result->fetch();
        return $user;
    }

    public static function create($user){

        var_dump($user);
        $profile = $user['profile'];
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $email = $user['email'];
        $password = password_hash($user['password'],PASSWORD_DEFAULT);
        echo'<pre>';
        var_dump(password_verify($user['password'],$password));
        echo'</pre>';
        $last_connexion = date("Y-m-d H:i:s");
        $last_update = date("Y-m-d H:i:s");
        $sql = "INSERT INTO deb_users VALUES (0,'$profile','$firstname','$lastname','$email','$password','$last_connexion','$last_update')";

        Connection::getInstance()->query($sql);
    }

    public static function update($user , $userId){

        $userToUpdate = self::getUser($userId);
        echo "<pre>";
        var_dump($user);
        echo"</pre>";

        $errors=array();
        $password =  $userToUpdate['passwd'];
        if($user['password'] != $userToUpdate['passwd']){
            $password = (new self)->isValid(password_hash($user['password'],PASSWORD_DEFAULT));
        }

        if(!(new self)->isValid($user['profile'],'profile')){
          $errors[]="Vous n'avez pas sélectionné de rôle";
        }
        if(!(new self)->isValid($user['firstname'],'name')){
            $firstname = $user['firstname'];
            $errors[]="Prénom incorrect";
        }
        if(!(new self)->isValid($user['lastname'],'name')){
            $lastname = $user['lastname'];
            $errors[]="Nom de famille incorrect";
        }
        if(!(new self)->isValid($user['email'],'email')){
            $errors[]="Format d'adresse email incorrect";
        }

        if(count($errors)>0){
          return array(
            "errors"=> $errors
          );
        }

        $last_connexion = date("Y-m-d H:i:s");
        $last_update = date("Y-m-d H:i:s");

        $sql = "UPDATE deb_users SET id_profile='?',firstname='?',lastname='?',email='?',passwd='?',last_connexion='?',last_update='?'";
        $q = Connection::getInstance()->prepare($sql);
        $data = array($user['profile'],$user['firstname'],$user['lastname'],$user['email'],$password,$last_connexion,$last_update);
        /*$sql = "UPDATE `deb_users` ";
        $sql.= "SET id_profile=".$user['profile'].",firstname="."'".$user['firstname']."'".",lastname="."'".$user['lastname']."'".",email="."'".$user['email']."'".",passwd="."'".$password."'".",last_connexion="."'".$last_connexion."'".",last_update="."'".$last_update."'";
        $sql.="WHERE id_user =$userId";
        echo $sql;*/
        var_dump($q);
        exit;
        $q->execute($data);

        //exit;
    }

    public function isValid($field,$format){

        if($field==""){
           return false;
        }

        switch ($format){
            case 'password':
            return true;
                break;
            case 'name':
            return true;
                break;
            case 'email':
            return true;
                break;
            case 'profile':
            return true;
            break;
            case 'email':
            return true;
            break;
        }

    }
}



?>

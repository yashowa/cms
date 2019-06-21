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
        $result = Connection::getInstance()->prepare('SELECT firstname, lastname,email, id_profile,id_user FROM deb_users');
        $result->execute();

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
        $list=array();
        $result = Connection::getInstance()->prepare('SELECT firstname, lastname,email, id_profile,id_user,passwd FROM deb_users WHERE id_user = :id');
        $result->bindValue(":id",$id,PDO::PARAM_STR);
        $result->execute();
        return $result->fetch();
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

        var_dump($userToUpdate);
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

        // On cherche s'l y'a deserreurs dans les champs du formulaire
        if(count($errors)>0){
          return array(
            "errors"=> $errors
          );
        }


        echo "\n requete lancee";
        var_dump($user);
        $last_update = date("Y-m-d H:i:s");

        $sql = 'UPDATE deb_users SET id_profile=:profile,firstname=:firstname,lastname=:lastname,email=:email,passwd=:password,last_update=:lastupdate WHERE id_user =:userId';
//$sql="SELECT * FROM deb_page";


            $pdo = new PDO('mysql:host=127.0.0.1;dbname=games', 'root', 'albalogic');
            $q = $pdo->prepare($sql);
            $q->bindValue(':profile', (int)$user['profile'], PDO::PARAM_INT);
            $q->bindValue(':firstname', $user['firstname'], PDO::PARAM_STR);
            $q->bindValue(':lastname', $user['lastname'], PDO::PARAM_STR);
            $q->bindValue(':email', $user['email'], PDO::PARAM_STR);
            $q->bindValue(':password', $password, PDO::PARAM_STR);
            $q->bindValue(':lastupdate', $last_update, PDO::PARAM_STR);
            $q->bindValue(':userId', (int)$userToUpdate['id_user'], PDO::PARAM_INT);


            $q->execute();

            return $q;

            $q->debugDumpParams();


        /*if($q->execute($datas)){
            return array(
                "status"=>"success",
                "message"=>"la mise à jour  du compte de ".$userToUpdate['firstname']." ".$userToUpdate['lastname']." a été effectuée avec succès"
            );
        }else{

            $errors[]="Une erreur est sur venue lors de la mise à jour  du compte de ".$userToUpdate['firstname']." ". $userToUpdate['lastname'];
            return $errors;

        };*/
        /*$sql = "UPDATE `deb_users` ";
        $sql.= "SET id_profile=".$user['profile'].",firstname="."'".$user['firstname']."'".",lastname="."'".$user['lastname']."'".",email="."'".$user['email']."'".",passwd="."'".$password."'".",last_connexion="."'".$last_connexion."'".",last_update="."'".$last_update."'";
        $sql.="WHERE id_user =$userId";
        echo $sql;*/
        //var_dump($q);
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

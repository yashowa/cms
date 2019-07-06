<?php
class UserController extends BaseController
{
    public function index()  {
        $params = array(
            'page_name' => "Accueil",
            'routes' => $this->getRoutes()
        );
        $this->render('home.php', $params);
    }

    public static function isConnected(){
        return false;
    }

    public static function isAuth(){

        //var_dump($_POST);
        $result = Connection::getInstance()->query('SELECT * FROM deb_users');
        $result->setFetchMode(PDO::FETCH_OBJ);
        //return true;
        return false;
    }

    public static function getList(){
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

    public static function getUser($id)  {
        $list=array();
        $result = Connection::getInstance()->prepare('SELECT firstname, lastname,email, id_profile,id_user,passwd FROM deb_users WHERE id_user = :id');
        $result->bindValue(":id",$id,PDO::PARAM_STR);
        $result->execute();
        return $result->fetch();
    }

    public static function create($user){


        $profile = $user['profile'];
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $email = $user['email'];
        $password = password_hash($user['password'],PASSWORD_DEFAULT);
        $errors=[];

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

        $sql = "INSERT INTO deb_users VALUES (0,:profile,:firstname,:lastname,:email,:password,:last_connexion,:last_update)";
        $req =Connection::getInstance()->prepare($sql);
        $req->bindValue(':profile',$profile,PDO::PARAM_STR);
        $req->bindValue(':firstname',$firstname,PDO::PARAM_STR);
        $req->bindValue(':lastname',$lastname,PDO::PARAM_STR);
        $req->bindValue(':email',$email,PDO::PARAM_STR);
        $req->bindValue(':password',$password,PDO::PARAM_STR);
        $req->bindValue(':last_connexion',$last_connexion,PDO::PARAM_STR);
        $req->bindValue(':last_update',$last_update,PDO::PARAM_STR);

       if($req->execute()){
          return array(
            "status"=>"success",
            "message"=>"la création du compte a été effectuée avec succès"
          );
        }else{
          $errors[]="Une erreur est sur venue lors de la création du compte";
          return $errors;
        };

        //$req->execute();
      //Connection::getInstance()->query($sql);
    }

    public static function update($user , $userId){


        $userToUpdate = self::getUser($userId);
        $errors=array();
        $password =  $userToUpdate['passwd'];

        if($user['password'] != $userToUpdate['passwd']){
            $password = (new self)->isValid(password_hash($user['password'],PASSWORD_DEFAULT),'password');
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

        $last_update = date("Y-m-d H:i:s");
        $sql = 'UPDATE deb_users SET id_profile=:profile,firstname=:firstname,lastname=:lastname,email=:email,passwd=:password,last_update=:lastupdate WHERE id_user =:userId';

        $q = Connection::getInstance()->prepare($sql);
        $q->bindValue(':profile', $user['profile'], PDO::PARAM_STR);
        $q->bindValue(':firstname', $user['firstname'], PDO::PARAM_STR);
        $q->bindValue(':lastname', $user['lastname'], PDO::PARAM_STR);
        $q->bindValue(':email', $user['email'], PDO::PARAM_STR);
        $q->bindValue(':password', $password, PDO::PARAM_STR);
        $q->bindValue(':lastupdate', $last_update, PDO::PARAM_STR);
        $q->bindValue(':userId', $userToUpdate['id_user'], PDO::PARAM_STR);
          //s  $q->execute();
        if($q->execute()){
            return array(
                "status"=>"success",
                "message"=>"la mise à jour du compte de ".$userToUpdate['firstname']." ".$userToUpdate['lastname']." a été effectuée avec succès"
            );
        }else{
            $errors[]="Une erreur est sur venue lors de la mise à jour  du compte de ".$userToUpdate['firstname']." ". $userToUpdate['lastname'];
            return $errors;
        };
    }

    public static function delete($id){
      $sql = "DELETE FROM deb_users WHERE id_user=:user";
      $req= Connection::getInstance()->prepare($sql);
      $req->bindValue(":user",$id,PDO::PARAM_STR);
      $req->execute();

      if($req->rowCount()>0){
          return array(
              "status"=>"success",
              "message"=>"le compte ".$id."a été supprimé avec succès"
          );
      }else{
          $errors[]="Une erreur est sur venue lors de la suppression du compte ".$id;
          return $errors;
      }
    }

}
?>

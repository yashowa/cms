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
        var_dump($userToUpdate);
        exit;

        if($user['password'] != $userToUpdate['passwd']){
            $password = (new self)->isValid(password_hash($user['password'],PASSWORD_DEFAULT));
        }
        $profile = (new self)->isValid($user['profile']);
        $firstname = (new self)->isValid($user['firstname']);
        $lastname = (new self)->isValid($user['lastname']);
        $email = (new self)->isValid($user['email']);
        $sql = "UPDATE FROM deb_users SET (id_profile=$profile,firstname=$firstname,lastname=$lastname,email=$email,passwd=$password,last_connexion=$last_connexion,last_update=$last_update) WHERE id_user = ".$userId;
        echo $sql;
        exit;
    }

    public function isValid($field){

        if($field!=""){
           return false;
        }

        switch ($field){
            case 'password':
                break;
            case 'firstname':
                break;
            case 'lastname':
                break;
            case 'email':
                break;
        }

    }
}



?>

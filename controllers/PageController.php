<?php

class PageController extends BaseController
{
  public function index(){
    $alias =explode('/',$this->_querystring)[2];
    $pageDatas = $this->getPageInfosFromAlias($alias);
    $params=array(
      'page_name'=>"$pageDatas->name",
        'routes'=>$this->getSortedAdminRoutes(),
      'content'=>$pageDatas->content
    );
    $this->render('page.php',$params);
  }

  public function getPageInfosFromAlias($alias){
    $pages = $this->getRoutes();
    foreach($pages as $page ){
      if($page->alias == $alias){
        return $page;
      }
      continue;
    }
  }

  public static function getList(){
      $list = array();
      $result = Connection::getInstance()->prepare('SELECT id, name,alias,published FROM deb_pages');
      $result->execute();

      while ($row = $result->fetch()) {
          $list[] = $row;
      }
      if (!$list) {
          die ('problème de connexion');
      }
      return $list;
  }

  public static function getPage($id){

      $result = Connection::getInstance()->prepare('SELECT name, alias,content, published,id,category FROM deb_pages WHERE id = :id');
      $result->bindValue(":id",$id,PDO::PARAM_STR);
      $result->execute();
      return $result->fetch();

  }

  public static function create($page){


      $published  = $page['published'];
      $name       = $page['name'];
      $alias      = $page['alias'];
      $content    = $page['content'];
      $category   = 0;

      if(isset($page['category'])){
        $category =$page['category'];
      }

      $errors=[];

      if(!(new self)->isValid($page['published'],'profile')){
        $errors[]="Vous n'avez pas sélectionné de satut de publication";
      }
      if(!(new self)->isValid($page['name'],'small text')){
          $name = $page['name'];
          $errors[]="Titre de page incorrect (limité à 72 caractères espaces inclus)";
      }


      if(count($errors)>0){
        return array(
          "errors"=> $errors
        );
      }

      $date_creation = date("Y-m-d H:i:s");
      $last_update = date("Y-m-d H:i:s");

      $sql = "INSERT INTO deb_pages VALUES (0,:name,:alias,:content,:published,:category,:date_creation,:last_update)";
      $req =Connection::getInstance()->prepare($sql);
      $req->bindValue(':name',$name,PDO::PARAM_STR);
      $req->bindValue(':alias',$alias,PDO::PARAM_STR);
      $req->bindValue(':content',$content,PDO::PARAM_STR);
      $req->bindValue(':published',$published,PDO::PARAM_STR);
      $req->bindValue(':category',$category,PDO::PARAM_STR);
      $req->bindValue(':date_creation',$date_creation,PDO::PARAM_STR);
      $req->bindValue(':last_update',$last_update,PDO::PARAM_STR);

     if($req->execute()){
        return array(
          "status"=>"success",
          "message"=>"la création de la page a été éffectuée avec succès"
        );
      }else{
        $errors[]="Une erreur est sur venue lors de la création de la page";
        return $errors;
      };

      //$req->execute();
    //Connection::getInstance()->query($sql);
  }

  public static function update($page , $pageId){


      $$pageToUpdate = self::getUser($pageId);
      $errors=array();


      if(!(new self)->isValid($page['published'],'published')){
        $errors[]="Vous n'avez pas sélectionné d'etat de publication";
      }
      if(!(new self)->isValid($page['name'],'name')){
          $name = $page['name'];
          $errors[]="Titre de page incorrect ou trop long";
      }
      if(!(new self)->isValid($page['alias'],'alias')){
          $lastname = $page['lastname'];
          $errors[]="format alias incorrect ou vide";
      }


      // On cherche s'l y'a deserreurs dans les champs du formulaire

      if(count($errors)>0){
        return array(
          "errors"=> $errors
        );
      }

      $last_update = date("Y-m-d H:i:s");
      $sql = 'UPDATE deb_pages SET published=:published,firstname=:firstname,lastname=:lastname,email=:email,passwd=:password,last_update=:lastupdate WHERE id_user =:userId';

      $q = Connection::getInstance()->prepare($sql);
      $q->bindValue(':profile', $page['profile'], PDO::PARAM_STR);
      $q->bindValue(':firstname', $page['firstname'], PDO::PARAM_STR);
      $q->bindValue(':lastname', $page['lastname'], PDO::PARAM_STR);
      $q->bindValue(':email', $page['email'], PDO::PARAM_STR);
      $q->bindValue(':password', $password, PDO::PARAM_STR);
      $q->bindValue(':lastupdate', $last_update, PDO::PARAM_STR);
      $q->bindValue(':userId', $pageToUpdate['id_user'], PDO::PARAM_STR);
        //s  $q->execute();
      if($q->execute()){
          return array(
              "status"=>"success",
              "message"=>"la mise à jour du compte de ".$pageToUpdate['firstname']." ".$pageToUpdate['lastname']." a été effectuée avec succès"
          );
      }else{
          $errors[]="Une erreur est sur venue lors de la mise à jour  du compte de ".$pageToUpdate['firstname']." ". $pageToUpdate['lastname'];
          return $errors;
      };
  }

  public static function delete($id){
    $sql = "DELETE FROM deb_pages WHERE id=:page";
    $req= Connection::getInstance()->prepare($sql);
    $req->bindValue(":page",$id,PDO::PARAM_STR);
    $req->execute();

    if($req->rowCount()>0){
        return array(
            "status"=>"success",
            "message"=>"la page ".$id."a été supprimée avec succès"
        );
    }else{
        $errors[]="Une erreur est sur venue lors de la suppression de la page ".$id;
        return $errors;
    }
  }

}

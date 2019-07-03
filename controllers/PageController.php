<?php

class PageController extends BaseController
{
  public function index(){
    $alias =explode('/',$this->_querystring)[2];
    $pageDatas = $this->getPageInfosFromAlias($alias);
    $params=array(
      'page_name'=>"$pageDatas->name",
      'routes'=>$this->getRoutes(),
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
      $result = Connection::getInstance()->prepare('SELECT id, name,alias,published FROM deb_page');
      $result->execute();

      while ($row = $result->fetch()) {
          $list[] = $row;
      }
      if (!$list) {
          die ('problème de connexion');
      }
      return $list;
  }

  public static function create($page){

var_dump($page);
exit;
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

      $sql = "INSERT INTO deb_page VALUES (0,:name,:alias,:content,:published,:category,:date_creation,:last_update)";
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
          "message"=>"la création de la page a été effectuée avec succès"
        );
      }else{
        $errors[]="Une erreur est sur venue lors de la création de la page";
        return $errors;
      };

      //$req->execute();
    //Connection::getInstance()->query($sql);
  }
}

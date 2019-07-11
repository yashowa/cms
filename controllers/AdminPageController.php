<?php


/*
class AdminPageController
role gestion and crud of pages admin in website
*/
class AdminPageController extends BaseController{

  public $params;

  public function index(){

      $parsedQueryString=explode('/',$this->_querystring);

      $alias =explode('/',$this->_querystring)[2];

      $pageDatas = $this->getPageInfosFromAlias($alias);
     /* echo"<pre>";
      var_dump($pageDatas);
      echo "</pre>";*/

      $params=array(
        'page_name'=>$pageDatas->name,
        'routes'=>$this->getSortedAdminRoutes(),
        'content'=>isset($pageDatas->content)?$pageDatas->content:"",
        'pages'=>PageController::getList()
      );

    if (count($parsedQueryString) >=4){ //s'il y'a une action de decrite dans l'url
        $action =explode('/',$this->_querystring)[3];
    //var_dump($alias);
        if(method_exists($this,$action)){
          $this->$action();
          $params['errors']="non";
        }elseif ($action=="new") {// mode create page
          $params['page_name']="Nouvelle page";
          $params['submit']="Ajouter la page";
          $params['url'] = "/admin/page/add";
          unset($_SESSION["notification"]);
          unset($_SESSION["notification_count"]);
          $this->render('/admin/page-form.php',$params);
        }elseif ($action =="edit" || (int)$action!=0) {// si l'action est un pageid on passe en mode edition de la page

            $page = PageController::getPage($action);
            $params['page_name']="Modifier la page";
            $params['submit']=$params['page_name'];
            $params['page'] = $page;
            $params['url'] = "/admin/page/".$page['id']."/update";
            if(isset($_SESSION['notification']) && isset($_SESSION["notification_count"])){
              if($_SESSION["notification_count"]==0){
                  unset($_SESSION["notification"]);
                  unset($_SESSION["notification_count"]);
              }
            }


            if(count($parsedQueryString)>4 && $parsedQueryString[4]=='update'){

                $update = $this->update($page['id']);
                if(isset($update['errors'])){
                  $params['errors'] = $update['errors'];
                }else{
                  $params['page'] =  PageController::getPage($action);
                  $params['success'] = "Mise à jour de la page ".$page['name'] ." effectuée avec succès";
                }
                if($_SESSION["notification_count"]==0){
                    unset($_SESSION["notification"]);
                    unset($_SESSION["notification_count"]);
                }
            }
            elseif(count($parsedQueryString)>4 && $parsedQueryString[4]=='delete'){


                    unset($_SESSION["notification"]);
                    unset($_SESSION["notification_count"]);

                $delete = $this->delete($page['id']);

                if(isset($delete['errors'])){
                 echo json_encode($delete['errors']);

                }else{

                    $params['page'] =  PageController::getPage($action);
                    $params['success'] = "Suppression de la page ".$page['name'] ." effectuée avec succès";
                    echo json_encode($params);
                }
                exit;
            }
          $this->render('admin/page-form.php',$params);
        }
      } else {
        if(isset($_SESSION['notification']) && isset($_SESSION["notification_count"])){
            if($_SESSION["notification_count"]==0){
                unset($_SESSION["notification"]);
                unset($_SESSION["notification_count"]);
            }elseif($_SESSION["notification_count"]>=1)
                $_SESSION["notification_count"] =  $_SESSION["notification_count"] -1;
        }

        $this->render('admin/pages.php',$params);




      }
  }

  public function getPageInfosFromAlias($alias){
    $pages = $this->getAdminRoutes();
    foreach($pages as $page ){
      if($page->alias == $alias){
        return $page;
      }
      continue;
    }
  }
  /*method add
  *role delete page
  */
  public function add(){
    echo json_encode(PageController::create($_POST));
  }
  /*method delete
  @param PAgeId
  *role delete page
  */
  public function delete($pageId){
        return PageController::delete($pageId);
  }
  public function update($pageId){
        $_SESSION["notification"]= PageController::update($_POST,$pageId);
              $_SESSION["notification_count"]=1;
            header('Location:/admin/page');
  }

  public function upload(){
      //return json_encode(array("msg"=>"success"));
    $url = array(
        "http://localhost"
    );
    reset($_FILES);
    $temp = current($_FILES);

    if (is_uploaded_file($temp['tmp_name'])) {
        if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
            header("HTTP/1.1 400 Invalid file name,Bad request");
            return;
        }

        // Validating File extensions
        if (! in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array(
            "gif",
            "jpg",
            "png"
        ))) {
            header("HTTP/1.1 400 Not an Image");
            return;
        }

        $fileName = "uploads/" . $temp['name'];
        move_uploaded_file($temp['tmp_name'], $fileName);

        // Return JSON response with the uploaded file path.
        echo json_encode(array(
            'file_path' => $fileName
        ));
    }

  }
}

 ?>

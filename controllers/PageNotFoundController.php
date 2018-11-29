<?php

class PageNotFoundController extends BaseController
{

  public function index(){
    $params=array(
      'page_name'=>"Page non trouvée",
      'routes'=>$this->getRoutes(),
      'content'=>'Lorem ipsum'
    );

    $this->render('404.php',$params);
  }

}

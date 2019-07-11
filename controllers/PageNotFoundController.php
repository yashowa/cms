<?php

class PageNotFoundController extends BaseController
{

  public function index(){
    $params=array(
      'page_name'=>"Page non trouvée",
        'routes'=>$this->getSortedAdminRoutes(),
      'content'=>'Lorem ipsum'
    );

    $this->render('404.php',$params);
  }

}

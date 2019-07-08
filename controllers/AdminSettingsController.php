<?php
/**
 * Created by PhpStorm.
 * User: jnicolas
 * Date: 08/07/19
 * Time: 12:43
 */

class AdminSettingsController extends BaseController
{

    public function index(){

        $parsedQueryString=explode('/',$this->_querystring);

        $alias =explode('/',$this->_querystring)[2];

        $pageDatas = $this->getPageInfosFromAlias($alias);
        /* echo"<pre>";
         var_dump($pageDatas);
         echo "</pre>";*/

        $params=array(
            'page_name'=>$pageDatas->name,
            'routes'=>$this->getAdminRoutes(),
            'content'=>isset($pageDatas->content)?$pageDatas->content:"",
        );

        $this->render('admin/settings.php',$params);

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
}
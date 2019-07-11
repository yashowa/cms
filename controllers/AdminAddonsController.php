<?php
/**
 * Created by PhpStorm.
 * User: jnicolas
 * Date: 11/07/19
 * Time: 15:39
 */

class AdminAddonsController extends BaseController
{
    public function index(){

        $parsedQueryString=explode('/',$this->_querystring);

        $alias =explode('/',$this->_querystring)[2];

        $pageDatas = $this->getPageInfosFromAlias($alias);
        $params=array(
            'page_name'=>$pageDatas->name,
            'routes'=>$this->getSortedAdminRoutes(),
            'content'=>isset($pageDatas->content)?$pageDatas->content:"",
        );
        $this->render('admin/addons.php',$params);

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
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
            'addons'=>$this->getAddons()
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


    public function getAddons(){

        $req = "SELECT * FROM deb_addons";
        $result = Connection::getInstance()->prepare($req);
        $result->execute();
        $listmodules=array();

        while($addons = $result->fetch()){
            $listmodules[$addons['name']]=$addons;
        };

        $tmpDirectory = ROOT.'/addons';
        echo $tmpDirectory;

        $modules =array();

        if ($handle = opendir($tmpDirectory)) {
            // Ceci est la façon correcte de traverser un dossier.
            while (false !== ($entry = readdir($handle))) {
                if( $entry!='.' && $entry!='..'){

                    if(key_exists($entry,$listmodules)){
                        $isInstalled['is_installed']=false;

                        if($listmodules[$entry]['is_active']){
                            $modules[$entry]=array(
                                'is_installed'    => true
                            );
                        }
                        $modules[$entry]=array_merge(
                            $listmodules[$entry],
                            $isInstalled
                        );
                    }else{
                        $modules[$entry]=array(
                            is_installed    => false
                        );
                    }
                }
            }
            closedir($handle);
        }
        return $modules;
    }


    public function uninstallAddon($id){

    }

}
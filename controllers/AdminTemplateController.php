<?php
/**
 * Created by PhpStorm.
 * User: jnicolas
 * Date: 12/07/19
 * Time: 11:09
 */

class AdminTemplateController extends BaseController
{
    public function index(){

        $parsedQueryString=explode('/',$this->_querystring);

        $alias =explode('/',$this->_querystring)[2];

        $pageDatas = $this->getPageInfosFromAlias($alias);
        $params=array(
            'page_name'=>$pageDatas->name,
            'routes'=>$this->getSortedAdminRoutes(),
            'content'=>isset($pageDatas->content)?$pageDatas->content:"",
            'templates'=>$this->getTemplates()
        );

        $this->getTemplates();
        $this->render('admin/templates.php',$params);



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
    public function getTemplates(){

        $tmpDirectory = ROOT.'/templates';
        echo $tmpDirectory;

        $modules =array();

        if ($handle = opendir($tmpDirectory)) {
            echo "Gestionnaire du dossier : $handle\n";
            echo "Entrées :\n";

            // Ceci est la façon correcte de traverser un dossier.
            while (false !== ($entry = readdir($handle))) {
                $modules[]=$entry;
            }

            closedir($handle);
        }
        return $modules;
    }

    /*method load
     * load template from database and ftp*/
    public static function load(){

        $query = "SELECT * FROM deb_templates WHERE is_active=:active ";
        $req = Connection::getInstance()->prepare($query);
        $req->bindValue(':active',1,PDO::PARAM_INT);
        $req->execute();
        $template = $req->fetch();
        $rootPath = ROOT.'/templates/'.$template['rootpath'];


        // list of file required
        $templateFileList = array('header.php','footer.php','page.php');

        foreach ($templateFileList as $file){
            if(!file_exists($rootPath.'//'.$file)){
                die($rootPath.'//'.$file ." manquant");
            }
        }

        return array(
            'rootpath'  =>  $rootPath,
            'datas'     =>  $template
        );



    }

}
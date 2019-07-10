<?php
Class Router
{
  public $_status;

  public static function setStatus(bool $value){
    $this->_status=$value;
  }
  public static function routes($list){

    return $list;

  }
  function ___construct(){

  }

  public static function getRoutes($co){
    //return array('test'=>"pouet");
    $routes = $co->query("SELECT * FROM `deb_pages`");
    $routes->setFetchMode(PDO::FETCH_OBJ);
    $resultats=array();
    while( $resultat = $routes->fetch() )
    {
        $resultats[]=$resultat;
    }
    return $resultats;
  }

    public static function getAdminRoutes($co){
        //return array('test'=>"pouet");
        $routes = $co->query("SELECT * FROM `deb_adminpage`");
        $routes->setFetchMode(PDO::FETCH_OBJ);
        $resultats=array();
        while( $resultat = $routes->fetch() )
        {
            $resultats[]=$resultat;
        }
        return $resultats;
    }

    public static function getSortedAdminRoutes($co){

        $submenus=array();
        $menus=array();

        $reqSubmenus = $co->query("SELECT * FROM `deb_adminpage` WHERE  submenu != 0");
        $reqSubmenus->setFetchMode(PDO::FETCH_OBJ);
        while( $submenu = $reqSubmenus->fetch() )
        {
            $submenus[]=$submenu;
        }

        $reqMenus = $co->query("SELECT * FROM `deb_adminpage` WHERE  submenu = 0");
        $reqMenus->setFetchMode(PDO::FETCH_OBJ);
        while( $menu = $reqMenus->fetch() )
        {
            $menus[]=$menu;
        }

        $adminNav = array();

        foreach($menus as $k => $menu){

            $adminNav[$k]=$menu;
            foreach($submenus as $submenu){

                if($submenu->submenu==$menu->id){
                    $adminNav[$k]->subnav[] =$submenu;
                }
            }
        }
        return $adminNav;
    }

  public static function getCurrentRoute(){
    return $_SERVER['REQUEST_URI'];
  }
}
?>

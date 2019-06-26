<?php
//var_dump($_SERVER);
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('PATHCONTROLLER',dirname(__FILE__).'/controllers/');

require(dirname(__FILE__).'//Core//Connection.php');
require(dirname(__FILE__).'//Core//Router.php');
require(dirname(__FILE__).'/params//config.php');
//include_once PATHCONTROLLER.'BaseController.php';

$uri = $_SERVER['REQUEST_URI'];

spl_autoload_register(function ($class_name) {
  //echo PATHCONTROLLER.$class_name . '.php'."<br>";
//  echo "<p>chargement du controller ".PATHCONTROLLER.$class_name . ".php</p>";
  try{
    if (!file_exists(PATHCONTROLLER.$class_name . '.php')){

      $page =new PageNotFoundController();
      $page->index();
      exit;
    }
    include_once PATHCONTROLLER.$class_name . '.php';
  } catch (Exception $e) {
      //echo $e->getMessage(). "\n"."class inexistante";
  }
});

/*get data base elem*/

$connection = Connection::getInstance();
$routes = Router::getRoutes($connection);
$lol="rr";


//echo "url saisie: ".$uri."<br>";
if($uri!="/"){
    //on cherche l'action et le controllers
    $uriParsed = explode('/',$uri);
    //var_dump($uriParsed);
    $controller = $uriParsed[1];
    $class= ucfirst($uriParsed[1]);

    $count = count($uriParsed);
    if($count>2){
    $action = $uriParsed[2];
}
$controllerName= ucfirst($uriParsed[1]).'Controller';
$controllerFile = $controllerName.'.php';

//echo $action;
//echo'lllllllllllllllllll';

  //var_dump($controllerName);


  $app = new $controllerName() ;//or die("error 404");

  $app->index();
exit;
  $methods= get_class_methods($app);
  //$app->index();
//var_dump($methods);
/*  if (!class_exists($controllerName, false)) {
    trigger_error("Impossible de charger la classe : $controllerName", E_USER_WARNING) ;

  //  die("error 404");
  header('Location: /pageNotFound');
  // $app = new PageNotFoundController();
  // $app->index();
  }else {
    $app = new $controllerName() or die("error 404");
  }
*/


try {
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

}else{
  $app =new IndexController();
  $app->index();

}

?>

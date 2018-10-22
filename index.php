<?php
//var_dump($_SERVER);
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('PATHCONTROLLER',dirname(__FILE__).'/controllers/');

require(dirname(__FILE__).'//Core//Connection.php');
require(dirname(__FILE__).'//Core//Router.php');
require(dirname(__FILE__).'/params//config.php');

$uri = $_SERVER['REQUEST_URI'];
var_dump($uri);
spl_autoload_register(function ($class_name) {
  //echo $class_name;
    include PATHCONTROLLER.$class_name . '.php';
});

/*get data base elem*/

$connection = Connection::getInstance();
$routes = Router::getRoutes($connection);
$lol="rr";

//echo "url saisie: ".$uri."<br>";
if($uri!="/"){

  $uriParsed = explode('/',$uri);
  var_dump($uriParsed);
  $controllerName= $uriParsed[1];
  var_dump($controllerName);

  $controller= ucfirst($controllerName).'Controller.php';
  var_dump(class_exists(ucfirst($controllerName).'Controller', false));
  var_dump($controller);


  if (!class_exists($class, false)) {
    trigger_error("Impossible de charger la classe : $class", E_USER_WARNING) ;
    //die("error 404");
  }
  $app = new $controller_name() or die("error 404");

}else{
  $app =new IndexController();
  $app->index();
}

?>

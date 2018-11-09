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
  echo PATHCONTROLLER.$class_name . '.php';
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
  $class= ucfirst($uriParsed[1]);
  $controllerName= ucfirst($uriParsed[1]).'Controller';
  var_dump($controllerName);

  $controllerFile= $controllerName.'.php';

  var_dump(class_exists('IndexController', false));

  var_dump(class_exists('PageController', false));

  var_dump(class_exists($controllerName, false));
  var_dump($controllerFile);

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
$v=4;
/*try {
    $app = new $controllerName();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}*/

try {
    $v = 1;
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

}else{
  $app =new IndexController();
  $app->index();
}

?>

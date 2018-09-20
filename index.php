<?php
//var_dump($_SERVER);
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('PATHCONTROLLER',ROOT.'//controllers//');

require(dirname(__FILE__).'/Core/Connection.php');
require(dirname(__FILE__).'/params/config.php');

$uri = $_SERVER['REQUEST_URI'];
var_dump($uri);
spl_autoload_register(function ($class_name) {
    include PATHCONTROLLER.$class_name . '.php';
});


/*get data base elem*/

$connection = Connection::getInstance();
var_dump($connection->query("SELECT * from deb_page"));


echo "url saisie: ".$uri."<br>";
if($uri!="/"){

  $controller_name = explode('/',$uri);
  //var_dump($controller_name);
  $controller= ucfirst($controller_name[1]).'Controller.php';
  var_dump(class_exists($class, false));
  var_dump($controller);
  if (!class_exists($class, false)) {
    trigger_error("Impossible de charger la classe : $class", E_USER_WARNING) ;
    die("error 404");
  }
  $app = new $controller_name() or die("error 404");
}else{

  $app =new IndexController();
  $app->index();
}

?>

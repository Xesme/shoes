<?php
date_default_timezone_set("America/Los_Angeles");
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/Store.php";
require_once __DIR__."/../src/Brand.php";

// link datatbase
$server = 'mysql:host=localhost:8889;dbname=shoes';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

// new silex
$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

// use Symfony\Component\HttpFoundation\Request;
//     Request::enableHttpMethodParameterOverride();

$app->get('/', function() use($app)
{   $stores = Store::getAll();
    return $app['twig']->render('index.html.twig', array( 'stores' => $stores ));
});

$app->post("/add/store", function() use($app){
    $id = null;
    $store = new Store($_POST['name'], $id);
    $store->save();
    $stores = Store::getAll();

    return $app['twig']->render('index.html.twig', array('stores' => $stores));
});

$app->get("/store/{id}", function($id) use($app){
    $id = null;
    $store = new Store($_POST['name'], $id);
    $store->save();
    $stores = Store::getAll();
    return $app['twig']->render('store.html.twig', array('stores' => $stores));
});




// return the app
return $app;
 ?>

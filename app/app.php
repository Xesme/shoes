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

use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

$app->get('/', function() use($app)
{   $stores = Store::getAll();
    return $app['twig']->render('index.html.twig', array( 'stores' => $stores ));
});

    //  CRUD for Store
$app->post("/add/store", function() use($app){
    $store = new Store($_POST['name'], $store_id);
    $store->save();
    $stores = Store::getAll();

    return $app['twig']->render('index.html.twig', array('stores' => $stores));
});

$app->get("/store/{id}", function($id) use($app){
    $stores = Store::getAll();
    $store_name = Store::getStoreById($id);
    return $app['twig']->render('store.html.twig', array('stores' => $store_name));
});

$app->patch("/patch/{id}", function($id) use($app){
    $stores = Store::getAll();
    $store = Store::getStoreById($id);
    $store->update($_POST['name']);
    return $app['twig']->render('store.html.twig', array( 'store' => $store, 'stores' => $stores));
});


$app->delete('/delete/store/{id}', function($id) use($app){
    $store = Store::getStoreById($id);
    $store->delete();
    $stores = Store::getAll();
    return $app['twig']->render('index.html.twig', array('stores' => $stores));
});

    // CRUD for Brand
$app->post("/add/brand", function() use($app){
    $brand = new Brand($_POST['brand_name'], $brand_id);
    $brand->save();
    $brands = Brand::getAll();
    return $app['twig']->render('index.html.twig', array('brands' => $brands));
});

// return the app
return $app;
 ?>

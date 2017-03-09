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
    $brands = Brand::getAll();
    return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands ));
});

    //  CRUD for Store
$app->post("/add/store", function() use($app){
    $store = new Store($_POST['name'], $store_id);
    $store->save();
    $stores = Store::getAll();
    $brands = Brand::getAll();
    return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands));
});

$app->get("/store/{id}", function($id) use($app){
    $stores = Store::getAll();
    $store_name = Store::getStoreById($id);
    $brands = Brand::getAll();
    $carried = $store_name->getBrand();
    return $app['twig']->render('store.html.twig', array('stores' => $store_name, 'brands' => $brands, 'carried'=> $carried));
});

$app->patch("/patch/{id}", function($id) use($app){
    $brands = Brand::getAll();
    $stores = Store::getAll();
    $store = Store::getStoreById($id);
    $store->update($_POST['name']);
    return $app['twig']->render('index.html.twig', array( 'store' => $store, 'stores' => $stores, 'brands' => $brands));
});


$app->delete('/delete/store/{id}', function($id) use($app){
    $store = Store::getStoreById($id);
    $store->delete();
    $stores = Store::getAll();
    return $app['twig']->render('index.html.twig', array('stores' => $stores));
});

    // CRUD for Brand
$app->post("/add/brand", function() use($app){
    $brand = new Brand($_POST['brand_name']);
    $brand->save();
    $brands = Brand::getAll();
    $stores = Store::getAll();
    return $app['twig']->render('index.html.twig', array('brands' => $brands, 'stores'=> $stores));
});

$app->get("/brand/{id}", function($id) use($app){
    $stores = Store::getAll();
    $brand_name = Brand::getByBrandId($id);
    $brands = Brand::getall();
    $carried = $brand_name->getStore();
    // return "working on it";
    return $app['twig']->render('brand.html.twig', array('brands' => $brands, 'stores' => $stores, 'brand' => $brand_name, 'carried' => $carried));
});

$app->post("/add/brand/store/{id}", function($id) use($app){
    $store = Store::getStoreById($id);
    $new_brand = new Brand($_POST['brand_name'], $_POST['brand_id']);
    $new_brand->getId();
    $store->addBrand($new_brand);
    $brands = $store->getBrand();
    $stores = Store::getAll();
    return $app['twig']->render('store.html.twig', array('stores' => $store, 'brands' => $brands));
});

$app->post("/add/store/brand/{id}", function($id) use($app){
    $brand = Brand::getByBrandId($id);
    $new_store = new Store($_POST['name'], $_POST['store_id']);
    $new_store->getId();
    $brand->addStore($new_store);
    $stores = $brand->getStore();
    $brands = Brand::getAll();
    return $app['twig']->render('brand.html.twig', array('stores' => $stores, 'brands' => $brands));
});

// return the app
return $app;
 ?>

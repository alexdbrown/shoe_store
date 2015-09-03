<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__.'/../src/Store.php';

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__."/../views"
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //homepage with options to view stores and brands
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    //Store landing page displaying all stores, incluing a form to add a new store
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    //adds a store to the list of stores on the same page
    $app->post("/add_store", function() use ($app) {
        $store = new Store($_POST['name'], $_POST['location'], $_POST['phone']);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    //deletes all stores and returns to stores page
    $app->post("/delete_all_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    //goes to an update page for a store
    $app->get("/stores/{id}/edit", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store_edit.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });


    //update a store name and return to the store page
    $app->patch("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->update($_POST['name'], $_POST['location'], $_POST['phone']);
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    //deletes an individual store
    $app->delete("/stores/{id}/delete", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    //lists all brands and allows user to make a new brand
    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll(), 'brands' => Brand::getAll()));
    });

    //adds brand to the list of brands on the page
    $app->post("/add_brand", function() use ($app) {
        $brand = new Brand($_POST['name']);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll(), 'brands' => Brand::getAll()));
    });

    //deletes all brands
    $app->post("/delete_all_brands", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->get("/brands/{id}/view", function($id) use ($app) {
        $brand = Brand::find($id);
        $stores->getStores();
        return $app['twig']->render('brands_in_store.html.twig', array('brand' => $brand, 'stores' => $stores));
    });


    return $app;
















 ?>

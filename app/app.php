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
        $all_stores = Store::getAll();
        return $app['twig']->render('stores.html.twig', array('stores' => $all_stores));
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
        $brands = $store->getBrands();
        return $app['twig']->render('store_edit.html.twig', array('store' => $store,'brands' => Brand::getAll()));
    });

    //update a store name and return to the store page
    $app->patch("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $name = $_POST['name'];
        $location = $_POST['location'];
        $phone = $_POST['phone'];
        $store->update($name, $location, $phone);
        $brand = $store->getBrands();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //adds a brand to a store
    $app->post("/stores/{id}/add_brand", function($id) use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //deletes an individual store
    $app->delete("/stores/{id}/delete", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //lists all brands and allows user to make a new brand
    $app->get("/brands", function() use ($app) {
        $all_brands = Brand::getAll();
        return $app['twig']->render('brands.html.twig', array('brands' => $all_brands));
    });

    //adds brand to the list of brands on the page
    $app->post("/add_brand", function() use ($app) {
        $brand = new Brand($_POST['name']);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //deletes all brands
    $app->post("/delete_all_brands", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //takes user to an individual brand that lists all stores
    $app->get("/brands/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $store_selling_brands = $brand->getStores();
        return $app['twig']->render('brands_in_store.html.twig', array('brand' => $brand, 'store' => $store_selling_brands, 'all_stores' => Store::getAll()));
    });

    //adds store to a brand on individual brand page
    $app->post("/brands/{id}", function ($id) use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $brand->addStore($store);
        $new_store = new Store($_POST['name'], $_POST['location'], $_POST['phone']);
        $new_store->save();
        return $app['twig']->render('brands_in_store.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });


    return $app;
















 ?>

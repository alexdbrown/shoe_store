<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Crocs";
            $test_brand = new Brand($name);

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Crocs";
            $test_brand = new Brand($name);

            //Act
            $test_brand->save();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Crocs";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Doc Martins";
            $test_brand2 = new Brand($name);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Crocs";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Doc Martins";
            $test_brand2 = new Brand($name);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function test_addStore()
        {
            //Arrange
            $name = "Crocs";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $result = $test_brand->getStores();
            $this->assertEquals([$test_store], $result);
        }

        function test_getStores()
        {
            //Arrange
            $name = "Crocs";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $name2 = "Boots n Stuff";
            $location2 = "900 WalkAlot Blvd.";
            $phone2 = "971-202-0292";
            $test_store2 = new Store($name, $location, $phone);
            $test_store2->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //Assert
            $result = $test_brand->getStores();
            $this->assertEquals([$test_store, $test_store2], $result);
        }
    }
 ?>

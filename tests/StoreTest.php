<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    //require_once "src/Brands.php";

    $server = 'mysql:host=localhost;dbname=shoe_store_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Store::deleteAll();
        //     Brand::deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
    }

 ?>

<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoe_store_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Store::deleteAll();
        //     Brand::deleteAll();
        // }

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
    }
 ?>

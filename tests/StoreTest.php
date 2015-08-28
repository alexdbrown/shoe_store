<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    //require_once "src/Brands.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            //Brand::deleteAll();
        }

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

        function test_getLocation()
        {
            //Arrange
            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);

            //Act
            $result = $test_store->getLocation();

            //Assert
            $this->assertEquals($location, $result);
        }

        function test_getPhone()
        {
            //Arrange
            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);

            //Act
            $result = $test_store->getPhone();

            //Assert
            $this->assertEquals($phone, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $id = 1;
            $test_store = new Store($name, $location, $phone, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);

            //Act
            $test_store->save();

            //Assert
            $result = Store::getAll();
            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
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
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
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
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $column_to_update = "name";
            $new_info = "Shoes Shoes Shoes Shoes...";

            //Act
            $test_store->update($column_to_update, $new_info);

            //Assert
            $result = Store::getAll();
            $this->assertEquals("Shoes Shoes Shoes Shoes...", $result[0]->getName());
        }

        function test_updateLocation()
        {
            //Arrange
            $name = "The Shoe Store";
            $location = "432 SW Tootsies Ave";
            $phone = "503-555-5555";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $column_to_update = "location";
            $new_info = "100 Whatever Lane";

            //Act
            $test_store->update($column_to_update, $new_info);

            //Assert
            $result = Store::getAll();
            $this->assertEquals("100 Whatever Lane", $result[0]->getLocation());
        }


        function test_delete()
        {
            //Arrange
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
            $test_store->delete();

            //Assert
            $result = Store::getAll();
            $this->assertEquals($test_store2, $result[0]);
        }



    }

 ?>

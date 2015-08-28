<?php
    class Store
    {
        private $name;
        private $location;
        private $phone;
        private $id;

        function __construct($name, $location, $phone, $id = null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->phone = $phone;
            $this->id = $id;
        }

        //getters and setters
        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {

        }

        function getLocation()
        {

        }

        function setLocation($new_location)
        {

        }

        function getPhone()
        {

        }

        function setPhone($new_phone)
        {

        }

        function getId()
        {

        }
        //database methods
        function save()
        {

        }

        function update()
        {

        }

        function delete()
        {

        }

        //class interaction methods
        function addBrand($brand)
        {

        }

        function getBrands()
        {

        }

        //static methods
        static function getAll()
        {

        }

        static function deleteAll()
        {

        }

        static function find(){

        }

    }

 ?>

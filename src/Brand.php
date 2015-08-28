<?php
    class Brand
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
        $this->name = $name;
        $this->id = $id;
        }

        //getters and setters
        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        //database methods
        function save()
        {

        }

        //class interaction methods
        function addStore($store)
        {

        }

        function getStores()
        {

        }

        //static methods
        static function getAll()
        {

        }

        static function deleteAll()
        {

        }
    }    

 ?>

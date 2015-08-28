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
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
                $this->id = $GLOBALS['DB']->lastInsertId();
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
            $brands_query = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $all_brands = array();
            foreach ($brands_query as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($all_brands, $new_brand);
            }
            return $all_brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }
    }

 ?>

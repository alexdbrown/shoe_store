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
            $this->name = (string) $new_name;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = (string) $new_location;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getId()
        {
            return $this->id;
        }
        //database methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name, location, phone) VALUES (
                '{$this->getName()}', '{$this->getLocation()}', '{$this->getPhone()}'
            );");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($column_to_update, $new_info)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET {$column_to_update} = '{$new_info}' WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            //$GLOBALS['DB']->exec("DELETE FROM brands WHERE store_id = {$this->getId()};");
        }

        //class interaction methods
        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES (
                {$this->getId()}, {$brand->getId()}
            );");
        }

        function getBrands()
        {
            $brands_query = $GLOBALS['DB']->query(
                "SELECT brands.* FROM
                    stores JOIN stores_brands ON (stores.id = stores_brands.store_id)
                           JOIN brands        ON (stores_brands.brand_id = brands.id)
                WHERE stores.id = {$this->getId()};"
            );

            $matching_brands = array();
            foreach ($brands_query as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($matching_brands, $new_brand);
            }
            return $matching_brands;
        }

        //static methods
        static function getAll()
        {
            $stores_query = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $all_stores = array();
            foreach ($stores_query as $store) {
                $name = $store['name'];
                $location = $store['location'];
                $phone = $store['phone'];
                $id = $store['id'];
                $new_store = new Store($name, $location, $phone, $id);
                array_push($all_stores, $new_store);
            }
            return $all_stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function find(){

        }

    }

 ?>

<?php

class Store
{
    private $name;
    private $store_id;

    function __construct($name, $store_id = null)
    {
        $this->name = $name;
        $this->store_id = $store_id;
    }

    // getters and setters

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function getId()
    {
        return $this->store_id;
    }

    // functions

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
        $this->store_id = $GLOBALS['DB']->lastInsertId();
    }

    function update($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE store_id = {$this->getId()};");
        $this->setname($new_name);
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores WHERE store_id = {$this->getId()};");
    }

    function find()
    {
        $GLOBALS['DB']->query("SELECT * FROM stores WHERE store_id = {$this->getId()};");
    }

    function addBrand($brand)
    {
        $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");

    }

    function getBrand()
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores.store_id = stores_brands.store_id) JOIN brands ON ( stores_brands.brand_id = brands.brand_id) WHERE stores.store_id = {$this->getId()};");


        $brands = array();
        foreach($returned_brands as $brand)
        {
            $brand_name = $brand['brand_name'];
            $brand_id = $brand['brand_id'];
            $new_brand = new Brand($brand_name, $brand_id);
            array_push($brands, $new_brand);
        }
        return $brands;
    }

    // function deleteBrand()
    // {
    //     $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()} and brand_id = {$brand->getId()};");
    // }


    //  static functions
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores;");
        $GLOBALS['DB']->exec("DELETE FROM stores_brands;");
    }

    static function getAll()
    {
        $returned_store = $GLOBALS['DB']->query("SELECT * FROM stores;");
        $stores = array();
        foreach($returned_store as $store)
        {
            $name = $store['name'];
            $store_id = $store['store_id'];
            $new_store = new Store($name, $store_id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

    static function getStoreById($store_id)
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores WHERE store_id = {$store_id};");
        $stores = array();
        foreach($returned_stores as $store)
        {
            $name = $store['name'];
            $store_id = $store['$store_id'];
            $new_store = new Store($name, $store_id);
            array($store, $new_stores);
        }
        return $stores;
    }

}
 ?>

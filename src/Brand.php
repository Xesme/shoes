<?php

class Brand
{
    private $brand_name;
    private $brand_id;

    function __construct($brand_name, $brand_id = null)
    {
        $this->brand_name = $brand_name;
        $this->brand_id = $brand_id;
    }

    // getters and setters

    function setName($new_brand_name)
    {
        $this->brand_name = (string) $new_brand_name;
    }

    function getName()
    {
        return $this->brand_name;
    }

    function getId()
    {
        return $this->brand_id;
    }

    // functions
    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getName()}');");
        $this->brand_id = $GLOBALS['DB']->lastInsertId();
    }

    function getByBrandId($brand_id)
    {
        $returned_brand = $GLOBALS['DB']->query("SELECT * FROM brands WHERE brand_id = {$brand_id};");

        foreach($returned_brand as $brand)
        {
            $brand_name = $brand['brand_name'];
            $brand_id = $brand['brand_id'];
            $new_brand = new Brand($brand_name, $brand_id);
            return $new_brand;
        }
    }

    function addStore($store)
    {
        $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");

    }

    function getStore()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands JOIN stores_brands ON (stores_brands.brand_id = brands.brand_id) JOIN stores ON (stores.store_id = stores_brands.store_id) WHERE brands.brand_id = {$this->getId()};");

        $stores = array();
        foreach($returned_stores as $store)
        {
            $store_name = $store['name'];
            $store_id = $store['store_id'];
            $new_store = new Store($store_name, $store_id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

    // static functions
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands;");
        $GLOBALS['DB']->exec("DELETE FROM stores_brands;");

    }

    static function getAll()
    {
        $returned_brand = $GLOBALS['DB']->query("SELECT * FROM brands;");
        $brands = array();
        foreach($returned_brand as $brand)
        {
            $brand_name = $brand['brand_name'];
            $brand_id = $brand['brand_id'];
            $new_brand = new Brand($brand_name, $brand_id);
            array_push($brands, $new_brand);
        }
        return $brands;
    }
}


 ?>

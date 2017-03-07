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
        $GLOBALS['DB']->exec("DELETE FROM stores WHERE store_id = '{$this->getId()}';");
    }

    function find()
    {
        $GLOBALS['DB']->query("SELECT * FROM stores WHERE store_id = {$this->getId()};");
    }

    //  static functions
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores;");
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
        foreach($returned_stores as $store)
        {
            $name = $store['name'];
            $store_id = $store['$store_id'];
            $new_store = new Store($name, $store_id);
            return $new_store;
        }
    }

}
 ?>

<?php

class Store
{
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
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
        $this->id;
    }

    function setId($id)
    {
        $this->id = (int) $id;
    }

    // functions

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function update($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE stores SET name = '{new_name}' WHERE id = {$this->getId()};");
        $this->setname($new_name);
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores WHERE name = '{$this->getName()}';");
    }

    //  static functions

    // static function findById($id)
    // {
    //     $stores = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = $id;");
    //     foreach($stores as $store)
    //     {
    //         $shoe_store = new Store ( $store['store_name'], $store['id']);
    //     }
    //     return $shoe_store;
    // }

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
            $id = $store['id'];
            $new_store = new Store($name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }
}

 ?>

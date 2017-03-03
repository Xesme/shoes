<?php

class Store
{
    private $store_name;
    private $id;

    function __construct($store_name = '', $id = NULL)
    {
        $this->store_name = $store_name;
        $this->id = $id;
    }

    // getters and setters

    function getName()
    {
        return $this->store_name;
    }

    function setName($new_store_name)
    {
        $this->store_name = (string) $new_store_name;
    }

    function getId()
    {
        $this->id;
    }

    // function getStoreId()
    // {
    //     $this->store_id;
    // }

    // functions

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }


    //  static functions

    static function getAll()
    {
        $returned_store = $GLOBALS['DB']->query("SELECT * FROM stores;");
        $stores = array();
        foreach($returned_store as $store)
        {
            $store_name = $store['store_name'];
            $id = $store['id'];
            $new_store = new Store($store_name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }
}

 ?>

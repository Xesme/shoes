<?php

class Store
{
    private $store_name;
    private $store_id;
    private $id;

    function __construct($store_name = '', $store_id = null, $id = null)
    {
        $this->store_name = $store_name;
        $this->store_id = $store_id;
        // $this->id = $id;
    }

    // getters and setters

    function getName()
    {
        return $this->store_name;
    }

    function setName($store_name)
    {
        $this->store_name = (string) $store_name;
    }

    function getId()
    {
        $this->id;
    }

    function getStoreId()
    {
        $this->store_id;
    }
}

 ?>

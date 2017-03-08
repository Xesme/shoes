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
    {   var_dump($brand_id);
        $returned_brand = $GLOBALS['DB']->query("SELECT * FROM brands WHERE brand_id = {$brand_id};");

        // $brands = array();
        foreach($returned_brand as $brand)
        {
            $brand_name = $brand['brand_name'];
            $brand_id = $brand['brand_id'];
            $new_brand = new Brand($brand_name, $brand_id);
            // array_push($new_brand, $brands);
            return $new_brand;
        }
        // return $brands;
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

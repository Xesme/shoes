<?php

class Brand
{
    private $brand_name;
    private $brand_id;
    private $id;

    function __construct($brand_name, $brand_id, $id = null)
    {
        $this->brand_name = $brand_name;
        $this->brand_id = $brand_id ;
        $this->id = $id;
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

    function getBrandId()
    {
        return $this->brand_id;
    }

    function setBrandId($new_brand_id)
    {
        $this->brand_id = (int) $new_brand_id;
    }

    function getId()
    {
        return $this->id;
    }

    // functions
    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }


    // static functions

    static function getAll()
    {
        $returned_brand = $GLOBALS['DB']->query("SELECT * FROM brands;");
        $brands = array();
        foreach($returned_brand as $brand)
        {
            $name = $brand['brand_name'];
            $brand_id = $brand['brand_id'];
            $id = $brand["id"];
            $new_brand = new brand($name, $brand_id, $id);
            array_push($brands, $new_brand);
        }
        return $brands;
    }

    
}


 ?>

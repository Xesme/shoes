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
}


 ?>

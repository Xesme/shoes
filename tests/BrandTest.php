<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Store.php";
require_once "src/Brand.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class BrandTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Store::deleteAll();
        // Brand::deleteAll();
    }

    function test_construct()
    {
        // Arrange
        $brand_name = "MC Shoes";
        $band_id = null;
        $new_brand = new Brand($brand_name, $band_id, $id);

        // Act
        $result1 = $new_brand->getName();
        $result2 = $new_brand->getBrandId();
        $result3 = $new_brand->getId();

        // Assert
        $this->assertEquals($brand_name, $result1);
        $this->assertEquals($brand_id, $result2);
        $this->assertEquals($id, $result3);
    }

    

}
 ?>

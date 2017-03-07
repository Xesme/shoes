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
        Brand::deleteAll();
    }

    function test_construct()
    {
        // Arrange
        $brand_name = "MC Shoes";
        $brand_id = null;
        $new_brand = new Brand($brand_name, $band_id);

        // Act
        $result1 = $new_brand->getName();
        $result2 = $new_brand->getId();

        // Assert
        $this->assertEquals($brand_name, $result1);
        $this->assertEquals($brand_id, $result2);
    }

    function test_save()
    {
        // Arrange
        $brand_name = "Mc Snoopy Shoes";
        $new_brand = new Brand($brand_name, $brand_id);

        // Act
        $new_brand->save();
        $result = Brand::getAll();

        // Assert
        $this->assertEquals($new_brand, $result[0]);
    }

    function test_getAll()
    {
        // Arrange
        $brand_name = "Mc Snoopy Shoes";
        $new_brand = new Brand($brand_name, $brand_id);
        $new_brand->save();

        $brand_name2 = "Shoes";
        $new_brand2 = new Brand($brand_name2, $brand_id);
        $new_brand2->save();

        // Act
        $result = Brand::getAll();

        // Assert
        $this->assertEquals([$new_brand, $new_brand2], $result);
    }



}
 ?>

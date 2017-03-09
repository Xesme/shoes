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
        $new_brand = new Brand($brand_name, $brand_id);

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
        $new_brand = new Brand($brand_name);

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
        $new_brand = new Brand($brand_name);
        $new_brand->save();

        $brand_name2 = "Shoes";
        $new_brand2 = new Brand($brand_name2);
        $new_brand2->save();

        // Act
        $result = Brand::getAll();

        // Assert
        $this->assertEquals([$new_brand, $new_brand2], $result);
    }

    function test_deleteAll()
    {
        // Arrange
        $brand_name = "Mc Snoopy Shoes";
        $new_brand = new Brand($brand_name);
        $new_brand->save();

        $brand_name2 = "Shoes";
        $new_brand2 = new Brand($brand_name2);
        $new_brand2->save();

        // Act
        $result = Brand::deleteAll();

        // Assert
        $this->assertEquals([ ], Brand::getAll());
    }

    function test_find()
    {
        {
            // Arrange
            $brand_name = 'Nada';
            $new_test = new Brand($brand_name);
            $new_test->save();

            $brand_name2 = 'Soft Soles';
            $new_test2 = new Brand($brand_name2);
            $new_test2->save();

            // Act
            $brand_id = $new_test->getId();
            $new_test->getByBrandId($brand_id);
            $result = Brand::getAll();

            // Assert
            $this->assertEquals($new_test, $result[0]);
        }
    }

    function test_addStore()
    {
        // Arrange
        $name = 'PayMore';
        $new_store = new Store($name);
        $new_store->save();

        $brand_name = "Nada";
        $new_brand = new Brand($brand_name);
        $new_brand->save();

        // Act
        $new_brand->addStore($new_store);
        $result = $new_brand->getStore();

        // Assert
        $this->assertEquals([$new_store], $result);
    }
}
 ?>

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

class StoreTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Store::deleteAll();
        Brand::deleteAll();
    }

    function test_construct()
    {
        // Arrange
        $name = "PayMore";
        $store_id = null;
        $new_test = new Store($name, $store_id);

        // Act
        $result = $new_test->getName();
        $result2 = $new_test->getId();

        // Assert
        $this->assertEquals("PayMore", $result);
        $this->assertEquals($store_id, $result2);
    }

    function test_save()
    {
        // Arrange
        $name = "PayMore";
        $new_test = new Store($name);
        $new_test->save();

        // Act
        $result = Store::getAll();

        // Assert
        $this->assertEquals($new_test, $result[0]);
    }

    function test_getAll()
    {
        // Arrange
        $name = "PayMore";
        $new_test = new Store($name);
        $new_test->save();

        $name2 = "PayMore2";
        $new_test2 = new Store($name2);
        $new_test2->save();

        // Act
        $result = Store::getAll();

        // Assert
        $this->assertEquals([$new_test, $new_test2], $result);
    }

    function test_deleteAll()
    {
        // Arrange
        $name = "PayMore";
        $new_test = new Store($name);
        $new_test->save();

        $name2 = "PayMore2";
        $new_test2 = new Store($name2);
        $new_test2->save();

        // Act
        $result = Store::deleteAll();
        $result = Store::getAll();

        // Assert
        $this->assertEquals([], $result);
    }

    function test_update()
    {
        // Arrange
        $name = "PayMore";
        $new_test = new Store($name);
        $new_test->save();

        $new_name = "Pay2More";
        // Act
        $new_test->update($new_name);

        // Assert
        $this->assertEquals("Pay2More", $new_test->getName());
    }

    function test_deleteStore()
    {
        // Arrange
        $name = 'PayMore';
        $new_test = new Store($name);
        $new_test->save();

        $name2 = 'OmgShoes';
        $new_test2 = new Store($name22);
        $new_test2->save();

        // Act
        $new_test->delete();

        // Assert
        $result = Store::getAll();
        $this->assertEquals([$new_test2], $result);
    }

    function test_find()
    {
        // Arrange
        $name = 'PayMore';
        $new_test = new Store($name);
        $new_test->save();

        $name2 = 'OmgShoes';
        $new_test2 = new Store($name2);
        $new_test2->save();

        // Act
        $store_id = $new_test2->getId();
        $new_test2->getStoreById($store_id);
        $result = Store::getAll();

        // Assert
        $this->assertEquals($new_test2, $result[1]);
    }

    function test_addBrand()
    {
        // Arrange
        $brand_name = "Nada";
        $new_brand = new Brand($brand_name);
        $new_brand->save();

        $name = 'PayMore';
        $new_store = new Store($name);
        $new_store->save();

        // Act
        $new_store->addBrand($new_brand);
        $result = $new_store->getBrand();

        // Assert
        $this->assertEquals([$new_brand], $result);
    }

    function test_deleteBrand()
    {
        // Arrange
        $brand_name2 = "Mabbias";
        $new_brand2 = new Brand($brand_name2);
        $new_brand2->save();

        $brand_name = "Nada";
        $new_brand = new Brand($brand_name);
        $new_brand->save();

        $name = 'PayMore';
        $new_store = new Store($name);
        $new_store->save();
        // var_dump(Store::getAll());
        // Act
        $new_store->addBrand($new_brand);
        $new_store->addBrand($new_brand2);
        $new_store->deleteBrand($new_brand2);
        $result = $new_store->getBrand();

        // Assert
        $this->assertEquals([$new_brand], $result);
    }
}

?>

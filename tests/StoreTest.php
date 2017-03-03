<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Store.php";
// require_once "src/Brand.php";

$server = "mysql:host=localhost:8889;dbname=shoes_test";
$username = "root";
$password = "root";
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{
    // protected function tearDown()
    // {
    //     Store::deleteAll();
    // }

    function test_construct()
    {
        // Arrange
        // $store_name = "PayMore";
        // $id = NULL;
        $new_store = new Store("PayMore");


        // Act
        $new_store2 = new Store();
        $new_store2->setName($new_store->getName());
        // $new_store2 = $$new_store2->setId($new_store2->getId());


        // Assert
        $this->assertEquals("PayMore", $new_store2->getName());
    }
    // //
    // function test_save_dependant_on_getAll()
    // {
    //     // Arrange
    //     $store_name = 'PayMore';
    //     $id = NULL;
    //     $new_test_store = new Store($store_name, $id);
    //
    //     // Act
    //     $new_test_store->save();
    //     $result = Store::getAll();
    //
    //     // Assert
    //     $this->assertEquals($new_test_store, $result[0]);
    // }
    //
    // function test_getAll()
    // {
    //     // Arrange
    //     $store_name = "PayMore";
    //     $id = NULL;
    //     $new_test_store = new Store($store_name, $id);
    //     $new_test_store->save();
    //
    //     $store_name2 = "PayLess";
    //     $new_test_store2 = new Store($store_name2, $id);
    //     $new_test_store2->save();
    //
    //     // Act
    //     $result = Store::getAll();
    //
    //     // Assert
    //     $this->assertEquals([$new_test_store, $new_test_store2], $result);
    // }
    //
    // function test_deleteAll()
    // {
    //     // Arrange
    //     $store_name = "PayMore";
    //     $id = NULL;
    //     $new_test_store = new Store($store_name, $id);
    //     $new_test_store->save();
    //
    //
    //     // Act
    //     Store::deleteAll();
    //     $result = Store::getAll();
    //
    //     // Assert
    //     $this->assertEquals([], $result);
    // }
    //
    // function test_search()
    // {
    //     // Arrange
    //     $store_name = 'PayMore';
    //     $new_store = new Store($store_name, $id);
    //     $new_store->save();
    //     var_dump($new_store);
    //
    //     $store_name = "PayLess";
    //     $new_store2 = new Store($store_name, $id);
    //     $new_store2->save();
    //
    //     // Act
    //     $found_store = Store::findById($new_store->getId());
    //
    //     // Assert
    //     $this->assertEquals($new_store, $found_store);
    // }
}

?>

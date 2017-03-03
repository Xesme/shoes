<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
**/

require_once "src/Store.php";
// require_once "src/Brand.php";

$server = "mysql:host=localhost:8889;dbname=shoes_test";
$username = "root";
$password = "root";
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{

    function test_construct()
    {
        // Arrange
        $store_name = "PayMore";
        $id = NULL;
        $new_store = new Store($store_name, $id);

        // Act
        $result1 = $new_store->getName();
        $result3 = $new_store->getId();

        // Assert
        $this->assertEquals($store_name, $result1);
        $this->assertEquals($id, $result3);

    }

    function test_save_dependant_on_getAll()
    {
        // Arrange
        $store_name = 'PayMore';
        $id = NULL;
        $new_test_store = new Store($store_name, $id);

        // Act
        $new_test_store->save();
        $result = Store::getAll();

        // Assert
        $this->assertEquals([$new_test_store], $result);
    }

}

?>

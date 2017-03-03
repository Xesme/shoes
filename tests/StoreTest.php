<?php

/**
* @backupGLOBALS disabled
* @backupStaticAttributes disabled
**/

require_once "src/Store.php";
// require_once "src/Brand.php";

$server= "mysql:host=localhost:8889;dbname=shoes_test";
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{

    function test_construct()
    {
        // Arrange
        $store_name = "PayMore";
        $store_id = NULL;
        $id = NULL;
        $new_store = new Store($store_name, $store_id, $id);
        var_dump($new_store);

        // Act
        $result1 = $new_store->getName();
        $result2 = $new_store->getStoreId();
        $result3 = $new_store->getId();

        // Assert
        $this->assertEquals($store_name, $result1);
        $this->assertEquals($store_id, $result2);
        $this->assertEquals($id, $result3);

    }

}

?>

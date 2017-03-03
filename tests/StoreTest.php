<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Store.php";
// require_once "src/Brand.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Store::deleteAll();
    }

    function test_construct()
    {
        // Arrange
        $name = "PayMore";
        $id = null;
        $new_test = new Store($name, $id);

        // Act
        $result = $new_test->getName();
        $result2 = $new_test->getId();

        // Assert
        $this->assertEquals("PayMore", $result);
        $this->assertEquals($id, $result2);

    }

    function test_save()
    {
        // Arrange
        $name = "PayMore";
        $id = null;
        $new_test = new Store($name, $id);
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
        $id = null;
        $new_test = new Store($name, $id);
        $new_test->save();

        $name2 = "PayMore2";
        $new_test2 = new Store($name2, $id);
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
        $id = null;
        $new_test = new Store($name, $id);
        $new_test->save();

        $name2 = "PayMore2";
        $new_test2 = new Store($name2, $id);
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
        $id = null;
        $new_test = new Store($name, $id);
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
        $id = null;
        $new_test = new Store($name, $id);
        $new_test->save();

        $name2 = 'OmgShoes';
        $id2 = null;
        $new_test2 = new Store($name2, $id2);
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
        $id = null;
        $new_test = new Store($name, $id);
        $new_test->save();

        $name2 = 'OmgShoes';
        $id2 = null;
        $new_test2 = new Store($name2, $id2);
        $new_test2->save();

        // Act
        $new_test2->find();
        $result = Store::getAll();

        // Assert
        $this->assertEquals($new_test2, $result[1]);

    }
}

?>

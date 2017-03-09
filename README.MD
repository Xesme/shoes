# Shoe Store

#### Epicodus PHP Week 4 Independent Project, March 3rd, 2017

#### By Xia Amendolara

## Description
A web application built using PHP and MySQL. It will simulate a shoe store database containing many stores and brands. This project is meant to demonstrate knowledge of many to many relationship and join statements in MySQL and PHP.

## User Stories (Instructions)

Create a database called shoes and a testing database called shoes_test, and remember to follow proper naming conventions for your tables and columns. As you create your tables, copy all MySQL commands into your README.

Build full CRUD functionality for Stores. Create, Read (all and singular), Update, Delete (all and singular).

Allow a user to create Brands that are assigned to a Store. Don't worry about updating or deleting Brands.

There is a many-to-many relationship between Brands and shoe Stores. Many Stores can carry many Brands and a Brand can be carried in many Stores. Create a join table to store these relationships.

When a user is viewing a single Store, list all Brands that Store currently carries, and allow them to add another Brand to that store. Create a method to get the Brands sold at a Store, and use a join statement in it.

When a user is viewing a single Brand, list all Stores that carry that Brand and allow them to add a Store to that Brand. Use a join statement in this method too.

When you are finished with the assignment, make sure to export your databases and commit the .sql.zip files for both the app database and the test database at the top of your project directory.


## Setup/Installation Requirements


1. _Fork and clone this repository from_ [gitHub]https://github.com/xesme/shoes.
2. See https://mamp.info/ for details on installing _MAMP_.
3. Use MAMP website `http://localhost:8888/phpmyadmin/` to import database and data from SQL file.
4. See https://getcomposer.org/ for details on installing _composer_.
5. Start interactive SQL at command prompt if desired with > `/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot`
6. Run `composer install --prefer-source --no-interaction` from project root
7. Create a local server in the /web directory within the project folder using the command: `php -S localhost:8000`
8. Open the directory http://localhost:8000/ in any standard web browser.

                        To use PHPUnit  
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Mac.
* If you would like to try PHPUnit Tests, use MAMP website to copy 'shoes' database to `shoes_test` database (Structure Only).
* To run PHPUnit tests from root > `vendor/bin/phpunit tests`


## Known Bugs
* There are no bugs currently but the project is unfinished.

## Support and contact details
* No support

## Technologies Used
* PHP
* MAMP
* mySQL
* Composer
* PHPUnit
* Silex
* Twig
* Bootstrap
* HTML
* CSS
* Git

## Copyright (c)
* 2017 Xia Amendolara

## License
* MIT

## Implementation Plan

* Construct a README.md
* Build shoes and shoes_test databases
* Build and test Store class (Store with all CRUD functionality)
* Implementation of Silex framework
* Implementation of basic Store routes with Twig
* Build and test Class (Brand)  
* Implementation of basic Brand routes with Twig
* Build and test store_brand (join statement)
* Build twig routes for stores_brands
* Implement routes with Twig and polish html and CSS


## Used MySQL Commands
* /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE stores (store_name VARCHAR (255), store_id serial PRIMARY KEY);
* CREATE TABLE brands (brand_name VARCHAR (255), brand_id serial PRIMARY KEY);
* CREATE DATABASE shoes_test;
* USE shoes_test;
* CREATE TABLE stores (store_name VARCHAR (255), store_id serial PRIMARY KEY);
* CREATE TABLE brands (brand_name VARCHAR (255), brand_id serial PRIMARY KEY);
* DESCRIBE stores;


| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| store_name | varchar(255) | YES |  | NULL |  |
| store_id | bigint(20) | YES |  | NULL |  |


* DESCRIBE brands;


| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| bran_name | varchar(255) | YES  |   | NULL    |  |
|  brand_id | bigint(20) unsigned | NO | PRI | NULL | auto_increment |

* INSERT INTO stores (store_name) VALUES ('{$this->getName()}'); (function save())
* "SELECT * FROM stores;" (function getAll())
* "DELETE FROM stores; (function deleteAll())"
* "UPDATE stores SET name = '{new_name}' WHERE id = {$this->getId()};" (function update())
* DELETE FROM stores WHERE id = '{$this->getId()}';
* SELECT * FROM stores WHERE id = {$this->getId()};
* INSERT INTO brands (brand_name) VALUES ('{$this->getName()}');
* SELECT * FROM brands WHERE brand_id = {$brand_id};
* CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id BIGINT, brand_id BIGINT);
* DESCRIBE stores_brands


| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| id       | bigint(20) unsigned | NO   | PRI | NULL | auto_increment |
| store_id | bigint(20)  | YES  |     | NULL    |   |
| brand_id | bigint(20)  | YES  |     | NULL    |   |

* USE shoes_test;
* CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id BIGINT, brand_id BIGINT);
* DELETE FROM stores_brands WHERE store_id = {$this->getId()} and brand_id = {$brand->getId()};
* INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});
* SELECT brands.* FROM stores JOIN stores_brands ON (stores.store_id = stores_brands.store_id) JOIN brands ON ( stores_brands.brand_id = brands.brand_id) WHERE stores.store_id = {$this->getId()};
* SELECT stores.* FROM brands JOIN stores_brands ON (stores_brands.brand_id = brands.brand_id) JOIN stores ON (stores.store_id = stores_brands.store_id) WHERE brands.brand_id = {$this->getId()};
* DELETE FROM brands;
* DELETE FROM stores_brands;
* SELECT * FROM brands;

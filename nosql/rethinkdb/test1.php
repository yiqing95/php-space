<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/18
 * Time: 17:23
 */

// require_once( dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR .'bootstrap.php' ) ;
require_once(__DIR__ . DIRECTORY_SEPARATOR . '../../bootstrap.php');

//  在虚拟机中运行时注意： rethinkdb --bind all

?>
<?php

// Load the driver
require_once("rdb/rdb.php");

$host = '192.168.66.128' ; // localhost
// Connect to localhost
$conn = r\connect($host);

// Create a test table
// r\db("test")->tableCreate("tablePhpTest")->run($conn);

// Insert a document
$document = array('someKey' => 'someValue');

$result = r\table("tablePhpTest")->insert($document)
    ->run($conn);
// echo "Insert: $result\n";
$result = print_r($result,true);
echo "Insert  {$result} \n";

// How many documents are in the table?
$result = r\table("tablePhpTest")->count()->run($conn);
echo "Count: $result\n";

// List the someKey values of the documents in the table
// (using a mapping-function)
$result = r\table("tablePhpTest")->map(function ($x) {
    return $x('someKey');
})->run($conn);

foreach ($result as $doc) {
    print_r($doc);
}

// Delete the test table
r\db("test")->tableDrop("tablePhpTest")->run($conn);
<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/11/10
 * Time: 0:19
 */
?>
<?php

// using composer here !
require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../', 2) . 'bootstrap.php');


$client = new \LinkORB\Component\Etcd\Client($server);
$client->set('/foo', 'fooValue');
// Set the ttl
//$client->set('/foo', 'fooValue', 10);
// get key value
echo $client->get('/foo');

// Update value with key
$client->update('/foo', 'newFooValue');

/*
// Delete key
$client->rm('/foo');

// Create a directory
$client->mkdir('/fooDir');
// Remove dir
$client->rmdir('/fooDir');

*/

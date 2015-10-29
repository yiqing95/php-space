<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/19
 * Time: 16:58
 *
 * @see https://github.com/rmccue/Requests
 */
// bootstrap.php 文件据当前文件级数 是 4
require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../',3). 'bootstrap.php');
?>

<?php

/*
$headers = array('Accept' => 'application/json');
$options = array('auth' => array('user', 'pass'));
$request = Requests::get('https://api.github.com/gists', $headers, $options);

var_dump($request->status_code);
// int(200)

var_dump($request->headers['content-type']);
// string(31) "application/json; charset=utf-8"

var_dump($request->body);
// string(26891) "[...]"
*/

function Get($url = 'https://api.github.com/gists')
{
    $headers = array('Accept' => 'application/json');
    // $options = array('auth' => array('user', 'pass'));
     $options = array();
    $request = Requests::get($url , $headers, $options);

    var_dump($request->status_code);
// int(200)

    var_dump($request->headers['content-type']);
// string(31) "application/json; charset=utf-8"

    var_dump($request->body);
// string(26891) "[...]"
}
$scheme =  $_SERVER['REQUEST_SCHEME'] ;
$httpHost = $_SERVER['HTTP_HOST'] ;
$requestUrl = dirname(dirname( $_SERVER['REQUEST_URI'] ) ) ;

$url =  $scheme.'://'.$httpHost . ''.$requestUrl . '/api.php' ;
// var_dump($_SERVER) ;
// die($url) ;
// Get($url) ;

/**
 * + ----------------------------------------------------------- +
 *                      post 请求
 *
 */
// Now let's make a request!
$request = Requests::post($url,  array('Accept' => 'application/json') /* array('Accept'=>'application/json') */, array('mydata' => 'something'));
// Check what we received
// var_dump($request);

/**
 * + ----------------------------------------------------------- +
 */

// $url = 'https://api.github.com/some/endpoint';
$headers = array('Content-Type' => 'application/json');
$data = array('some' => 'data');
$response = Requests::post($url, $headers, json_encode($data));
print_r([
   $response->body ,
]);
/**
 * + ----------------------------------------------------------- +
 */

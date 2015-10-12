<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/12
 * Time: 14:28
 */
/**
 *  ·ÃÎÊÈç£º http://127.0.0.1:6666/php-space/slim/test1.php/hello/yiqing
 */


require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR .'bootstrap.php' ) ;

$app = new \Slim\Slim();
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});
$app->get('/',function(){
    echo 'welcome to slim !';
});
$app->run();
<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/10
 * Time: 21:08
 */
/**
 * + ===============================================================================|
 *                        此server 搭配的client.html 文件运行哦！
 *
 * + ===============================================================================|
 */
// 禁用xdebug 扩展
if(function_exists('xdebug_disable')) {
    xdebug_disable();
}

require_once( dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR .'bootstrap.php' ) ;
?>

<?php
$loader = new \Composer\Autoload\ClassLoader() ;
// 注册自己的根名空间目录
$loader->addPsr4('MyApp\\',__DIR__.'/myapp');
$loader->register() ;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

//require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();
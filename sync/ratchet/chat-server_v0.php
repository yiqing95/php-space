<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/10
 * Time: 21:08
 */
/**
 * �˽ű� ������
 *             >  telnet localhost 8080
 * ���client �����»��෢����Ϣ��
 */
// ����xdebug ��չ
if(function_exists('xdebug_disable')) {
    xdebug_disable();
}

require_once( dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR .'bootstrap.php' ) ;
?>

<?php
$loader = new \Composer\Autoload\ClassLoader() ;
// ע���Լ��ĸ����ռ�Ŀ¼
$loader->addPsr4('MyApp\\',__DIR__.'/myapp');
$loader->register() ;

use Ratchet\Server\IoServer;
use MyApp\Chat;

// require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new Chat(),
    8080
);

$server->run();
<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/5
 * Time: 10:46
 */

define('DS',DIRECTORY_SEPARATOR) ;

function autoloadVendor()
{
    $rootBaseName = 'php-space' ;
    $phpSpaceRootDir = substr(__DIR__,0,strpos(__DIR__,$rootBaseName)).$rootBaseName;
    // die($phpSpaceRootDir) ;
    $vendorDir = $phpSpaceRootDir.DS.'vendor';

    require $vendorDir.'/autoload.php';
}
// �Զ�����vendorĿ¼�µ�������
autoloadVendor() ;


$loader = new \Composer\Autoload\ClassLoader();
// $loader->addPsr4('MyClass',__DIR__.'/my-classes');
// ע���Լ��ĸ����ռ�Ŀ¼
$loader->addPsr4('MyClass\\',__DIR__.'/my-classes');
$loader->register() ;

?>
<?php

$myObj = new \MyClass\ClassA() ;
$myObj->hello() ;


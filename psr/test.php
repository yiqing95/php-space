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
// 自动加载vendor目录下的依赖类
autoloadVendor() ;


$loader = new \Composer\Autoload\ClassLoader();
// $loader->addPsr4('MyClass',__DIR__.'/my-classes');
// 注册自己的根名空间目录
$loader->addPsr4('MyClass\\',__DIR__.'/my-classes');
$loader->register() ;

?>
<?php

$myObj = new \MyClass\ClassA() ;
$myObj->hello() ;


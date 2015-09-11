<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/11
 * Time: 8:12
 */
?>
<?php


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

$inputData = [
  'this is text',
    3,
    'key'=>'value',
];

Symfony\Component\VarDumper\VarDumper::dump($inputData) ;

\yii\helpers\VarDumper::dump($inputData) ;

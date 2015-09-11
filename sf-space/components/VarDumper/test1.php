<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/9
 * Time: 21:27
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

use Symfony\Component\VarDumper\VarDumper ;

// create a variable, which could be anything!
$someVar = '...';

Symfony\Component\VarDumper\VarDumper::dump($someVar);

$var2 = [
  'k1'=>22,
    'hiii',
];

dump($var2) ;

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
    $phpSpaceRootDir = substr(__DIR__,0,strpos(__DIR__,'php-space')).'php-space';
    // die($phpSpaceRootDir) ;
    $vendorDir = $phpSpaceRootDir.DS.'vendor';

    require $vendorDir.'/autoload.php';
}
// 自动加载vendor目录下的依赖类
autoloadVendor() ;

use Symfony\Component\Yaml\Dumper;

$dataDir = __DIR__. DS .'data' ;

$dumper = new Dumper() ;

$testData = [
  'this is line',
    'key1'=>'v1',
    'key2'=>2,
];

print_r($dumper->dump($testData)) ;

file_put_contents($dataDir.DS.'file4write_test.yml',$dumper->dump($testData));
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


$dataDir = __DIR__. DS .'data' ;

$yaml = new \Symfony\Component\Yaml\Parser();

$value = $yaml->parse(file_get_contents($dataDir.DS.'file.yml' )) ;

print_r($value) ;


<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/6
 * Time: 19:42
 */
/**
 * 此文件提供自动加载功能 通过包含该文件 可以使用composer 来加载依赖包
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

<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/29
 * Time: 8:53
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

$loader = new \Symfony\Component\Templating\Loader\FilesystemLoader(__DIR__.'/views/%name%');

$templating = new \Symfony\Component\Templating\PhpEngine(new \Symfony\Component\Templating\TemplateNameParser(),$loader);

echo $templating->render('hello.php',array(
    'firstname'=>'Fabien',
));
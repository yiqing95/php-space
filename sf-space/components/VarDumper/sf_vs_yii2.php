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


class PropertyExample
{
    public $publicProperty = 'The `+` prefix denotes public properties,';
    protected $protectedProperty = '`#` protected ones and `-` private ones.';
    private $privateProperty = 'Hovering a property shows a reminder.';
}

$var = new PropertyExample();
Symfony\Component\VarDumper\VarDumper::dump($var) ;

\yii\helpers\VarDumper::dump($var) ;

class ReferenceExample
{
    public $info = "Circular and sibling references are displayed as `#number`.\nHovering them highlights all instances in the same dump.\n";
}
$var = new ReferenceExample();
$var->aCircularReference = $var;

Symfony\Component\VarDumper\VarDumper::dump($var) ;

\yii\helpers\VarDumper::dump($var) ;
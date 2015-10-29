<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/6
 * Time: 19:42
 */


define('DS', DIRECTORY_SEPARATOR);

/**
 * return the vendor dir
 *
 * @return string
 */
function VendorDir()
{
    $rootBaseName = 'php-space';
    $phpSpaceRootDir = substr(__DIR__, 0, strpos(__DIR__, $rootBaseName)) . $rootBaseName;
    // die($phpSpaceRootDir) ;
    $vendorDir = $phpSpaceRootDir . DS . 'vendor';
    return $vendorDir;
}

/**
 *
 */
function autoloadVendor()
{

    $vendorDir = VendorDir();

    require $vendorDir . '/autoload.php';
}

// using composer
autoloadVendor();


/**
 * using yii ： http://www.yiiframework.com/doc-2.0/guide-tutorial-yii-integration.html
 *
 *
 * @param array $yiiConfig
 */
function  UsingYii($yiiConfig = [])
{
    // require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
    require(VendorDir() . '/yiisoft/yii2/Yii.php');

    // $yiiConfig = require(__DIR__ . '/../config/yii/web.php');

    $defaultConfig =
        [
            'id' => 'my-yii-app',
            'language' => 'zh-CN',
            'basePath' => dirname(__DIR__),
            'bootstrap' => [
                'log',
            ],
            'modules' => [
            ],
            'components' => [

                'request' => [
                    'cookieValidationKey' => 'anyRandomString',//getenv('COOKIE_VALIDATION_KEY'),
                    'parsers' => [
                        'application/json' => 'yii\web\JsonParser',
                    ]
                ],
            ],
            'params' => [

            ],
        ];

    // merger the config with default one
    $yiiConfig = \yii\helpers\ArrayHelper::merge($defaultConfig, $yiiConfig);

    new \yii\web\Application($yiiConfig); // Do NOT call run() here
}
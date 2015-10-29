<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/24
 * Time: 21:23
 */
require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../',3). 'bootstrap.php');

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

// php 文件
$translator = new Translator('zh_CN');
$translator->addLoader('php_file', new \Symfony\Component\Translation\Loader\PhpFileLoader());

$translator->addResource('php_file', __DIR__.'/messages/app.php', 'zh_CN','plugin');
// 在plugin 域中存在
var_dump($translator->trans('key',array(),'plugin'));
var_dump($translator->trans('key2'));
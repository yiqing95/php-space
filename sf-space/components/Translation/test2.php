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

$translator = new Translator('fr_FR');
$translator->addLoader('array', new ArrayLoader());
$translator->addResource('array', array(
    'Symfony is great!' => 'J\'aime Symfony!',
), 'fr_FR');

var_dump($translator->trans('Symfony is great!'));

$name = 'yeee ' ;
$translated = $translator->trans(
    'Hello %name%',
    array('%name%' => $name)
);

var_dump($translated);
// php 文件
$translator = new Translator('zh_CN');
$translator->addLoader('php_file', new \Symfony\Component\Translation\Loader\PhpFileLoader());

$translator->addResource('php_file', __DIR__.'/messages/app.php', 'zh_CN');

var_dump($translator->trans('key'));
var_dump($translator->trans('key2'));
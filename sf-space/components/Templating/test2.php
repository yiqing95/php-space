<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/25
 * Time: 11:35
 */

require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../',3). 'bootstrap.php');

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__.'/views/%name%');

$templating = new PhpEngine(new TemplateNameParser(), $loader);

echo $templating->render('hello.php', array('firstname' => 'Fabien'));


//  添加全局变量
$templating->addGlobal('ga_tracking', 'UA-xxxxx-x');

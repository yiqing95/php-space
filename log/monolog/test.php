<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/12/8
 * Time: 22:35
 */

require_once(__DIR__.'/../../bootstrap.php') ;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logPath = __DIR__.'/runtime/'.date('Y').'.log';
// create a log channel
$logger = $log = new Logger('name');
$log->pushHandler(new StreamHandler($logPath, Logger::WARNING));
$log->pushHandler(new \Monolog\Handler\FirePHPHandler(),Logger::INFO);

// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');

$logger->addInfo('Adding a new user', array('username' => 'Seldaek'));
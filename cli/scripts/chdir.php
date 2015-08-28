<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 11:02
 */
/**
 * 兼容 老的cgi
 */
?>
<?
chdir(dirname($_SERVER['argv'][0]));

echo getcwd() ;
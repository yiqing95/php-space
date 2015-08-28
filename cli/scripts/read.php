<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 9:59
 */
/**
 * 读取用户输入
 */
?>
<?php

function read ($length='255')
{
    if (!isset ($GLOBALS['StdinPointer']))
    {
        $GLOBALS['StdinPointer'] = fopen ("php://stdin","r");
    }
    $line = fgets ($GLOBALS['StdinPointer'],$length);
    return trim ($line);
}

// then

echo "Enter your name: ";
$name = read ();
echo "\nHello $name! Where you came from? ";
$where = read ();
echo "\nI see. $where is very good place.";

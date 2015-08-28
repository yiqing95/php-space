<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 22:11
 */
/**
 * http://php.net/getopt
 */
?>
<?php

$options = getopt('f:hp:');

var_dump($options) ;

// ==================================================================================

// 短的选项参数
$shortopts  = "";
$shortopts .= "f:";  // Required value           -f=someValue  -f='yes  it in string'
$shortopts .= "v::"; // Optional value           -v="yes here  "
$shortopts .= "abc"; // These options do not accept values

// 长选项参数 传值法：  --optName=[optValue]  跟短选项参数一样传值时中间不可出现空格 比如这个错误用法 :  --opt= 4
$longopts  = array(
    "required:",     // Required value           --required='this is required long options '
    "optional::",    // Optional value
    "option",        // No value
    "opt",           // No value
);
$options = getopt($shortopts, $longopts);
var_dump($options);

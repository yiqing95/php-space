<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 22:32
 */
/**
 * One thing of important note would be that getopt() actually respects the '--' option to end an option list.
 *
 * 传递的数据 -- 代表输入结束 那么其后的参数会被忽略
 * -m=1 -m=2    在收集后得到一个数组
 * 如： php getopt2.php -m=1 -m=2 -m=33
 */
?>
<?php

$options = getopt('m:');

if(empty($options)){
    die('you must assign some value to the m option like this : -m=someValue ') ;
    /**
     * 原始例子的用法 貌似是优雅退出 ^-^
     *
     *  $options = getopt("m:g:h:");
        if (!is_array($options) ) {
        print "There was a problem reading in the options.\n\n";
        exit(1);
        }
        $errors = array();
        print_r($options);
     */
}
// 安全获取到以m为key的传值
$m = $options['m'] ;

// echo 'your option for the m is :' , $m ;
echo 'your option for the m is :' , var_dump($m,true) ;


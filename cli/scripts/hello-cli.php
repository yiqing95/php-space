<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 7:54
 */
/**
 * 参考：
 * @see http://php.net/manual/zh/features.commandline.php
 * -------------------------------------------------------------------------------
 * 命令行程序练习
 *
 * --------------------------------------------------------------------------------
 * 执行  php hello-cli.php
 */

?>
<?php
echo 'file path is : ', PHP_EOL ,  __FILE__ ,  PHP_EOL ;

print_r($argv) ;

print_r($_SERVER['argv']) ;

// this is deprecated !
print_r($HTTP_SERVER_VARS) ;

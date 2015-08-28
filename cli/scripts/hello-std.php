<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 8:39
 */
?>
<?php
$stdout = fopen('php://stdout','w') ;

fwrite($stdout,'hi this is content write to the std output stream') ;

fclose($stdout) ;

// 标准错误流

$stderr = fopen('php://stderr','w');
fwrite($stderr,PHP_EOL.'error write to the std err') ;
fclose( $stderr) ;

// 用常量代替
echo str_repeat(PHP_EOL,2) ;
fwrite(STDERR,'write to the std error '.PHP_EOL) ;
fwrite(STDOUT,'write to the std out ') ;
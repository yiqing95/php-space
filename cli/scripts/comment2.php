<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 9:45
 */
/**
 * 解析 输入参数 ： php myscript.php --user=nobody --password=secret -p --access="host=127.0.0.1 port=456"
 */
?>
<?php
function arguments($argv) {
    $_ARG = array();
    foreach ($argv as $arg) {
        if (preg_match('@--([^=]+)=(.*)@',$arg,$reg)) {
            $_ARG[$reg[1]] = $reg[2];
        } elseif(preg_match('@-([a-zA-Z0-9])@',$arg,$reg)) {
            $_ARG[$reg[1]] = 'true';
        }

    }
    return $_ARG;
}

// 调用
$inputs = arguments($argv) ;

print_r([
   $inputs ,
]);


<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 8:02
 */
/**
 * 专用常量
 */
?>

<?php
$stdin = fopen('php://stdin','r') ;

//  读取内容
$line = trim(fgets($stdin)) ;

print_r([
   'content :',
    $line,
]);

// 读取常量  等价上面的哪个stdin 变量？
$line = trim(fgets(STDIN)) ;
print_r(
    [
        'content' =>$line,
    ]
);

echo 'please input some numbers  ' ;
fscanf(STDIN,"%d\n",$number) ;
print_r(
    [
       'input number is :',
        $number ,
    ]
);


<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 8:02
 */
/**
 * ר�ó���
 */
?>

<?php
$stdin = fopen('php://stdin','r') ;

//  ��ȡ����
$line = trim(fgets($stdin)) ;

print_r([
   'content :',
    $line,
]);

// ��ȡ����  �ȼ�������ĸ�stdin ������
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


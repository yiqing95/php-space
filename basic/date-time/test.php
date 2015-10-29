<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/22
 * Time: 16:46
 */
date_default_timezone_set ('Asia/Shanghai');

echo date('YmdHis',time() ) ;

$now = new DateTime();
$clone = clone $now;
$clone->modify('-1 day');
// $clone->getTimestamp();
$yesterday = $clone->getTimestamp();
print_r([
   'yesterday'=>$yesterday ,
]);


$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
$nextyear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);

print_r([
   'tomorrow'=> $tomorrow,
    'lastmoth'=>$lastmonth,
    'nextyear'=>$nextyear ,
    'yesterday'=> mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")) ,
    'yesterday2'=> strtotime('-1 day') ,
    '1 day diff in minit :'=> time()-strtotime('-1 day') , // 一天之差
]);
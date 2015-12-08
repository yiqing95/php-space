<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/12/8
 * Time: 10:24
 */

require_once(__DIR__.'/../../bootstrap.php') ;

print_r (
    Funct\Collection\compact([0,1,false ,2 ,'' , 3])
) ;
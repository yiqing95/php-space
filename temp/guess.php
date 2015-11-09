<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/11/9
 * Time: 21:09
 */
/**
 * 这是一个猜字游戏的小程序
 */

class Chop{
    public static  function guess($actual,$range_a,$range_b)
    {
        $guess = (int)(($range_b +  $range_a) /2 );
        if($actual == $guess){
            echo 'yes it is' , $guess ,PHP_EOL ;
        }elseif($actual > $guess){
            echo 'it is ' , $guess ,PHP_EOL ;
            static::guess($actual,$guess+1,$range_b);
        }else{
            echo 'it is ' , $guess ,PHP_EOL ;
            // $actual < $guess
            static::guess($actual,$range_a,$guess+1);

        }
    }
}

Chop::guess(273,1,1000) ;
<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/9
 * Time: 23:36
 */
/**
 * 有这么一种羊，该羊第一年和第三年会产一只羊，第五年死，问20年后总共会有多少只羊？用php实现
 */

/**
 * 时间大神
 *
 * Class TimeGod
 */
class TimeGod{

    /**
     * 时间每走一年所发生的事情
     */
    public static function yearTick()
    {
         Sheep::yearTick() ;
    }
}

/**
 * Class Sheep
 */
class  Sheep{

    /**
     * 临时日志方法
     *
     * @param $msg
     */
    public static function log($msg)
    {
        echo PHP_EOL , $msg , PHP_EOL ;
    }
    /**
     * 整个羊集合
     *
     * @var array|Sheep[]
     */
    public  static $sheepCollection = [];

    /**
     * 整个羊类对时间的职责 时间每走一年对整个羊类的影响
     */
    public static function yearTick()
    {
        // 整个羊类要统一涨一岁哦！
        /*
        foreach(self::$sheepCollection as $sheepId=>$sheepObj) {
            $sheepObj->grow() ;
        }
        */
        $sheepCollection =  self::$sheepCollection ;
        foreach($sheepCollection as $sheepId=>$sheepObj) {
            $sheepObj->grow() ;
        }

    }

    /**
     * 小羊系统编号
     *
     * @var string
     */
    public $id ;

    /**
     * 当前岁数
     *
     * @var int
     */
    public $currentAge = 0 ;

    /**
     * 构造方法
     */
    public function __construct()
    {
        /**
         * 小羊出生时给其一个唯一标识
         */
        //  $this->id =  '# '.time() ; // 这中做法引起紊乱 ：count(self::$sheepCollection) + 1 ;
       // $this->id =  '# '.microtime() ; // 这中做法引起紊乱 ：count(self::$sheepCollection) + 1 ;
        $this->id =  '# '.uniqid() ; //
        // 把自己推入羊类集合中
        self::$sheepCollection[$this->id] = $this ;

        self::log(sprintf('第 %d 只羊诞生了',count(self::$sheepCollection))) ;
    }

    /**
     * 涨一岁了
     *
     * @return $this
     */
    public function grow()
    {
        self::log("第 {$this->id} 号羊 涨一岁啦! ");
         // $this->currentAge ++ ;
        $this->currentAge += 1 ;


        /**
         * 第一年和第三年产一只羊
         */
        if($this->currentAge == 3 || $this->currentAge == 1){
            // 生小羊啦 ^_^
            $newSheep = new self() ;
            self::log(" 第 {$this->id} 号羊 产下崽崽羊 {$newSheep->id} 号 ") ;
        }

        // 第五年死掉
        if($this->currentAge == 5){
            // 从羊类集合中移除自己啊
            unset(self::$sheepCollection[$this->id]) ;

            self::log(" 第 {$this->id} 号羊在第五年死掉啦!") ;
        }

      return $this ;
    }

}

// 第一只羊诞生了
$firstSheep = new Sheep() ;

$totalYear = 5 ;
for($i=0 ; $i< $totalYear ; $i++){
    echo '第',$i , '年了 ' . PHP_EOL;
    TimeGod::yearTick() ;
}
// 过了20年 我们看看 羊集合还有多少只羊哇！
echo '  还有 [ ', count(Sheep::$sheepCollection) ,' ] 只羊哇！';
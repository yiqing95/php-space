<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/9
 * Time: 23:36
 */
/**
 * ����ôһ���򣬸����һ��͵�������һֻ�򣬵�����������20����ܹ����ж���ֻ����phpʵ��
 */

/**
 * ʱ�����
 *
 * Class TimeGod
 */
class TimeGod{

    /**
     * ʱ��ÿ��һ��������������
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
     * ��ʱ��־����
     *
     * @param $msg
     */
    public static function log($msg)
    {
        echo PHP_EOL , $msg , PHP_EOL ;
    }
    /**
     * �����򼯺�
     *
     * @var array|Sheep[]
     */
    public  static $sheepCollection = [];

    /**
     * ���������ʱ���ְ�� ʱ��ÿ��һ������������Ӱ��
     */
    public static function yearTick()
    {
        // ��������Ҫͳһ��һ��Ŷ��
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
     * С��ϵͳ���
     *
     * @var string
     */
    public $id ;

    /**
     * ��ǰ����
     *
     * @var int
     */
    public $currentAge = 0 ;

    /**
     * ���췽��
     */
    public function __construct()
    {
        /**
         * С�����ʱ����һ��Ψһ��ʶ
         */
        //  $this->id =  '# '.time() ; // ���������������� ��count(self::$sheepCollection) + 1 ;
       // $this->id =  '# '.microtime() ; // ���������������� ��count(self::$sheepCollection) + 1 ;
        $this->id =  '# '.uniqid() ; //
        // ���Լ��������༯����
        self::$sheepCollection[$this->id] = $this ;

        self::log(sprintf('�� %d ֻ������',count(self::$sheepCollection))) ;
    }

    /**
     * ��һ����
     *
     * @return $this
     */
    public function grow()
    {
        self::log("�� {$this->id} ���� ��һ����! ");
         // $this->currentAge ++ ;
        $this->currentAge += 1 ;


        /**
         * ��һ��͵������һֻ��
         */
        if($this->currentAge == 3 || $this->currentAge == 1){
            // ��С���� ^_^
            $newSheep = new self() ;
            self::log(" �� {$this->id} ���� ���������� {$newSheep->id} �� ") ;
        }

        // ����������
        if($this->currentAge == 5){
            // �����༯�����Ƴ��Լ���
            unset(self::$sheepCollection[$this->id]) ;

            self::log(" �� {$this->id} �����ڵ�����������!") ;
        }

      return $this ;
    }

}

// ��һֻ������
$firstSheep = new Sheep() ;

$totalYear = 5 ;
for($i=0 ; $i< $totalYear ; $i++){
    echo '��',$i , '���� ' . PHP_EOL;
    TimeGod::yearTick() ;
}
// ����20�� ���ǿ��� �򼯺ϻ��ж���ֻ���ۣ�
echo '  ���� [ ', count(Sheep::$sheepCollection) ,' ] ֻ���ۣ�';
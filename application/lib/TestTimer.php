<?php
namespace app\lib;
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 2018/8/19
 * Time: 下午8:01
 */
use think\swoole\template\Timer;
class TestTimer extends Timer
{
    public function run()
    {
        $a = 1 / 0;
        $i=0;
        // TODO: Implement run() method.
        while($i<10){
            var_dump(12);
            $i++;
            sleep(1);
        }
    }

    public function initialize($args)
    {
        $a = 1 / 0;
        echo '213123';
        // TODO: Implement initialize() method.
    }
}
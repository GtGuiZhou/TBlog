<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:16
 */

namespace app\common\controller;


use app\common\model\SysConfigModel;
use think\Controller;
use think\exception\ValidateException;
use think\facade\Cache;

class SysconfigBase extends Controller
{
    /**
     * 在这儿可以配置公共的，在子类可以用setConfigDefault方法添加或更改
     * @var array 配置默认值
     */
    private $configDefault = [
        'music' => []
    ];

    /**
     * 读取配置，并且缓存配置
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function read(){
        $key = input('key',false);
        if (!$key)
            throw new ValidateException('key不能为空');
        // 获取最近的一条配置，这样即使配置被损坏也能够还原
        $config = SysConfigModel::where('config_name', $key)
            ->order('create_time','desc')
            ->cache($key,0)->find();
        if (!$config && isset($this->configDefault[$key])){
            $config = $this->configDefault[$key];
        }
        return success($config);
    }

    /**
     * 更新系统配置
     * @return \think\response\Json
     */
    public function update(){
        $key = input('key',false);
        if (!$key)
            throw new ValidateException('key不能为空');
        $value = input('value',false);
        if (!$value)
            throw new ValidateException('value不能为空');

        // 添加数据
        SysConfigModel::create([
            'config_name'   => $key,
            'value'         => $value
        ]);
        // 更新缓存
        Cache::rm($key);
        return success();
    }

    /**
     * 设置配置的某个键的默认值，当这个键在数据库中不存在时，可以使用这个默认值
     * @param $key
     * @param $value
     */
    protected function setConfigDefault($key,$value){
       $this->configDefault[$key] = $value;
    }
}
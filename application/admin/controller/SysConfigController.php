<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 下午12:25
 */

namespace app\admin\controller;


use app\common\model\SysConfigModel;
use think\Controller;
use think\exception\ValidateException;
use think\facade\Cache;

class SysConfigController extends Controller
{

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
            ->order('id','desc')
            ->cache($key,0)->find();

        return success($config);
    }

    /**
     * 更新系统配置
     * @return \think\response\Json
     */
    public function updateGroupTree(){
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
}
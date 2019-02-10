<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-9
 * Time: 上午10:55
 */

namespace app\common\lib;


use app\common\model\SysConfigModel;
use think\facade\Cache;
use think\Model;

trait GroupControllerTrait
{
    /**
     * 永久缓存，在updateGroup的时候更新缓存
     * 当前控制器对应的模型
     * @var $model Model
     */
    protected $model = null;

    public function getGroupTree(){
        $key = $this->getCurrGroupKey();
        // 获取最近的一条配置，这样即使分组配置被损坏也能够还原
        $config = SysConfigModel::where('config_name', $key)
            ->order('id','desc')
            ->cache($key,0)->find();
        if (!$config){
            $tree = [];
        } else {
            $tree = $config['value'];
        }

        return success($tree);
    }

    /**
     * 更新分组数据，并且更新缓存
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function updateGroupTree(){
        $key = $this->getCurrGroupKey();
        // 添加数据
        SysConfigModel::create([
            'config_name'   => $key,
            'value'         => input('tree')
        ]);
        // 更新缓存
        Cache::rm($key);
        return success();
    }

    public function getCurrGroupKey(){
        $table = $this->model->getTable();
        $key = "groupTree:$table";
        return $key;
    }
}
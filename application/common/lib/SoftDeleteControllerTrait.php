<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午10:49
 */

namespace app\common\lib;


use think\Model;

/**
 * 软删除控制器拓展
 * Trait SoftDeleteControllerTrait
 * @package app\common\lib
 */
trait SoftDeleteControllerTrait
{
    /**
     * 当前控制器对应的模型，需要在手动initialize中初始化
     * @var $model Model
     */
    protected $model = null;

    public function indexOfTrashed()
    {
        $order = input('order', 'desc');
        $index = input('index', 1);
        $size = input('size', 10);
        $list = $this->model
            ::onlyTrashed()  // 该方法必须在model中 use SoftDelete;才存在
            ->order($this->model->getPk(), $order)
            ->page($index, $size)
            ->select();
        $total = $this->model
            ->count($this->model->getPk());
        return success(['list' => $list,'page' => [
            'index' => (int)$index,'size' => (int)$size,'total' =>  (int)$total
        ]]);
    }

    public function recover(){
        $model = $this->model::onlyTrashed()->find(input('id'));
        $model->restore();

        return success();
    }

}
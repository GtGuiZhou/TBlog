<?php
/**
 * Created by PhpStorm.
 * User: gtguizhou
 * Date: 19-3-19
 * Time: 上午9:50
 */

namespace app\common\controller;


use app\common\model\MusicModel;
use think\Controller;
use think\Model;

class AdminBase extends Controller
{

    /**
     * 软删除字段，会在更新数据时过滤该字段
     * @var string
     */
    protected $deleteTimeField = 'delete_time';

    /**
     * 当前控制器对应的模型，需要在手动initialize中初始化
     * @var $model Model
     */
    protected $model = null;

    /**
     * 执行add方法后的返回值类型,可选model或者null或者pk
     * 默认返回pk(主键)
     * model即为刚创建的model
     * @var string
     */
    protected $addAfterResponseType = 'pk';


    /**
     * 获取分页数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $order = input('order', 'desc');
        $index = input('index', 1);
        $size = input('size', 10);

        $list = $this->model
            ->order($this->model->getPk(), $order)
            ->page($index, $size)
            ->select();
        $total = $this->model
            ->count($this->model->getPk());
        return success(['list' => $list,'page' => [
            'index' => (int)$index,'size' => (int)$size,'total' =>  (int)$total
        ]]);
    }

    /**
     * 获取全部数据
     * @return \think\response\Json
     */
    public function indexAll(){
        return success($this->model->select());
    }

    /**
     * 获取软删除数据
     * @return \think\response\Json
     */
    public function indexOfTrashed(){
        $order = input('order', 'desc');
        $index = input('index', 1);
        $size = input('size', 10);

        $list = $this->model::onlyTrashed()
            ->order($this->model->getPk(), $order)
            ->page($index, $size)
            ->select();
        $total = $this->model::onlyTrashed()
            ->count($this->model->getPk());
        return success(['list' => $list,'page' => [
            'index' => (int)$index,'size' => (int)$size,'total' =>  (int)$total
        ]]);
    }

    /**
     * 读指定数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function read()
    {
        $id = input('id');
        return success($this->model->where($this->model->getPk(),$id)->findOrFail());
    }

    /**
     * 新增一条数据
     * @return \think\response\Json
     */
    public function add()
    {
        $this->model->allowField(true)->save(input());
        switch ($this->addAfterResponseType){
            case 'model':
                return success($this->model);
            case 'pk':
                $pk = $this->model->getpk();
                return success([$pk => $this->model->$pk]);
            default:
                return success();
        }
    }

    /**
     * 删除指定数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function delete()
    {
        /**
         * 这么写是为了能够在模型开启软删除的时候，能够正常使用软删除
         */
        $model = $this->model->findOrFail(input('id'));
        $model->delete();
        return success();
    }

    /**
     * 真实删除数据（开启软删除的时候有效）
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function deleteReal(){
        $model = $this->model::onlyTrashed()->findOrFail(input('id'));
        $model->delete(true);
        return success();
    }

    /**
     * 恢复被软删除的数据
     * @return \think\response\Json
     */
    public function recover(){
        $model = $this->model::onlyTrashed()->findOrFail(input('id'));
        $model->restore();
        return success();
    }


    /**
     * 更新指定数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function update()
    {

        $model =  $this->model->findOrFail(input('id'));
        $data = input();
        unset($data[$this->deleteTimeField]);
        $model->isUpdate(true)
            ->save($data);

        return success();
    }
}
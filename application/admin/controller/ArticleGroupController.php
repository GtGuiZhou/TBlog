<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-9
 * Time: 下午1:05
 */

namespace app\common\controller;


use app\common\lib\CrudBaseTrait;
use app\common\model\ArticleGroupModel;
use think\console\command\make\Model;
use think\Controller;

class ArticleGroupController extends Controller
{
    use CrudBaseTrait;

    /**
     * @var $model ArticleGroupModel
     */
    protected $model = null;

    protected function initialize()
    {
        $this->model = new Model;
    }

    public function tree(){
        $tree = $this->model->GroupTree();
        return success($tree);
    }

}
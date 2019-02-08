<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:16
 */

namespace app\admin\controller;


use app\common\lib\CrudBaseTrait;
use app\common\lib\SoftDeleteControllerTrait;
use app\common\model\ArticleModel;
use think\Controller;

class ArticleController extends Controller
{
    use CrudBaseTrait;
    use SoftDeleteControllerTrait;

    protected function initialize()
    {
        $this->model = new ArticleModel();
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:16
 */

namespace app\api\controller;


use app\common\lib\CrudBaseTrait;
use app\common\lib\GroupControllerTrait;
use app\common\lib\StarControllerTrait;
use app\common\model\ArticleModel;
use think\Controller;

class ArticleController extends Controller
{
    use CrudBaseTrait;
    use StarControllerTrait;
    use GroupControllerTrait;

    protected function initialize()
    {
        $this->allowUpdateGroupTree = false;
        $this->model = new ArticleModel();
    }
}
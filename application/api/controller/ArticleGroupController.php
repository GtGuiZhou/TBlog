<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-9
 * Time: 下午1:05
 */

namespace app\api\controller;


use app\common\lib\CrudBaseTrait;
use think\console\command\make\Model;
use think\Controller;

class ArticleGroupController extends Controller
{
    use CrudBaseTrait;

    protected function initialize()
    {
        $this->model = new Model;
    }

    public function tree(){

    }
}
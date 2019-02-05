<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:16
 */

namespace app\api\controller;


use app\api\model\ArticleModel;
use think\Controller;

class ArticleController extends Controller
{
    private $model = null;
    protected function _initialize()
    {
        $this->model = new ArticleModel();
    }


}
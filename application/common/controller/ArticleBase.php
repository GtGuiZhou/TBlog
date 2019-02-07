<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午10:15
 */

namespace app\common\controller;


use app\common\model\ArticleModel;
use think\Controller;

class ArticleBase extends Controller
{
    /**
     * @var $model ArticleModel
     */
    protected $model = null;


    protected function initialize()
    {
        $this->model = new ArticleModel();
    }

    public function index()
    {
        $order = input('order', 'desc');
        $page = input('page', 1);
        $size = input('size', 10);
        $list = $this->model
                ->where('id', $order)
                ->page($page, $size)
                ->select();

        return success($list);
    }
}
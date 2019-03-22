<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:16
 */

namespace app\admin\controller;


use app\common\controller\AdminBase;
use app\common\lib\GroupControllerTrait;
use app\common\lib\SoftDeleteControllerTrait;
use app\common\model\ArticleModel;

class ArticleController extends AdminBase
{
    use SoftDeleteControllerTrait;
    use GroupControllerTrait;


    protected $groupTableName = 'sys_article_group';

    /**
     * @var $model ArticleModel
     */
    protected $model = null;

    protected function initialize()
    {
        $this->model = new ArticleModel();
    }

}
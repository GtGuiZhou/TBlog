<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:16
 */

namespace app\admin\controller;


use app\common\lib\CrudBaseTrait;
use app\common\lib\GroupControllerTrait;
use app\common\lib\SoftDeleteControllerTrait;
use app\common\model\ArticleModel;
use think\Controller;

class ArticleController extends Controller
{
    use CrudBaseTrait;
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

    public function add()
    {
        $this->validate(input(),[
            'title|标题' => 'require|length:1,255',
            'cover|封面' => 'require|url',
        ]);
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
}
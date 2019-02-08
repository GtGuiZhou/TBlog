<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:26
 */

namespace app\common\model;


use think\Model;
use think\model\concern\SoftDelete;

class ArticleModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;
    protected $pk = 'id';
    protected $table = 'sys_article';
}
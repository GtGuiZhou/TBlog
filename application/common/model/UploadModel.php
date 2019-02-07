<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午12:16
 */

namespace app\common\model;


use think\Model;


class UploadModel extends Model
{
    protected $table = 'sys_upload';
    protected $pk = 'id';
    protected $autoWriteTimestamp = true;
    protected $hidden = ['local'];
}
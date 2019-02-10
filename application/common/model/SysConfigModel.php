<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 下午12:46
 */

namespace app\common\model;


use think\Model;

class SysConfigModel extends Model
{
    protected $table = 'sys_config';
    protected $autoWriteTimestamp = true;
    protected $json = ['value'];

    // 追加属性
    protected $append = [
        'create_time_text',
        'update_time_text'
    ];

    public function getCreateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['release_time']) ? $data['release_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    public function getUpdateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['release_time']) ? $data['release_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

}
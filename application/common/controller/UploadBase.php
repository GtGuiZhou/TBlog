<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 下午6:20
 */

namespace app\common\controller;


use app\common\model\UploadModel;
use think\Controller;

class UploadBase extends Controller
{

    /**
     * 上传模型
     * @var $model UploadModel
     */
    private $model = null;

    public function initialize()
    {
        $this->model = new UploadModel();
    }

    public function index(){
        switch (input('action')){
            case 'config':
                return $this->config();
        }
    }

    public function config(){
        return json(json_decode());
    }

    public function read(){
        $file = $this->model
                ->where('filename',input('filename'))
                ->findOrFail();

        if ($file['device'] == 'local'){
            return $this->localFileResponse($file);
        } else {
            return redirect($file['url']);
        }
    }

    private function localFileResponse($file){
        return download('../uploads/'.$file['local'],time(),false,360,true);
    }

    public function image(){   // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        if (!$file){
            return json([
                'code' => 1011,
                'msg'  => '上传文件不存在',
                'data' => null
            ]);
        }
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file
            ->validate(['size'=>2097152,'ext'=>'bmp,jpeg,jpg,png,gif'])
            ->move( '../uploads');

        $model = UploadModel::create([
                // 文件名称当前系统时间微秒的md5值
                'filename' => $info->getFileName(),
                'url'      => request()->domain() . '/api/upload/image?filename='.$info->getFileName(),
                'local'     => $info->getSaveName(),
                'device'   => 'local',
                ]);
        if($info){
            return json([
               'code' => 0,
               'msg'  => 'success',
               'data' => $model
            ]);
        }else{
            return json([
                'code' => 0,
                'msg'  => 'success',
                'data' => $file->getError()
            ]);
        }}
}
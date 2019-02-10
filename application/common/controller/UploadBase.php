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
use think\File;

class UploadBase extends Controller
{

    /**
     * 上传模型
     * @var $model UploadModel
     */
    private $model = null;

    /**
     * 现在上传文件大小（单位：M)
     * @var int $limitUploadSize
     */
    protected $limitUploadSize = 2;

    /**
     * 允许上传的文件拓展
     * @var string $allowUploadExt
     */
    protected $allowUploadExt  = 'bmp,jpeg,jpg,png,gif';

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

    /**
     * 上传文件
     * @return \think\response\Json
     */
    public function file(){
        $file = request()->file('file');
        if (!$file){
            return json([
                'code' => 1011,
                'msg'  => '上传文件不存在',
                'data' => null
            ]);
        }
        // 移动到框架应用根目录/uploads/ 目录下
        /**
         * @var $file File
         */
        $info = $file
            ->validate(['size'=>$this->limitUploadSize * 1024 * 1024,'ext'=>$this->allowUploadExt])
            ->move( '../uploads');

        if($info){
            $model = UploadModel::create([
                // 文件名称当前系统时间微秒的md5值
                'filename' => $info->getFileName(),
                'url'      => request()->domain() . '/api/upload/read?filename='.$info->getFileName(),
                'local'     => $info->getSaveName(),
                'device'   => 'local',
            ]);
            return json([
               'code' => 0,
               'msg'  => 'success',
               'data' => $model
            ]);
        }else{
            return json([
                'code' => 1012,
                'msg'  => $file->getError(),
                'data' => null
            ]);
        }}


        /**
         * 添加允许上传的文件类型
         * @param $ext string
         */
        protected function appendAllowExt($ext){
            $this->allowUploadExt = "$this->allowUploadExt,$ext";
        }
}
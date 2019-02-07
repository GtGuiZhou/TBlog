<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 下午6:20
 */

namespace app\api\controller;


use think\Controller;

class UeditorController extends Controller
{
    public function index(){
        switch (input('action')){
            case 'config':
                return $this->config();
        }
    }

    public function config(){
        return json(json_decode());
    }
}
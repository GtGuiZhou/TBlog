<?php
namespace app\index\controller;

class IndexController
{
    public function index()
    {
        throw new ValidateException('2312213213231');
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}

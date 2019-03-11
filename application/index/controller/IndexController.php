<?php
namespace app\index\controller;

class IndexController
{
    public function index()
    {
    }

    public function hello($name = 'ThinkPHP5')
    {
        echo 'test';
        return 'hello,' . $name;
    }
}

<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Env;

class Index extends Controller
{
    public function index()
    {
        //绝对路径指定模板文件，也是前端执行的入口文件
        return $this->fetch(Env::get('ROOT_PATH') . '/public/index.html');
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}

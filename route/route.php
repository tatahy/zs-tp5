<?php
// +----------------------------------------------------------------------
// |based on ThinkPHP [http://thinkphp.cn]
// +----------------------------------------------------------------------
// | Copyright (c) 2019-2020  All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

//添加类引用
use think\facade\Route;
// use think\facade\Env;

Route::rule('/', 'index/index', 'post|get');

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

//路由规则：前端发送的‘emqx/httpapi’路由字符串(不区分大小写index，接受跨域请求，只接受POST方法)
//路由到emqx模块/httpapi控制器/index操作
Route::rule('emqx/httpapi$', 'emqx/httpapi/index', 'post')
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain();

// Route::rule('emqx/httpapi$', function () {
//     // return '<br><h1 style="text-align:center"> emqx/httpapi$ </h1>';
//     $res = [
//         "apiData" => [],
//         "data" => [
//             [
//                 "version" => "4.0.7",
//                 "node" => "emqx_on_CentOS7@120.79.25.121",
//             ]
//         ],
//         "code" => 0
//     ];
//     return json_encode($res);
// }, 'post')
//     ->header('Access-Control-Allow-Origin', '*')
//     ->header('Access-Control-Allow-Credentials', 'true')
//     ->allowCrossDomain();

// Route::rule('terminal/[:api]','terminal/index/index','post');
Route::rule('terminal', 'terminal/index/index', 'POST')
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain();

Route::rule('equipment/:api', 'equipment/index/index', 'POST')
    // ->pattern(['api' => '\w+'])
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain();

Route::rule('login', 'login/index/index', 'POST')
    // ->pattern(['api' => '\w+'])
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain();

//设置全局MISS路由，一旦设置了MISS路由，相当于开启了强制路由模式
//必须严格给每一个访问地址定义路由规则（包括首页），否则将抛出异常。
Route::miss(function () {
    return '<br><h1 style="text-align:center"> 404 not found!</h1>';
});


return [];

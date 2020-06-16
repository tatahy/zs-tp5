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
use think\facade\Env;

Route::rule('/','index/index','post|get');

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

return [];

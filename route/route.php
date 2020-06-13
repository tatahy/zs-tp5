<?php
// +----------------------------------------------------------------------
// |based on ThinkPHP [http://thinkphp.cn]
// +----------------------------------------------------------------------
// | Copyright (c) 2019-2020  All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

// use think\facade\Route;

Route::rule('/','index/index','post|get');

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

return [];

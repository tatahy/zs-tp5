<?php
// +----------------------------------------------------------------------
// |based on ThinkPHP [http://thinkphp.cn]
// +----------------------------------------------------------------------
// | Copyright (c) 2019-2020  All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

// use think\facade\Container;

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 加载composer安装的第三方依赖库
// require_once __DIR__ . '/../vendor/autoload.php';

// 支持事先使用静态方法设置Request对象和Config对象

// 执行应用并响应
Container::get('app')->run()->send();

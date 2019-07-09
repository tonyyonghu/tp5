<?php
///str_replace('\\', '/', 需要替换的字符串)
define('APP_PATH', str_replace('\\', '/', __DIR__ . '/application/'));
// define('BIND_MODULE','index');//设置后在url中不用写模块了，直接写控制器=》http://www.tp5.com/hello_world_yellow/index

// 加载框架基础引导文件
require str_replace("\\","/",__DIR__).'/thinkphp/base.php';

// 添加额外的代码
// ...
// 执行应用
\think\App::run()->send();
// 加载框架引导文件
// 
//require __DIR__ . '/thinkphp/start.php';
//\think\App::route(false);
?>
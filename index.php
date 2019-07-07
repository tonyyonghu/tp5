<?php
///str_replace('\\', '/', 需要替换的字符串)
define('APP_PATH', str_replace('\\', '/', __DIR__ . '/application/'));


// 加载框架基础引导文件
require str_replace("\\","/",__DIR__).'/thinkphp/base.php';

// 添加额外的代码
// ...
// 执行应用
//\think\App::run()->send();
// 加载框架引导文件
//
echo 11111;
echo 22222;
echo 33333;
echo 44444;
require __DIR__ . '/thinkphp/start.php';
?>

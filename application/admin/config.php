<?php
 // 获取public目录
    define('PUBLIC_PATH','/public/');
    return [
    	// 视图输出字符串内容替换

        'view_replace_str' => [

            // 静态资源目录

            '__STATIC__'    => PUBLIC_PATH. 'static',

            // 文件上传目录

            '__UPLOADS__'   => PUBLIC_PATH. 'uploads',

            // JS插件目录

            '__LIBS__'      => PUBLIC_PATH. 'static/libs',

            // 后台CSS目录

            '__ADMIN_CSS__' => PUBLIC_PATH. 'static/admin/css',

            // 后台JS目录

            '__ADMIN_JS__'  => PUBLIC_PATH. 'static/admin/js',

            // 后台IMG目录

            '__ADMIN_IMG__' => PUBLIC_PATH. 'static/admin/img',

            // 前台CSS目录

            '__HOME_CSS__'  => PUBLIC_PATH. 'static/home/css',

            // 前台JS目录

            '__HOME_JS__'   => PUBLIC_PATH. 'static/home/js',

            // 前台IMG目录

            '__HOME_IMG__'  => PUBLIC_PATH. 'static/home/img',

        ],
    ];
?>
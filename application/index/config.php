<?php
	return [
			//模板引入js,css,img路径常量设置
	'view_replace_str' => [
	            '__CSS__' =>'/static/admin/css',
	            '__JS__'  =>'/static/admin/js',
	            '__IMG__' =>'/static/admin/img',
	            '__FONT__' =>'/static/admin/img',
	            '__HOME__' =>'/public/static/home/',
	    ],
	'template' => [
    	// 模板路径
    	'view_path'    => APP_PATH.config('default_module').'/'.config('template.view_path'),
	],

	];
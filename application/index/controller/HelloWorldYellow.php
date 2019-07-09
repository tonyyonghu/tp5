<?php
namespace app\index\controller;
use think\Controller;
use think\Url;
	class HelloWorldYellow extends Controller{
		public function index($name="world"){
			/*驼峰命令时，url写法hello_world*/
			echo Url::build('index','name=thinkphp');
			return "hello ".$name;
		}
	}
?>
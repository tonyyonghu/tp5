<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\captcha\Captcha;
	
	class Verify extends Controller{
		public function Verify(){
	        $config =    array(
	        'expire' => 120,  //验证码输入错误后的有效时间，输入正确则失效
	        'fontSize'    =>    24,    // 验证码字体大小
	        'length'      =>    4,     // 验证码位数
	        'useNoise'    =>    false, // 关闭验证码杂点
	        'useCurve' => false,  //关闭曲线
	        'imageW'  =>170,     //宽度
	        'imageH'  =>66,   //高度
	        //'useImgBg'  =>true,  //背景
	        );
	        $captcha = new Captcha($config);
	        $captcha->codeSet = '0123456789'; 
			return $captcha->entry();
	    }

	   
	}


?>
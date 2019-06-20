<?php
namespace app\index\controller;
use think\Model;
use model\User;
use think\Controller;
use think\View;
use think\Env;

class Index extends Controller
{
	use \traits\controller\Jump;
    public function index()
    {
    	$view=new View();
    	$user=new User();
    	// $user->sayhello();
    	
    	
    	$view->name="THINKPHP";
       return view();
    	//return APP_PATH."\r\n";
	}

	public function hello()
	{
		return "HELLO world";
	}
	
	function king($n,$m)
	{
		$monkeys=range(1,$n);
		$i=0;
		while(count($monkeys)>1){
			if(($i+1)%$m==0){
				unset($monkeys[$i]);
			}
			else
			{
				array_push($monkeys,$monkeys[$i]);
				unset($monkeys[$i]);
				
			}
			$i++;
		}
		return current($monkeys);
		
	}
	
	function myfirstpdf(){
		$content="数据库的发生激烈的福建省两地分居";
		$title="hello";
		setPdf($content,$title);
		
	}

	function demo()
	{
		$data = ['name'=>'thinkphp','url'=>'thinkphp.cn'];
        // 指定json数据输出
        return json(['data'=>$data,'code'=>1,'message'=>'操作完成']);
	}
}

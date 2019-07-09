<?php
namespace app\admin\controller;
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
   	
    	// dump(config());
    	$this->assign("name","THINKPHP");
    	
       return view();
    	//return APP_PATH."\r\n";
	}



	public function chart()
	{
		return view();
	}


	public function calendar()
	{
		return view();
	}

	public function basic_form()
	{
		return view();
	}

	public function email()
	{
		return view();
	}

	public function empty()
	{
		return view();
	}

	public function faq()
	{
		return view();
	}

	public function form_layouts()
	{
		return view();
	}

	public function gallery()
	{
		return view();
	}

	public function invoice()
	{
		return view();
	}

	public function invoice_page()
	{
		return view();
	}

	public function login()
	{
		return view();
	}

	public function maps()
	{
		return view();
	}

	public function media()
	{
		return view();
	}

	public function profile()
	{
		return view();
	}

	public function register()
	{
		return view();
	}

	public function search_result()
	{
		return view();
	}

	public function tables()
	{
		return view();
	}

	public function ui_buttons()
	{
		return view();
	}


	public function ui_cards()
	{
		return view();
	}

	public function ui_progressbars()
	{
		return view();
	}

	public function ui_timeline()
	{
		return view();
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

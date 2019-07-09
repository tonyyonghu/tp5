<?php
namespace app\index\controller;
use think\Model;
use model\User;
use think\Controller;
use think\View;
use think\Env;
use think\Db;
use think\Request;
use think\Url;
use think\Route;
use think\Cache;
use think\Config;


class Index extends Calendars
{
	use \traits\controller\Jump;


    public function index($name="")
    {

    	$options = [
		    // 缓存类型为File
		    'type'  =>  'File', 
		    // 缓存有效期为永久有效
		    'expire'=>  0, 
		    //缓存前缀
		    'prefix'=>  'think',
		     // 指定缓存目录
		    'path'  =>  APP_PATH.'runtime/cache/',
		];
		Cache::connect($options);
		Cache::set('name',"朱飞",3600);
		dump(Cache::get('name'));
		// if("thinkphp"==$name){
		// 	$this->success("欢迎使用 Thinkphp 5.0",'hello');
		// }
		// else
		// {
		// 	$this->error('错误的name','guest');
		// }
		//print_r($this->request->param());  
		$result = Db::query('select * from renshi_admin where aId = ?', [5]);
		//dump($result[0]);
		$result = Db::query('select * from renshi_admin where aId=:id', ['id' => 4]);
		//dump($result[0]);
		$data=Db::name('admin')->find();
		//dump($data);
		//echo Url::build("index");
		//var_dump($data);
    	$this->LoginTrue();
    	$view=new View();
    	$user=new User();


    	//echo htmlspecialchars(cn_substrR("时代峻峰洛杉矶的法律圣诞节",40));
    	// $user->sayhello();
    	// print_r(session_save_path());
    	// $rs_system=Db::table('renshi_system')->where('sId',1)->value('sLoginTimeout');
    	// var_dump($rs_system);exit;
    	//$rs_system=Db::table('renshi_system')->where('sId',1)->column('sLoginTimeout');
    	
    	//$systemName=M("system");
        //$rs_systemName=$systemName->field("sName,sDepartment,sCopyrightName,sCopyrightAuthor,sVersion,sCopyrightAuthorTel,sCopyrightAuthorQQ")->where("sId=1")->find();
    	
    	$rs_systemName=Db::name('system')->where('sId',1)->column("sName,sDepartment,sCopyrightName,sCopyrightAuthor,sVersion,sCopyrightAuthorTel,sCopyrightAuthorQQ");
    	 
		$keys=array_keys($rs_systemName);
        $this->assign("rs_systemName",$rs_systemName[$keys[0]]);
        $aUser=session("aUser");
        $this->assign("aUser",$aUser);
        $logintime=session("loginTime");
        $this->assign("logintime",$logintime);
        $aName=session("aName");
        $this->assign("aName",$aName);
        $aPowers=session("aPowers");
        //$admin_role=M("admin_role");
        if($aPowers==0){
            $powersName="系统管理员";
            $powersValue="0";
        }else{
            //$rs_role=$admin_role->where("arId={$aPowers}")->field("arName,arPowers")->find();
        	$rs_role=Db::table("renshi_admin_role")->where("arId={$aPowers}")->column("arName,arPowers");
            $powersName=$rs_role["arName"];
            $powersValue=$rs_role["arPowers"];
            $morepowersValue=$powersValue;
            $powersValue=explode("-", $powersValue);
        }
        $this->assign("powersName",$powersName);
        // $this->assign("morepowersValue",$morepowersValue);
        $this->assign("powersValue",$powersValue);
        $aDid=session("aDid");
        //$department=M("department");
       // echo $aDid;
        $this->assign("aDid",$aDid);
        //$rs_department=$department->where("dId={$aDid}")->find();
        $rs_department=Db::name("department")->where("dId",$aDid)->select();
		//echo $rs_department[0]['dId'];
       // var_dump($rs_department);
        $this->assign("rs_department",$rs_department[0]);
        //获取当前日期
        $this->NowToday();
        // 活动自定义菜单下载
        //$hdmenu=M("hdmenu");
        $rs_hdmenu=Db::name("hdmenu")->select();
        $this->assign("rs_hdmenu",$rs_hdmenu);


       return view();
    	//return APP_PATH."\r\n";
	}


	public function guest()
	{
		return "guest";
	}
	public function hello($id="45")
	{
		//echo Url::build("hello",'id=45&name=张三');
		print_r($this->request->param());
		echo 44444;
	//	print_r($this->request->param());
		//return $this->fetch();
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

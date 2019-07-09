<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;

	class Login extends Controller{



		public function Index(){
			
			//Session::clear();
	       if(strlen(session("aUser"))>0){

	          $this->success("你已登陆，正在跳转","Index/index");
	       }else{
	           // $systemName=M("system");
	           // $rs_systemName=$systemName->field("sLogo,sName,sCopyrightName,sCopyrightAuthor,sCheckCodeSwitch,sVersion,sCopyrightAuthorTel,sCopyrightAuthorQQ")->where("sId=1")->find();

	          $rs_systemName= Db::table('renshi_system')->where('sId',1)->select();

	          // var_dump($rs_systemName[0]);exit;
	           $this->assign("rs_systemName",$rs_systemName[0]);
	            $year=date("Y");
	            $this->assign("year",$year);
	            return view();
	       }
	    }

	    public function CheckLogin(){
            // $system=M("system");
            // $rs_system=$system->field("sCheckCodeSwitch,sErrorPwdLockNum,sLoginTimeout")->where("sId=1")->find();
            $rs_system=Db::table('renshi_system')->where('sId',1)->column('sCheckCodeSwitch,sErrorPwdLockNum,sLoginTimeout');
            //验证验证码
            //
           // var_dump($rs_system);exit;

            if($rs_system[1]["sCheckCodeSwitch"]==1){
            	$code = input('code');
		        if (!captcha_check($code)){
		            $this->error('验证码错误！');
		        }

                // $Verify = new \Think\Verify;
                // if(!$Verify->check($_POST['code'])){
                //     $this->error("验证码错误！");
                //     return;
                // }
             }
            // $admin=M("admin");
            $query = new \think\db\Query();
			
            $aUser=input("aUser");
            $aPwd=md5(input("aPwd"));
            // $rs=$admin->where("aUser='{$aUser}' OR aTel='{$aUser}'")->find();
            $query->table('renshi_admin')->where("aUser='{$aUser}' OR aTel='{$aUser}'");
			$rs=Db::find($query);
			 // var_dump($rs);exit;
            if(count($rs)>0){

                if($rs["aErrorPwdNum"]>=$rs_system[1]["sErrorPwdLockNum"]){
                    $this->error("该账号输入密码错误已达到".$rs_system[1]['sErrorPwdLockNum']."次，被系统锁定","",6);
                }
                elseif($aPwd==$rs["aPwd"])
                {
                    if($rs["aStatic"]==0){
                        $this->error("对不起，该账户已被系统管理员停用！","",5); 
                        exit;
                    }
                    else
                    {
	                    $aLoginNum=$rs["aLoginNum"]+1;
						$data["aLoginNum"]=$aLoginNum;
						$data["aErrorPwdNum"]=0;
						// $admin->where("aUser='{$aUser}' OR aTel='{$aUser}'")->save($data);
						Db::table('renshi_admin')->where("aUser='{$aUser}' OR aTel='{$aUser}'")->update($data);
						
	                    session("aId",$rs["aId"]);
						session("aUser",$rs["aUser"]);
	                    session("aPowers",$rs["aPowers"]);
	                    session("aName",$rs["aName"]);
	                    session("aDid",$rs["aDid"]);
	                    session("aLN",$aLoginNum);
	                    session("time",time());
	                    $_SESSION['expiretime'] = time() + (($rs_system[1]["sLoginTimeout"])*60);
	                    $loginTime=date("Y-m-d H:i:s");
	                    session("loginTime",$loginTime);
	                    $this->success("登陆成功",'/Index/');
                    }
                }
                else
                {
                    if($rs["aId"]==1){
                       $this->error("密码不正确"); 
                    }
                    else{
	                    $errPwdNum=$data["aErrorPwdNum"]=($rs["aErrorPwdNum"])+1;
	                    //$admin->where("aUser='{$aUser}' OR aTel='{$aUser}'")->save($data);
	                    Db::table('renshi_admin')->where("aUser='{$aUser}' OR aTel='{$aUser}'")->insert($data);
                    	$this->error("密码不正确，已输入错误".$errPwdNum."次，连续输入错误达到 ".$rs_system[0]["sErrorPwdLockNum"]."次自动锁定","",6);
                    	exit;
                    }
                }
            }else{
                if(strlen($aUser)==11 &&  is_numeric($aUser) ==true){
                    $this->error("手机号码不存在");
                    exit;
                }else{
                    $this->error("用户名不存在");
                    exit;
                }
            }
      }




	}
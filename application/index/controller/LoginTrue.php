<?php
namespace app\index\controller;
use think\Controller;
use think\View;
use think\Db;
	
	class LoginTrue extends Controller{

		public function __construct()
		{
			parent::__construct();
			
			$this->CheckAdminSession();

		}

		public function CheckAdminSession()
		{
			// $rs_system = $system->field("sLoginTimeout")
			// db('user')->where('sId',1)->find();
			$rs_system=Db::table('renshi_system')->where('sId',1)->value('sLoginTimeout');

			if (isset($_SESSION['expiretime'])) {
	            if ($_SESSION['expiretime'] < time()) {
	                unset($_SESSION['expiretime']);
	                session(null);
	                $this->error("登陆超时，请重新登陆！",'login/index');
	                exit();
	            } else {
	                $_SESSION['expiretime'] = time() + (($rs_system) * 60); // 刷新时间戳
	            }
	        }
		}



		public function ExitLogin()
	    {
	        session(null);
	        $this->success("成功退出", "login/index");
	    }

	    public function LoginTrue()
	    {
	        if (! session("aUser")) {
	            ?>
	<script type="text/javascript">
				window.location.href="index/login";
	            </script>
		<?php
		exit;
	            // $this->error("Sorry ！你还没有登录，请登陆后访问！",U('/login/index/'));
	            // exit;
	        }
	    }


	}
?>
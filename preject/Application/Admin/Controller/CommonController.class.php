<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;

/**
 * 公共控制器
 * 后台控制器除login外必须继承我
 * @author 潘宏钢 <619328391@qq.com>
 */

class CommonController extends Controller 
{
	/**
     * 初始化
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function _initialize()
    {	
		$_POST = array_merge($_POST,$_GET);
        $_GET = $_POST;
    	// 登录检测
    	if(empty($_SESSION['adminuser'])) $this->redirect('Login/login');

    	// 获取用户配置
   	// $user_config = D('Admin/Config');
   	// $config = $user_config->getconfig();
   	// $this->assign('config', $config); // 后台用户配置
    }


    /**
     * 接口返回
     * @param $e
     * @param string $msg
     * @param int $status
     */
    public function toJson($res, $msg='', $status=200)
    {
        if(is_array($res)){
            $res=array_merge($res,['status'=>$status,'msg'=>$msg]);
        }else{
            $res = [
                'status' => $res->getCode(),
                'msg' =>   $res->getMessage(),
            ];
        }
        $this->ajaxReturn($res,'JSON');
    }

}
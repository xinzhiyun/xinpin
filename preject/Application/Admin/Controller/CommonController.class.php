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
    	// 登录检测
    	if(empty($_SESSION['adminuser'])) $this->redirect('Login/login');

    	// 获取用户配置
   	// $user_config = D('Admin/Config');
   	// $config = $user_config->getconfig();
   	// $this->assign('config', $config); // 后台用户配置
    }

}
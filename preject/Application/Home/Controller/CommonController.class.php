<?php
namespace Home\Controller;
use Think\Controller;
use \Org\Util\WeixinJssdk;


/**
 * 前共控制器
 * 前台控制器除login外必须继承我
 * @author 吴智彬 <519002008@qq.com>
 */

class CommonController extends Controller 
{
	/**
     * 初始化
     * @author 吴智彬 <519002008@qq.com>
     */
    public function _initialize()
    {	
    	// 登录检测
    	if(empty($_SESSION['homeuser'])) $this->redirect('Login/login');
    }

    public function getWeixin()
	{
		if(empty($_SESSION['oppenId'])){

			$weixin = new WeixinJssdk;
	        // 查询用户微信中的openid
	        // 调试完打开
	        $openId = $weixin->GetOpenid();

	        $_SESSION['oppenId'] = $openId;
	    }
	    return $_SESSION['oppenId'];

	}


}
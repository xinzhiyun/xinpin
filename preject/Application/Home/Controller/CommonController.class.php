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
                                   $server_name = $_SERVER['PATH_INFO'];
                                   $array = explode('/', $server_name);
                                   if($array[1]=='student'){
                                       $_SESSION['activate_type'] = 'student';
                                   }else if($array[1]=='teacher'){
                                        $_SESSION['activate_type'] = 'teacher';
                                   }
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
        
            public function toJson($e,$msg='',$status=200,$jsoncallback='')
    {
        if(is_array($e)){
            $data=array_merge($e,['status'=>$status,'msg'=>$msg]);
        }else{
            if(!empty($msg)){ // jsonp
                $jsoncallback = $msg;
            }
            $data = [
                'status' => $e->getCode(),
                'msg' =>   $e->getMessage(),
            ];
        }


        $data['state']   = (!empty($data['status']) and $data['status']== 200) ? "success" : "fail";

        header('Content-Type:application/json; charset=utf-8');

        if(empty($jsoncallback)){
            exit(json_encode($data));
        }else{
            exit($jsoncallback."(".json_encode($data).")");
        }
    }

}
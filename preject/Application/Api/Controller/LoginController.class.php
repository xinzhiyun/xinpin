<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/07/13/
 * Time: 15:08
 */
namespace Api\Controller;
use Think\Controller;

class LoginController extends Controller
{
    /**
     * 登录方法
     * @param string $username 用户名
     * @param string $password 密码
     * @param int $t 时间戳
     * @param string $sin 签名（MD5(130388056681531313596), username+时间戳）
     * @return json
     * URL：http://xinpin.dianqiukj.com/index.php/api/login/login 
     */
    public function login()
    {
// 1531724212 1531474950
        if (IS_POST) {
            // 参数
            $username = I('post.username');
            $password = I('post.password');
            $t = intval(I('post.t'));
            $sin = I('post.sin');
            // $username = 18262273325;
            // $password = 123456;
            // $t = 234;
            // $sin = 'e509348d489a908fc3ca45dbcbdb3ed1';

            // 返回信息
            $result = [
                '200'   => array('Loginstatuse'=>ture, 'code'=>200, 'message'=>'登录成功！'),
                '40001' => array('Loginstatuse'=>false, 'code'=>40001, 'message'=>'签名错误！'),
                '40002' => array('Loginstatuse'=>false, 'code'=>40002, 'message'=>'用户名或密码错误！'),
                '40003' => array('Loginstatuse'=>false, 'code'=>40003, 'message'=>'服务器验证签名错误！'),
                '40004' => array('Loginstatuse'=>false, 'code'=>40004, 'message'=>'提交方式错误！'),
                '40005' => array('Loginstatuse'=>false, 'code'=>40005, 'message'=>'时间戳失效')
            ];
            // 当前时间
            $time = time();

            // 开始时间
            $outtime = $time+60*5;
            $outtime = intval($outtime);
            $times = $time-60*5;
            $times = intval($times);
            
            // 请求时间5分钟内
            if ($t < $outtime && $t > $times) {
                // 初步验证签名是否正确
                $provingsin = md5($username.$t);

                if ($provingsin == $sin) {
                    // 传来的签名初步验证通过，验证用户名密码
                    $map['phone'] = $username;
                    $map['password'] = md5($password);

                    $user = M('Users')->where($map)->getField('id,name,phone,balance');
                    // dump($user);die;
                    if ($user) {
                        // 查到用户信息，再次验证签名
                        foreach ($user as $key => $value) {
                            $user = $value;   
                        }

                        $provingsins = md5($user['phone'].$t);
                        if ($provingsins == $sin) {
                            // 二次签名验证通过，返回用户信息
                            
                            $where['uid'] = $user ['id'];
                            //$where['type'] = 2;//余额充值  1为押金充值
                            
                            $userFlow = M('Flow')->where($where)->field('uid,ordernumber,money,type')->select();

                            $result[200]['userinfo'] = $user;
                            $result[200]['userflow'] = $userFlow;
                            $this->ajaxReturn($result[200]);
                        }else{
                            // 签名错误
                            $this->ajaxReturn($result[40003]);
                        }

                    }else{
                        // 用户名或密码错误
                        $this->ajaxReturn($result[40002]);
                    }
                    
                }else{
                    // 初步验证签名错误
                    $this->ajaxReturn($result[40001]);
                }
            }else{
                // 时间戳失效
                $this->ajaxReturn($result[40005]);
                
            }
            

        } else {
            // 非POST
            $this->ajaxReturn($result[40004]);
        }     

    }



    // public function logout()
    // {
    //     unset($_SESSION['adminuser']);
    //     $this->redirect('Login/login');
    // }

}

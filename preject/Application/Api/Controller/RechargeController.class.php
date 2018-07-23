<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/07/13/
 * Time: 15:08
 */
namespace Api\Controller;
use Think\Controller;

class RechargeController extends Controller
{
    /**
     * 充值记录方法
     * @param string $userid 用户id
     * @param string $username 用户名
     * @param string $ordernumber 充值微信返回订单号
     * @param string $money 充值金额
     * @param int $t 时间戳
     * @param string $sin 签名（MD5(130388056681531313596), username+时间戳）
     * @return json
     * URL：http://xinpin.dianqiukj.com/index.php/api/Recharge/recharge 
     */
    public function recharge()
    {
        if (IS_POST) {

            // 参数
            $userid = I('post.userid');                  //用户id
            $username = I('post.username');              //用户名
            $ordernumber = I('post.ordernumber');        //充值微信返回订单号
            $money = I('post.money');                    //充值金额
            // $balance = I('post.balance');                //用户余额
            $t = intval(I('post.t'));                    //时间戳
            $sin = I('post.sin');                        //验证规则

            // 返回信息
            $result = [
                '0'   => array('Loginstatuse'=>ture, 'code'=>0, 'message'=>'充值成功！'),
                '1' => array('Loginstatuse'=>false, 'code'=>1, 'message'=>'用户不存在！'),
                '2' => array('Loginstatuse'=>false, 'code'=>2, 'message'=>'重复充值！'),
                '3' => array('Loginstatuse'=>false, 'code'=>3, 'message'=>'其他异常！'),
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
                            // 二次签名验证通过，写入充值记录
                            $model = M('Flow');
                            $map['ordernumber'] = array('eq', $ordernumber);
                            //查询订单是否存在
                            $res = $model->where($map)->find();

                            if(!$res){
                                // 用户ID号
                                $data['uid'] = $userid;
                                // 商户订单
                                $data['ordernumber'] = $ordernumber;
                                // 金额
                                $data['money'] = $money;
                                // 读取用户余额
                                $user = M('users')->where('id='.$data['uid'])->find();
                                // 用户余额
                                $allmoney = (int) $user['balance'];
                                // 用户当前余额
                                $data['currentbalance'] = $allmoney + $data['money'];
                                // 充值类型
                                $data['mode'] = 1;

                                //押金类型充值
                                $data['type'] = 2;
                                // 充值时间
                                $data['time'] = time();
                                // 写入数据库
                                $msg = $model->add($data);

                                // 更新用户余额
                                // 更新用户余额
                                $usre['balance'] = $allmoney + $data['money'];

                                $usre['addtime'] = time();

                                $mes = M('users')->where('id='.$data['uid'])->save($usre);
                                
                                $result[0]['userinfo'] = $user;
                                $this->ajaxReturn($result[0]);

                            } else {
                                $this->ajaxReturn($result[2]);

                            }   
                        }else{
                            // 签名错误
                            $this->ajaxReturn($result[3]);
                        }

                    }else{
                        // 用户名或密码错误
                        $this->ajaxReturn($result[1]);
                    }
                    
                }else{
                    // 初步验证签名错误
                    $this->ajaxReturn($result[3]);
                }
            }else{
                // 时间戳失效
                $this->ajaxReturn($result[3]);
                
            }       

        } else {
            // 非POST
            $this->ajaxReturn($result[3]);
        }     
                
    } 

    /**
     * 获取用户充值记录
     * @param string $userid 用户id
     * @param int $t 时间戳
     * @param string $sin 签名（MD5(130388056681531313596), username+时间戳）
     * @return json
     * URL：http://xinpin.dianqiukj.com/index.php/api/Recharge/getUserFlow 
     */
    public function getUserFlow()
    {
        if (IS_POST) {

            // 参数
            $userid = I('post.userid');                  //用户id
            $t = intval(I('post.t'));                    //时间戳
            $sin = I('post.sin');                        //验证规则

            // 返回信息
            $result = [
                '200'   => array('status'=>ture, 'code'=>200, 'message'=>'登录成功！'),
                '40001' => array('status'=>false, 'code'=>40001, 'message'=>'签名错误！'),
                '40002' => array('status'=>false, 'code'=>40002, 'message'=>'用户名或密码错误！'),
                '40003' => array('status'=>false, 'code'=>40003, 'message'=>'服务器验证签名错误！'),
                '40004' => array('status'=>false, 'code'=>40004, 'message'=>'提交方式错误！'),
                '40005' => array('status'=>false, 'code'=>40005, 'message'=>'时间戳失效')
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
                            $where['uid'] = $userid;
                            //$where['type'] = 2;
                            
                            $userFlow = M('Flow')->where($where)->field('uid,ordernumber,money,type')->select();
                            $result[200]['userFlow'] = $userFlow;
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
}

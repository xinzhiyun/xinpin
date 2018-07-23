<?php
namespace Home\Controller;
use Think\Controller;
use \Org\Util\WeixinJssdk;

class CardController extends CommonController 
{
    public function index()
    {
        // 查询用户IC卡号 xp_card
        $uid = $_SESSION['homeuser']['id'];
        // 查询用户名下已绑定的卡号
        $icid = M('Card')->field('iccard,status')->where('`uid`='.$uid)->select();

        //分配数据        
        $this->assign('icid',$icid);

        // 显示模板
        $this->display();
    }


    public function student()
    {
        if (IS_POST) {

        } else {
            $this->display();
        }
    }

    //更新
    //IC卡必须后台存在
    public function add()
    {
        //判断是否更新IC卡
        if(IS_POST){    
            $user = D('Card');
            
            $info = $user->getIccard();

            if($info){
                //获取IC卡状态
                $status = $info['status'];
                if($status==0){
                    $res = $user->create();
                    if($res){
                        $data['name'] = $res['name'];
                        $data['studentcode'] = $res['studentcode'];
                        $data['school'] = $res['school'];
                        $data['uid'] = $_SESSION['homeuser']['id'];
                        $data['status'] = 1;
                        $data['deposit'] = $res['deposit'];
                        $info = $user->where('iccard="'.$_POST['iccard'].'"')->save($data);
                        
                        if($info){
                           //跳转到用户中心
                            $this->ajaxReturn(array('msg'=>'添加IC成功','code'=>'200')); 
                        }else{
                            $this->ajaxReturn(array('msg'=>'添加IC失败','code'=>'201')); 
                        }
                    }else{
                        //返回自动验证提示信息
                        $this->error($user->getError());
                    }

                }elseif($status==1){
                    $this->ajaxReturn(array('msg'=>'该卡已被绑定','code'=>'201')); 

                }else{
                    $this->ajaxReturn(array('msg'=>'该卡已被挂失','code'=>'201')); 

                }

            }else{
                $this->ajaxReturn(array('msg'=>'IC卡号不存在','code'=>'201')); 

            }

        }else{
           $this->display();
        }
        
    }

    /**
     * [check 检查ic卡状态]
     * @return [type] [description]
     */
    public function check()
    {
        //判断是否更新IC卡
        if(IS_POST){    
            $user = D('Card');
            
            $info = $user->getIccard();

            if($info){
                //获取IC卡状态
                $status = $info['status'];
                if($status==0){
                    
                    $this->ajaxReturn(array('msg'=>'卡可使用','code'=>'200'));     

                }elseif($status==1){

                    $this->ajaxReturn(array('msg'=>'该卡已被绑定','code'=>'201')); 

                }else{
                    
                    $this->ajaxReturn(array('msg'=>'该卡已被挂失','code'=>'201')); 

                }

            }else{
                $this->ajaxReturn(array('msg'=>'IC卡号不存在','code'=>'201')); 

            }

        }
        
    }





    /**
     * 统一下单并返回数据
     * @return string json格式的数据，可以直接用于js支付接口的调用
     */
    public function uniformOrder()
    {
        // 将金额强转换整数
        $money = I('money') * 100;
        // 冲值测试额1分钱
        $money = 1;
        // 用户在公众号的唯一ID
        // $openId = $this->getWeixin();
        // $openId = $this->getWeixin();
        // $openId = $this->getWeixin();
        $openId = I('post.openId');
        //微信examle的WxPay.JsApiPay.php
        vendor('WxPay.jsapi.WxPay#JsApiPay');
        $tools = new \JsApiPay();
        //②、统一下单
        vendor('WxPay.jsapi.WxPay#JsApiPay');
        $input = new \WxPayUnifiedOrder();
        // 产品内容
        $input->SetBody("馨品净水设备-押金");
        // 用户ID
        $input->SetAttach($_SESSION['homeuser']['id']);
        // 设置商户系统内部的订单号,32个字符内、可包含字母, 其他说明见商户订单号
        $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis").mt_rand(0,9999));
        // 产品金额单位为分
        $input->SetTotal_fee($money);
        // 设置订单生成时间
        // $input->SetTime_start(date("YmdHis"));
        // 设置订单失效时间
        // $input->SetTime_expire(date("YmdHis", time() + 300));
        // $input->SetGoods_tag("test");
        // 支付成功的回调地址xinpin.dianqiukj.com
        $input->SetNotify_url("http://xinpin.dianqiukj.com/index.php/Home/Weixinpay/dnotify.html");
        // $input->SetNotify_url("http://wuzhibin.cn/Home/Weixinpay/notify.html");
        // 支付方式 JS-SDK 类型是：JSAPI
        $input->SetTrade_type("JSAPI");
        // 用户在公众号的唯一标识
        $input->SetOpenid($openId);
        // 统一下单 
        $order = \WxPayApi::unifiedOrder($input);
        
        // 返回支付需要的对象JSON格式数据
        $jsApiParameters = $tools->GetJsApiParameters($order);

        echo $jsApiParameters;
        exit;
    }

    //解绑
    //解挂后:IC卡处于未绑定状态 ，持卡用户为 null
    public function relieveIC()
    {
        // 接收要修改的卡号
        $iccard = I('numVal');
        $data['status'] = 0;
        $data['uid'] = null;
        $data['name'] = null;
        $data['studentcode'] = null;
        $data['school'] = null;
        $res = M('Card')->where('`iccard`="'.$iccard.'"')->save($data);

        // 检查是否解绑成功
        if($res){
            // 成功返回
            echo 1;
        }else{
            // 失败返回
            echo -1;
        }
    } 

    //挂失
    //挂失：IC卡处于绑定状态
    public function reportTheLossOf()
    {
        // IC卡卡号
        // 接收要修改的卡号
        $iccard = I('numVal');
        $data['status'] = 2;   
        $res = M('Card')->where('`iccard`="'.$iccard.'"')->save($data);

        // 检查是否挂失成功
        if($res){
            // 成功返回
            echo 1;
        }else{
            // 失败返回
            echo -1;
        }

    }

    //解挂
    //解挂后:IC卡处于绑定状态
    public function hangingSolution()
    {
        // IC卡卡号
        // 接收要修改的卡号
        $iccard = I('numVal');
        $data['status'] = 1;   
        $res = M('Card')->where('`iccard`="'.$iccard.'"')->save($data);

        // 检查是否解挂成功
        if($res){
            // 成功返回
            echo 1;
        }else{
            // 失败返回
            echo -1;
        }
    }    

}
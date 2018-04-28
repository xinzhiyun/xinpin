<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 前台用户控制器
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class UsersController extends CommonController 
{
	/**
     * 前台用户列表
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function index()
    {	
        // 根据用户昵称进行搜索
        $map = '';
    	if(!empty($_GET['name'])) $map['name'] = array('like',"%{$_GET['name']}%");

        $user = D('users');
        $total = $user->where($map)->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $userlist = $user->where($map)->limit($page->firstRow.','.$page->listRows)->getAll();
        // dump($userlist);
        $this->assign('list',$userlist);
        $this->assign('button',$pageButton);
        $this->display();
    }

    
    /**
     * 推送信息方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function message($id)
    {   
        if (IS_POST) {
 
            // 接收数据
            // 尊敬的${content}，测试喝水建议。
            $phone = $_POST['phone'];
            $content = '用户' . $_POST['name'] . '您好！'.$_POST['content'];

            // 开始接口代码
            $sms = new \Org\Util\SmsDemo;
            $response = $sms::sendSms(
                "阿里云短信测试专用", // 短信签名
                "SMS_112475574", // 短信模板编号
                $phone, // 短信接收者
                Array(  // 短信模板中字段的值
                    "content"=>$content,
                    "product"=>"dsd"
                ),
                "123"   // 流水号,选填
            );

            // 信息推送状态判断
            if($response->Code=='OK'){
                $this->error('消息推送成功！');
            }else{
                $this->error('消息推送失败，错误码：' . $response->Code);
            }

        }else{
            $user = M('users');
            $userinfo = $user->where('id='.$id)->select();
            $this->assign('list',$userinfo);
            $this->display();
        }
    }

    /**
     * 编辑用户方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function edit($id,$status)
    {
        $users = M("users");
        $data['status'] = $_GET['status'];
        $res = $users->where('id='.$id)->save($data); 
        if ($res) {
             $this->redirect('users/index');
        } else {
            $this->error('修改失败啦！');
        }
    }

    /**
     * 用户充值流水列表
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function flow()
    {
        // 根据用户昵称进行搜索
        $map = '';
        if(!empty($_GET['name'])) $map['name'] = array('like',"%{$_GET['name']}%");

        $flow = M('flow');
        $total = $flow->where($map)->order('xp_flow.id desc')
                                ->join('xp_users ON xp_flow.uid = xp_users.id')
                                ->field('xp_flow.*,xp_users.name,xp_users.balance')
                                ->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $list = $flow->where($map)->limit($page->firstRow.','.$page->listRows)->order('xp_flow.id desc')
                                ->join('xp_users ON xp_flow.uid = xp_users.id')
                                ->field('xp_flow.*,xp_users.name,xp_users.balance')
                                ->select();
        // dump($list);die;
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();        
    }

    /**
     * 用户消费记录列表
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function consume()
    {
        // 根据用户昵称进行搜索
        $map = '';
        if(!empty($_GET['name'])) $map['card.name'] = array('like',"%{$_GET['name']}%");

        $consume = M('consume');
        $total = $consume->where($map)
           
            ->alias('c')
            ->join('__CARD__ card ON c.icid = card.id', 'LEFT')
            ->join('__DEVICES__ d ON c.did = d.id', 'LEFT')
            ->join('__USERS__ u ON card.uid = u.id', 'LEFT')
            ->field('c.flow,c.time,u.*,card.iccard,c.id,card.name')
            ->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $list = $consume->where($map)
            ->limit($page->firstRow.','.$page->listRows)
            ->alias('c')
            ->join('__CARD__ card ON c.icid = card.id', 'LEFT')
            ->join('__DEVICES__ d ON c.did = d.id', 'LEFT')
            ->join('__USERS__ u ON card.uid = u.id', 'LEFT')
            ->field('c.flow,c.time,u.*,card.iccard,c.id,card.name')
            ->select();
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();        
    }

    // 查询用户详情
    public function usersDetail()
    {       
        // 接收用户ID
        $id = I('get.id');
        // //$id=1;
        // 查询用户基础信息
        $userInfo = M('Users')->where('`id`='.$id)->find();
        $this->assign('userInfo',$userInfo);

        // 查询用户充值记录
        // $record = M('Flow')->where('`uid`='.$id)->order('id desc')->select();
        $mode = array('系统赠送','微信支付','支付宝支付');
        $this->assign('mode',$mode);
        // $this->assign('record',$record);

        // 查询用户消费记录总条数
        $count = M('Flow')->where('`uid`='.$id)->count();
        // 实例化分页类 传入总记录数和每页显示的记录数(5)
        $recordPage = new \Think\Page($count,5);
        // 分页显示输出
        $recordshow  = $recordPage->show();
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $recordlist = M('Flow')->where('`uid`='.$id)->order('id desc')->limit($recordPage->firstRow.','.$recordPage->listRows)->select();
        $this->assign('recordlist',$recordlist);// 赋值数据集
        $this->assign('recordshow',$recordshow);// 赋值分页输出
        

        $map['xp_users.id']=$id;
        // 查询用户消费记录
        $consume = M('consume');
        $total = $consume->where($map)
                                ->join('xp_card ON xp_consume.icid = xp_card.id', 'LEFT')
                                ->join('xp_users ON xp_card.uid = xp_users.id', 'LEFT')
                                ->field('xp_consume.*,xp_users.name,xp_card.iccard')
                                ->count();
        $page  = new \Think\Page($total,5);
        $pageButton =$page->show();

        $list = $consume->where($map)->order('id desc')->limit($page->firstRow.','.$page->listRows)
                                ->join('xp_card ON xp_consume.icid = xp_card.id', 'LEFT')
                                ->join('xp_users ON xp_card.uid = xp_users.id', 'LEFT')
                                ->field('xp_consume.*,xp_users.name,xp_users.balance,xp_card.iccard')
                                ->select();
        // dump($recordlist);
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();  
    }


}

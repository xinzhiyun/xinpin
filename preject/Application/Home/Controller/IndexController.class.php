<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController 
{
    public function index()
    {
        // 查询用户IC卡号 xp_card
        $uid = $_SESSION['homeuser']['id'];
        // 查询用户名是否绑定IC卡
        $icid = M('Card')->field('id')->where('`uid`='.$uid)->find();

        // 如果没有绑定IC卡
        if(empty($icid)){
            $this->redirect('Home/Card/add');
            exit;
        }
    	// 读取用户余额
    	$money = (int) M('users')->where('id='.$_SESSION['homeuser']['id'])->find()['balance'];
        $map['uid'] = session('homeuser.id');
        $card = M('card')->where($map)->select();
        // 拿到IC卡号
        $iccard = array_column($card, 'iccard','id');
        $name = array_column($card, 'name');
        // 查询每张IC卡一周的使用记录
        $icid = array_column($card, 'id');
        $where['icid'] = ['in', $icid];
        $times = strtotime('-7 days');
        $where['time'] = ['egt', $times];
        $record = M('consume')
            ->where($where)
            ->field("did,icid,flow,address,FROM_UNIXTIME(time,'%Y-%m-%d') as time")
            ->group('time')
            ->order('time asc')
            ->select();
        $new = array();
        foreach($record as $val){
            $key = $val['time'].'&'.$val['icid'];
            if(isset($new[$key])) {
                $new[$key]['flow'] += $val['flow'];
            } else {
                $new[$key] = $val;
            }
        }
        $new = array_values($new);
    	//分配数据     
        $assign = [
            'money' => $money/100,
            'iccard' => json_encode($iccard),
            'record' => json_encode($new),
            'name' => json_encode($name),
        ];   
        $this->assign($assign);
    	$this->display();

	}

}
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
        $start_week =  date('Y-m-d',$times);
        //echo $start_week;
        $where['time'] = ['egt', $times];
        $record = M('consume')
            ->where($where)
            ->field("did,icid,sum(flow) number,time,address,FROM_UNIXTIME(time,'%Y-%m-%d') as t_time")
            ->group('t_time')
            ->order('time asc')
            ->select();
//   echo '<pre>';
//    var_dump($record);die;
        $new = array();
      
//        foreach($record as $val){
//           
//            $key = $val['time'].'&'.$val['icid'];
//            
//            if(isset($new[$key])) {
//                $new[$key]['flow'] += $val['flow'];
//            } else {
//                $new[$key] = $val;
//            }
//        }
        $total_number = 0;
        foreach($record as $k=>$val){
              $new[$k]['time'] = $val['t_time']; 
             $new[$k]['flow'] = $val['number']; 
             $total_number+=$val['number']/1000;
        }
        $change_time = [];
        
        for($i=0;$i<=6;$i++){
                        
                       $res =  date('Y-m-d', (strtotime(date('Y-m-d'))-24*($i+1)*3600));
                     
                        $change_time[$i]['s_time'] = $res;
                        $change_time[$i]['flow'] = 0;
        }
        $result  =$change_time;
    foreach($change_time as $k=>$v){
       foreach($new as $val){
            if($val['time'] == $change_time[$k]['s_time']){
                $result[$k]['flow'] = $val['flow'];
            }
       }
       
    }
           
        $new = array_values($new);
    	//分配数据     
        $assign = [
            'total_number' => $total_number,
            'money' => $money/100,
            'iccard' => json_encode($iccard),
            'record' => json_encode($result),
            'name' => json_encode($name),
        ];   
        $this->assign($assign);
    	$this->display();

	}

}
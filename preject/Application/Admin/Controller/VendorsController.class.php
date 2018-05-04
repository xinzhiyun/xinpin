<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 经销商控制器
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class VendorsController extends CommonController 
{
	/**
     * 经销商列表（本质就是后台用户）
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function index()
    {	
        // 搜索功能
        $map = array(
            // 'user' => array('like','%'.trim(I('post.user')).'%'),
            'name' => array('like','%'.trim(I('post.name')).'%'),
            'phone' => array('like','%'.trim(I('post.phone')).'%'),
            'email' => array('like','%'.trim(I('post.email')).'%'),
            'address' => array('like','%'.trim(I('post.address')).'%'),
            'company' => array('like','%'.trim(I('post.company')).'%'),
            'idcard' => array('like','%'.trim(I('post.idcard')).'%'),
            'leavel' => trim(I('post.leavel')),
        );
        $minupdatetime = strtotime(trim(I('post.minaddtime')));
        $maxupdatetime = strtotime(trim(I('post.maxaddtime')));
        if (!empty($maxupdatetime) && !empty($maxupdatetime)) {
            $map['addtime'] = array(array('egt',$minupdatetime),array('elt',$maxupdatetime+24*60*60));
        }
        // 删除数组中为空的值
        $map = array_filter($map, function ($v) {
            if ($v != "") {
                return true;
            }
            return false;
        });
        if(isset($_GET['search'])){
            $_GET['p'] = 1;
            unset($_GET['search']);
        }
        $user = D('vendors');
        $total = $user->where($map)->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $userlist = $user->where($map)->limit($page->firstRow.','.$page->listRows)->order('id desc')->getAll();

        $this->assign('list',$userlist);
        $this->assign('button',$pageButton);
        $this->display();
    }

    /**
     * 添加经销商方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function add()
    {
        if(IS_POST){
// dump($_POST);die;
            $user = D('vendors');
            $info = $user->create();
            // dump($info);die;

            if($info){

                $res = $user->add();
                if ($res) {
                    $this->success('添加经销商成功啦！！！',U('Vendors/index'));
                } else {
                    $this->error('添加经销商失败啦！');
                }
            
            } else {
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($user->getError());
            }
        }else{
            $this->display(); 
        }
    }

    /**
     * 编辑经销商方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function edit($id)
    {
        if(IS_POST){
            $user = D('vendors');
            $userinfo = $user->create();
            if ($userinfo) {
                $res = $user->save();
                if ($res) {
                    $this->success('编辑经销商成功啦！！！',U('Vendors/index'));
                } else {
                    $this->error('编辑经销商失败啦！');
                }                
            }else{
                $this->error($user->getError());
            }

        } else {
            $info[] = D('vendors')->find($id);
            $this->assign('info',$info);
            $this->display();
        }
    }
    
    /**
     * 删除经销商方法
     * 需保证其没有下级，没有设备与之挂钩
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function del($id)
    {
        $userinfo = M('vendors')->where("id=".$id)->select();

        if ($userinfo[0]['leavel'] == 0 ) {
            $this->error('不能删除超级管理员！');
        }else{
            // 查询该经销商是否已经绑定设备，如绑定，则不允许删除
            $binding = M('binding')->where("vid=".$id)->find();
            if (!$binding) {
                $res = D('vendors')->delete($id);
                if($res){
                    $this->success('删除成功',U('index'));
                }else{
                    $this->error('删除失败');
                }
            }else{
                $this->error('有设备挂在该经销商名下，不能删除！');    
            }
        }
    }

    /**
     * 设备绑定经销商方法
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function devices_add()
    {
        if (IS_POST) {

            if ($_POST['did']) {

                if ($_POST['vid']) {
                   
                    $arr = array(
                        'vid' => I('vid'),
                        'did' => I('did'),
                        'addtime' => time(),
                    );
                    // dump($arr);die;
                    // 添加
                    $binding = M('binding');
                    if ($binding->add($arr)) {
                        // 更改设备的绑定状态
                        $devices = M('devices');  
                        $devices->where('id='.$_POST['did'])->setField('binding_status','1');

                        $this->success('添加成功',U('bindinglist'));
                    }else{
                        $this->error('添加失败啦');
                    }

                }else{
                    $this->error('经销商不存在！请在经销商管理中添加经销商后尝试！正在为您跳转至经销商管理',U('index')); 
                }

            }else{
                $this->error('设备不存在！请在设备管理中添加设备后尝试！正在为您跳转至设备管理',U('Devices/index'));
            }   

        }else{

            if(!empty($_SESSION['adminuser'])){
                // 获取经销商信息
                $case = $_SESSION['adminuser']['leavel'];

                switch ($case) {
                    
                    case '0':
                        $user = D('vendors')->getAll();
                        break;

                    case '1':
                    // 一级经销商只能给二级经销商绑定设备，如需再往下分级，则case '2' leavel=3
                        $user = M('vendors')->where('leavel=2')->select();

                        break;    
                    
                    default:
                        # code...
                        break;
                }

                // 获取设备信息
                $devices = M('devices')->where('binding_status=0')->select();

                $this->assign('user',$user);
                $this->assign('devices',$devices);
                $this->display();
            }else{
                $this->error('登录失效，请重新登陆！',U('Login/login'));
            }
            
        }

    }

    /**
     * 机组绑定经销商列表
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function bindinglist()
    {
       // 根据用户昵称进行搜索
        // 搜索功能
        if(trim(I('post.device_code'))){
            $map['xp_devices.device_code'] = array('like','%'.trim(I('post.device_code')).'%');
        }

        if(trim(I('post.name'))){
            $map['xp_vendors.name'] = array('like','%'.trim(I('post.name')).'%');
        }

        if(trim(I('post.phone'))){
            $map['xp_vendors.phone'] = array('like','%'.trim(I('post.phone')).'%');
        }

        $minupdatetime = strtotime(trim(I('post.minaddtime')));
        $maxupdatetime = strtotime(trim(I('post.maxaddtime')));
        if (!empty($maxupdatetime) && !empty($maxupdatetime)) {
            $map['xp_binding.addtime'] = array(array('egt',$minupdatetime),array('elt',$maxupdatetime+24*60*60));
        }
        if(isset($_GET['search'])){
            $_GET['p'] = 1;
            unset($_GET['search']);
        }
        $binding = M('binding');
        
        $total =$binding->where($map)
                    ->join('xp_vendors ON xp_binding.vid = xp_vendors.id')
                    ->join('xp_devices ON xp_binding.did = xp_devices.id')
                    ->field('xp_binding.*,xp_vendors.name,xp_vendors.phone,xp_devices.device_code')
                    ->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $bindinglist = $binding->where($map)
                                ->limit($page->firstRow.','.$page->listRows)
                                ->join('xp_vendors ON xp_binding.vid = xp_vendors.id')
                                ->join('xp_devices ON xp_binding.did = xp_devices.id')
                                ->field('xp_binding.*,xp_vendors.name,xp_vendors.phone,xp_devices.device_code')
                                ->select();
        // dump($bindinglist);
        $this->assign('list',$bindinglist);
        $this->assign('button',$pageButton);
        $this->display(); 
    }

    /**
     * 解除绑定方法
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function bindingdel($id,$did)
    {
        
        if ($_SESSION['adminuser']['leavel'] == 0) {

            $res = D('binding')->delete($id);
            if($res){
                // 更新设备绑定状态
                $devices = M('devices');  
                $devices->where('id='.$did)->setField('binding_status','0');
                $this->success('解除成功',U('bindinglist'));
            }else{
                $this->error('解除失败');
            }

        }else{
           $this->error('对不起，您没有权限解除绑定！',U('bindinglist'));
        }
    }

    /**
     * 修改密码方法
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function password()
    {
        if (IS_POST) {
            $old = md5(I('oldpassword')); 
            $new = md5(I('newpassword')); 
            $re = md5(I('repassword'));
            $id = I('id');

            if ($new == $re) {
                $user = M('Vendors');
                $info = $user->where('id='.$id)->getField('password');
                
                if ($old == $info) {
                    $res = $user->where('id='.$id)->setField('password',$new);
                    if ($res) {
                        $this->success('修改密码成功，请重新登录！',U('Login/logout'));
                    }else{
                        $this->error('修改密码失败！');
                    }

                }else{
                    $this->error('原密码错误，请重新输入！');
                }

            }else{
                $this->error('两次密码不一样，请重新输入！');
            }

        }else{
            $this->display();
        }
    }


    /**
     * 修改经销商密码方法
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function editpwd($id)
    {
        if (IS_POST) {
            $new = md5(I('newpassword')); 
            $re = md5(I('repassword'));
            $id = I('id');

            if ($new == $re) {
                $user = M('Vendors');
                
                $res = $user->where('id='.$id)->setField('password',$new);
                if ($res) {
                    $this->success('修改经销商密码成功',U('index'));
                }else{
                    $this->error('修改密码失败！');
                }
               
            }else{
                $this->error('两次密码不一样，请重新输入！');
            }

        }else{
            $info[] = D('vendors')->find($id);
            $this->assign('info',$info);
            $this->display();
        }
    }

}
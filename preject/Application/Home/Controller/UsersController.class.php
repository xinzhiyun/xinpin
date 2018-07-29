<?php
namespace Home\Controller;
use Think\Controller;
class UsersController extends CommonController 
{
	//我的
    public function mine()
    {
        // 查询用户IC卡号 xp_card
        $id = $_SESSION['homeuser']['id'];

        // 查询用户名下已绑定的卡号
        $name = M('Users')->field('name')->where('`id`='.$id)->find()['name'];
        // print_r($name);die;
        // 分配数据
        $this->assign('name',$name);

        // 显示模板
        $this->display();        
    }
	
	//个人信息
	public function personalinformation()
	{
        // 查询用户IC卡号 xp_card
        $id = $_SESSION['homeuser']['id'];

        // 查询用户名下已绑定的卡号
        $user = M('Users')->field('name,phone,address')->where('`id`='.$id)->find();
        
        // 分配数据
        $this->assign('user',$user);

        // 显示模板
        $this->display();   
	}

    // 修改用户头像
    public function headPortrait()
    {
        if(IS_POST){
            // 获取用户ID
            $id = $_SESSION['homeuser']['id'];
            // 实例化上传类
            $upload = new \Think\Upload();
            // 设置图片上传目录
            $upload->rootPath = './Uploads/head/';
            // 执行图片上传
            $picpath = $upload->upload();
            if($picpath){
                // 上传头像
                $data['head'] = './Uploads/head/'.$picpath['photo']['savepath'].$picpath['photo']['savename'];
                // 将头像写入数据库
                $res = M('Users')->where("id={$id}")->save($data);
                if($res){
                    echo 1;
                }else{
                    echo -1;
                }
            }
            //dump($picpath);
        }
        // {{:U('Home/Users/headPortrait')}}
    }

    // 编辑用户资料
    public function reviseUser()
    {
        if(IS_POST){
            // 获取用户ID
            $id = $_SESSION['homeuser']['id'];

            // 接收用户名
            if(!empty(I('post.name'))){
                $data['name'] = I('post.name');
            }
            
            // 接收密码
            if(!empty(I('post.phone'))){
                $data['phone'] = I('post.phone');
            }
            
            // 接收地址
            if(!empty(I('post.address'))){
                $data['address'] = I('post.address');
            }

            $res = M('Users')->where("id={$id}")->save($data);

            if($res){
                echo 1;
            }else{
                echo 0;
            }    
        }
    }
}
<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 产品控制器
 * 用来配置产品类型，配置滤芯等
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class ProductController extends CommonController 
{
	/**
     * 产品类型列表
     * 设备的类型，型号
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function index()
    {	
       // 根据类型名称进行搜索
        // 搜索功能
        $map = array(
            'typename' =>  array('like','%'.trim(I('post.typename')).'%'),
        );

        $minupdatetime = strtotime(trim(I('post.minaddtime')));
        $maxupdatetime = strtotime(trim(I('post.maxaddtime')));
        if (!empty($maxupdatetime) && !empty($maxupdatetime)) {
            $map['addtime'] = array(array('egt',$minupdatetime),array('elt',$maxupdatetime+24*60*60));
        }

        $type = M('device_type');
        
        $total =$type->where($map)->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $list = $type->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            // dump($_POST);die;
            $device_type = D('type');
            $info = $device_type->create();
           
            if($info){

                $res = $device_type->add();
                if ($res) {
                    $this->success('设置类型成功啦！！！',U('Product/index'));
                } else {
                    $this->error('设置类型失败啦！');
                }
            
            } else {
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($device_type->getError());
            }

        }else{
            $filters = M('filters');
            $info = $filters->select();
            $this->assign('list',$info);
            $this->display();
        }
    }

    // 编辑
    public function edit()
    {
        if (IS_POST) {
            $id = I('post.id');
            $data = array(
                'typename' => I('post.typename'),
                'filter1' => I('post.filter1'),
                'filter2' => I('post.filter2'),
                'filter3' => I('post.filter3'),
                'filter4' => I('post.filter4'),
                'filter5' => I('post.filter5'),
                'filter6' => I('post.filter6'),
                'filter7' => I('post.filter7'),
                'filter8' => I('post.filter8'),
            );
//            $data = array_filter($data);
            $device_type = M('device_type');
            $res = $device_type->where('id='.$id)->save($data);
            if ($res) {
                $this->success('修改成功啦！',U('Admin/Product/index'));
            }else{
                $this->error('修改失败！');
            }
        } else {
            $id = I('get.id');
            $device_type = M('device_type');
            $data = $device_type->find($id);
            $filters = M('filters');
            $info = $filters->select();
            // dump($data);
            $this->assign('data',$data);
            $this->assign('list',$info);
            $this->display();
        }
    }

    /**
     * 删除类型方法（废除）
     * 不做删除，只做隐藏，如果要做删除产品类型，请确保产品类型没有被设备所用 
     *
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function del()
    {

    }

    /**
     * 添加滤芯方法
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function filter_add()
    {
        if (IS_POST) {

            $map['filtername'] = $_POST['filtername'];
            $map['alias'] = $_POST['alias'];
            $filters = M('filters');
            $f = $filters->where($map)->select();

            if (!$f) {
               $filter = D('filters');
                $info = $filter->create();
                    
                if($info){

                    $res = $filter->add();
                    if ($res) {
                        $this->success('添加滤芯成功啦！！！',U('Product/filterlist'));
                    } else {
                        $this->error('添加滤芯失败啦！');
                    }
                
                } else {
                    // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                    $this->error($filter->getError());
                }

            }else{
                $this->error('您添加的滤芯别名已经存在，您可选择前往编辑');
            }    
            
        }else{
            $this->display();
        }

    }

    /**
     * 滤芯列表
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function filterlist()
    {
        // 搜索功能
        $map = array(
            'filtername' =>  array('like','%'.trim(I('post.filtername')).'%'),
            'alias' => array('like','%'.trim(I('post.alias')).'%'),
            'url' => array('like','%'.trim(I('post.url')).'%'),
        );

        $minprice = trim(I('post.minprice'))?:0;
        $maxprice = trim(I('post.maxprice'))?:-1;
        if (is_numeric($maxprice)) {
            $map['price'] = array(array('egt',$minprice*100),array('elt',$maxprice*100));
        }
        if ($maxprice < 0) {
            $map['price'] = array(array('egt',$minprice*100));      
        }

        $mintimelife= trim(I('post.mintimelife'))?:0;
        $maxtimelife = trim(I('post.maxtimelife'))?:-1;
        if (is_numeric($maxtimelife)) {
            $map['timelife'] = array(array('egt',$mintimelife),array('elt',$maxtimelife));
        }
        if ($maxtimelife  < 0) {
            $map['timelife'] = array(array('egt',$mintimelife));       
        } 

        $minflowlife = trim(I('post.minflowlife'))?:0;
        $maxflowlife = trim(I('post.maxflowlife'))?:-1;
        if (is_numeric($maxflowlife)) {
            $map['flowlife'] = array(array('egt',$minflowlife),array('elt',$maxflowlife));
        }
        if ($maxflowlife < 0) {
            $map['flowlife'] = array(array('egt',$minflowlife));      
        }

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
        $filter = M('filters');
        
        $total =$filter->where($map)->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $filterlist = $filter->where($map)->limit($page->firstRow.','.$page->listRows)->select();

        $this->assign('list',$filterlist);
        $this->assign('button',$pageButton);
        $this->display(); 
    }

    /**
     * 编辑滤芯方法
     * 仅做数据更新处理
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function filter_edit($id)
    {
        if(IS_POST){
            $mod = D('filters');
            $info = $mod->create();
            
            if($info){
                $res = $mod->where("id=".$_POST['id'])->save();

                if ($res) {
                    $this->success('修改成功啦！',U('Product/filterlist'));
                }else{
                    $this->error('修改失败！');
                }
            }else{
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($mod->getError());
            }
           

        } else {
            $info = M('filters')->where("id=".$id)->select();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除滤芯方法（废除）
     * 不做删除，只做隐藏，如果要做删除滤芯，请确保滤芯没有被设备类型所用 
     *
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function filterdel($id)
    {
        
    }

}
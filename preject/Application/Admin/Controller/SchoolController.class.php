<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 学校控制器
 * 用来添加学校，浏览学校列表等
 * 
 * @author 梁康伦 <470907311@qq.com>
 */

class SchoolController extends CommonController 
{
	/**
     * [index 学校列表]
     * @return [type] [description]
     */
    public function index()
    {	
       // 根据名称进行搜索
        // 搜索功能

        if(trim(I('post.schoolname'))){
            $map['schoolname'] = array('like','%'.trim(I('post.schoolname')).'%');
        }
        
        // dump($map);die;
        
        if(isset($_GET['search'])){
            $_GET['p'] = 1;
            unset($_GET['search']);
        }
        $type = D('school');
        
        $total =$type->where($map)->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $list = $type->where($map)->limit($page->firstRow.','.$page->listRows)->getAll();
        // dump($list);die;
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();
    }

    /**
     * [add 学校添加]
     */
    public function add()
    {
        if (IS_POST) {
            // dump($_POST);die;
            $school = D('school');
            $info = $school->create();

            // dump($info);die;
           
            if($info){

                $res = $school->add();
                if ($res) {
                    $this->success('学校添加成功啦！！！',U('School/index'));
                } else {
                    $this->error('学校添加失败啦！');
                }
            
            } else {
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($school->getError());
            }

        }else{
            $this->display();
        }
    }

    /**
     * [edit 学校编辑]
     * @return [type] [description]
     */
    public function edit()
    {
        if (IS_POST) {
            $school = D("school");
            $id = $_POST['id'];
            $data['schoolname'] = $_POST['schoolname'];
            $data['updatetime'] = time();
            $res = $school->where('id='.$id)->save($data); 
            if ($res) {
                 $this->success('修改成功',U('School/index'));
            } else {
                $this->error('修改失败啦！');
            }
        } else {
            $id = $_GET['id'];
            $info = M('school')->find($id);

            $this->assign('info', $info);
            $this->display();
        }
        
    }

    /**
     * [del 学校删除]
     * @return [type] [description]
     */
    public function del()
    {
        $res = M('school')->where('id='.$_GET['id'])->delete();

        if ($res) {
             $this->success('删除成功',U('School/index'));
        } else {
            $this->error('删除失败啦！');
        }
    }

    

}
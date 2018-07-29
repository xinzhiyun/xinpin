<?php
namespace Home\Controller;
use Think\Controller;

class AreaController extends CommonController
{
    /**
     * 地址库管理
     */
    public function index()
    {
        $data = M('area')->where('parentid=0')->select();

        // dump($data);
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 加载下一级的地址库
     */
    public function getNextArea()
    {
        $parentid = I('parentid',0);

        $data = M('area')->where('parentid='.$parentid)->select();

        $this->toJson(['data'=>$data],'获取成功');
    }

    /**
     * [student 学生协议]
     * @return [type] [description]
     */
    public function student()
    {
        if (IS_POST) {
            $protocoltype = 1;
            $studentInfo = M('protocol')->field('content')->where('protocoltype='.$protocoltype)->find();

            $this->ajaxReturn($studentInfo);

        } 
    }

    /**
     * [teacher 教职工协议]
     * @return [type] [description]
     */
    public function teacher()
    {
        if (IS_POST) {
            $protocoltype = 2;
            $teacherInfo = M('protocol')->field('content')->where('protocoltype='.$protocoltype)->find();

            $this->ajaxReturn($teacherInfo); 
        } 
    }
    public function school(){
            $data = M('school')->field('id,schoolname name')->select();

        $this->toJson(['data'=>$data],'获取成功');
    }
}

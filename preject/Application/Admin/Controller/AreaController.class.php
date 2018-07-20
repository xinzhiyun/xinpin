<?php
namespace Admin\Controller;
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
            $data['content'] = $_POST['content'];
            $data['addtime'] = time();
            $protocoltype = 1;

            // dump($protocoltype);die;

            $res = M('protocol')->where('protocoltype='.$protocoltype)->save($data);

            if ($res) {
                 $this->success('修改学生协议成功',U('Area/student'));
            } else {
                $this->error('修改失败啦！');
            }

        } else {
            $protocoltype = 1;
            $studentInfo = M('protocol')->where('protocoltype='.$protocoltype)->find();
            $this->assign('studentInfo', $studentInfo);
            $this->display();
        }
    }

    /**
     * [teacher 教职工协议]
     * @return [type] [description]
     */
    public function teacher()
    {
        if (IS_POST) {
            $data['content'] = $_POST['content'];
            $data['addtime'] = time();
            $protocoltype = 2;

            // dump($protocoltype);die;

            $res = M('protocol')->where('protocoltype='.$protocoltype)->save($data);

            if ($res) {
                 $this->success('修改教职工协议成功',U('Area/teacher'));
            } else {
                $this->error('修改失败啦！');
            }

        } else {
            $protocoltype = 2;
            $teacherInfo = M('protocol')->where('protocoltype='.$protocoltype)->find();
            $this->assign('teacherInfo', $teacherInfo);
            $this->display();
        }
    }

}

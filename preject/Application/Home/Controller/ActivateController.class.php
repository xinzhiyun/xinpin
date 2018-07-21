<?php
namespace Home\Controller;
use Think\Controller;

class ActivateController extends CommonController {
    /**
     * 学生卡激活
     */
    public function student()
    {
        $this->display();
    }

    /**
     * 教师卡激活
     */
    public function teacher()
    {
        $this->display();
    }
}
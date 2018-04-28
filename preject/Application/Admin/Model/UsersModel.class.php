<?php
namespace Admin\Model;

use Think\Model;

/**
 * Class 用户数据处理
 * @package Admin\Model
 * @author 潘宏钢 <619328391@qq.com>
 */
class UsersModel extends Model
{   
    // 自动验证
    protected $_validate = array(
        array('name','require','账户名不能为空'),
        array('name','','该账户已存在，请换一个试试',0,'unique',1),
        array('repassword','password','两次密码不相同',0,'confirm'), //验证确认密码是否和密码一致
        array('phone','/^1[34578]\d{9}$/','电话号码格式不对',1,'regex'),
        array('email','/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i','邮箱格式不对',1,'regex'),
        array('company','require','公司不能为空'),
        array('address','require','地址不能为空'),
        array('idcard',"/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}[0-9Xx]$)/",'身份证格式不对',1,'regex')
    );


    // 自动完成
    protected $_auto = array ( 
        array('addtime','time',3,'function'), // 对addtime字段在新增和编辑的时候写入当前时间戳 
        array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        
    );


    // 处理查询数据
    public function getAll()
    {
        $list = $this->select();

        $status = array('禁用','启用','未知');
        foreach ($list as $key => $val) {
            $list[$key]['status'] = $status[$val['status']];
        }
        return $list;
    }

    

}
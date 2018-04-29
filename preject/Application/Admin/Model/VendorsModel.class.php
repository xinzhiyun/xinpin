<?php
namespace Admin\Model;

use Think\Model;

/**
 * Class 经销商数据处理
 * @package Admin\Model
 * @author 潘宏钢 <619328391@qq.com>
 */
class VendorsModel extends Model
{   
    // 自动验证
    protected $_validate = array(
        array('name','require','用户名不能为空'),
        array('name','/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]{1,660}$/u','用户名不能使用特殊字符',1,'regex'),
        array('name','','该账户已存在，请换一个试试',0,'unique',1),
        array('repassword','password','两次密码不相同',0,'confirm'), //验证确认密码是否和密码一致
        array('phone','/^1[34578]\d{9}$/','电话号码格式不对',1,'regex'),
        array('email','/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/','邮箱格式不对',1,'regex'),
        array('company','require','公司不能为空'),
        array('address','require','地址不能为空'),
        array('detailed','require','详细地址不能为空'),
        array('idcard',"/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}[0-9Xx]$)/",'身份证格式不对',1,'regex')
    );


    // 自动完成
    protected $_auto = array ( 
        array('addtime','time',3,'function'), // 对addtime字段在新增和编辑的时候写入当前时间戳 
        array('password','md5',1,'function') , // 对password字段在新增的时候使md5函数处理
        
    );


    // 处理查询数据
    public function getAll()
    {
        $list = $this->select();

        $leavel = array('超级管理员','经销商','二级经销商');
        foreach ($list as $key => $val) {
            $list[$key]['leavel'] = $leavel[$val['leavel']];
        }
        return $list;
    }

    

}
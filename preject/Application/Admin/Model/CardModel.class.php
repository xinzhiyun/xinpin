<?php
namespace Admin\Model;

use Think\Model;

/**
 * Class IC卡数据处理
 * @package Admin\Model
 * @author 潘宏钢 <619328391@qq.com>
 */
class CardModel extends Model
{   

    // 自动验证
    protected $_validate = array(
        array('iccard','require','IC卡编号不能为空'),
        array('iccard','','IC卡已存在，请核对后尝试',0,'unique',1),
        array('type','require','IC卡类型不能为空')
        
        // array('url','/@(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))@','网址格式不对',1,'regex')
    );


    // 自动完成
    protected $_auto = array ( 
        array('addtime','time',3,'function'), // 对addtime字段在新增和编辑的时候写入当前时间戳 

    );

    // 处理查询数据
    public function getAll()
    {
        $list = $this->select();

        $type = array('免费卡','计费卡','未知类型');
        $status = array('未绑定','已绑定','挂失','未知状态');
        foreach ($list as $key => $val) {
            $list[$key]['type'] = $type[$val['type']];
            $list[$key]['status'] = $status[$val['status']];
        }
        return $list;
    }


}
<?php
namespace Admin\Model;

use Think\Model;

/**
 * Class 工单数据处理
 * @package Admin\Model
 * @author 潘宏钢 <619328391@qq.com>
 */
class SchoolModel extends Model
{   

    // 自动验证
    protected $_validate = array(
        array('schoolname','require','学校名不能为空'),
        array('schoolname','','学校名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一        
        
    );


    // 自动完成
    protected $_auto = array ( 
        array('addtime','time',1,'function'), // 对addtime字段在新增和编辑的时候写入当前时间戳 
        array('updatetime','time',3,'function'), // 对addtime字段在新增和编辑的时候写入当前时间戳 
    );


    // 处理查询数据
    public function getAll()
    {
        $list = $this->select();

        // dump($list);

        foreach ($list as $key => $value) {
            $list[$key]['addtime'] = date("Y-m-d H:i:s", $value['addtime']);
            $list[$key]['updatetime'] = date("Y-m-d H:i:s", $value['updatetime']);
        }
        return $list;
    }


}
<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 机组控制器
 * 用来配置机组，浏览机组列表等
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class CrewController extends CommonController 
{
	/**
     * 机组列表
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function index()
    {	
       // 根据名称进行搜索
        $map = '';
        if(!empty($_GET['cname'])) $map['cname'] = array('like',"%{$_GET['cname']}%");

        $type = M('crew');
        
        $total =$type->where($map)->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $list = $type->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();
    }

    /**
     * 单个机组数据导入
     * 录入少量数据情况用此方法
     *
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function add()
    {
        if (IS_POST) {
            // dump($_POST);die;
            $devices = M('devices');
            $info = $devices->where('device_code='.$_POST['dcode'])->select();
            if ($info) {
                $device_type = D('crew');
                $info = $device_type->create();
               
                if($info){

                    $res = $device_type->add();
                    if ($res) {
                        // 更改设备绑定状态
                        $status['binding_status'] = 1;
                        $devices->where('device_code='.$_POST['dcode'])->save($status);
                        $this->success('机组设置成功啦！！！',U('crew/index'));
                    } else {
                        $this->error('机组设置失败啦！');
                    }
                
                } else {
                    // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                    $this->error($device_type->getError());
                }
            }else{
                $this->error('设备编码不存在，请先添加设备后尝试！');
            }
        }else{
            $devices = M('devices');
            $info = $devices->where('binding_status=0')->select();
            $this->assign('info',$info);
            $this->display();
        }

    }

    /**
     * 批量机组数据导入
     * 录入大量用此方法
     *
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function adds()
    {
        $this->display();
    }

    public function upload()
    {
        header("Content-Type:text/html;charset=utf-8");
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->exts = array(
            'xls',
            'xlsx'
        ); // 设置附件上传类
        $upload->savePath = '/'; // 设置附件上传目录
        // 上传文件
        $info = $upload->uploadOne($_FILES['excelData']);
        $filename = './Uploads' . $info['savepath'] . $info['savename'];
        $exts = $info['ext'];

        if (! $info) { 
            // 上传错误提示错误信息
            $this->error($upload->getError());
        } else { 
            // 上传成功
            $this->goods_import($filename, $exts);
        }
    }

    public function save_import($data)
    {   
        $i = 0;
        unset($data[1]);
        foreach ($data as $key => $val) {
            $_POST['cname'] = $val['A'];
            $_POST['dcode'] = (int)$val['B'];
            $crew = D('crew'); 
            $code = M('devices')->where("device_code='{$_POST["dcode"]}'")->find();
            if(!empty($code)) $this->error('设备码不存在');
            $cname = $crew->where("cname='{$_POST["dcode"]}'")->find();
            if(!empty($cname)) $this->error('机组不能重复');
            $info = $crew->create();
            if($info){
                $res = $crew->add();
                if (!$res) {
                    $this->error('导入失败啦！');
                }
            
            } else {
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($crew->getError());
            }
            $i++;
        }
        $this->success($i . '条数据导入成功',U('crew/index'));
    }

    private function getExcel($fileName, $headArr, $data)
    {
        vendor('PHPExcel');
        $date = date("Y_m_d", time());
        $fileName .= "_{$date}.xls";
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();
        // 设置表头
        $key = ord("A");
        foreach ($headArr as $v) {
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
            $key += 1;
        }
        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        foreach ($data as $key => $rows) { 
            // 行写入
            $span = ord("A");
            foreach ($rows as $keyName => $value) { 
                // 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j . $column, $value);
                $span ++;
            }
            $column ++;
        }
        
        $fileName = iconv("utf-8", "gb2312", $fileName);
        // 重命名表
        // 设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); // 文件通过浏览器下载
        exit();
    }

    protected function goods_import($filename, $exts = 'xls')
    {
        // 导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        vendor('PHPExcel');
        // 创建PHPExcel对象，注意，不能少了\
        $PHPExcel = new \PHPExcel();
        // 如果excel文件后缀名为.xls，导入这个类
        if ($exts == 'xls') {
            $PHPReader = new \PHPExcel_Reader_Excel5();
        } else 
            if ($exts == 'xlsx') {
                $PHPReader = new \PHPExcel_Reader_Excel2007();
            }
        
        // 载入文件
        $PHPExcel = $PHPReader->load($filename);
        // 获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $PHPExcel->getSheet(0);
        // 获取总列数
        $allColumn = $currentSheet->getHighestColumn();
        // 获取总行数
        $allRow = $currentSheet->getHighestRow();
        // 循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for ($currentRow = 1; $currentRow <= $allRow; $currentRow ++) {
            // 从哪列开始，A表示第一列
            for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn ++) {
                // 数据坐标
                $address = $currentColumn . $currentRow;
                // 读取到的数据，保存到数组$arr中
                $data[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
            }
        }

        $this->save_import($data);
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

}
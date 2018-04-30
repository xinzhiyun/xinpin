<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * IC卡控制器
 * 用来导入IC卡，浏览IC列表等
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class CardController extends CommonController 
{
	/**
     * IC卡列表
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function index()
    {	
        // 搜索功能
        if(trim(I('post.iccard'))){
            $map['iccard'] = array('like','%'.trim(I('post.iccard')).'%');
        }
        if(strlen(I('post.type'))) $map['type'] = I('post.type');
        $map['name'] = trim(I('post.name')) ? array('like','%'.trim(I('post.name')).'%'): '';
        $map['studentcode'] = trim(I('post.studentcode')) ? array('like','%'.trim(I('post.studentcode')).'%'): '';
        $map['school'] = trim(I('post.school')) ? array('like','%'.trim(I('post.school')).'%'): '';
        if(strlen(I('post.status'))) $map['status'] = I('post.status');
        // 时间
        $minaddtime = strtotime(trim(I('post.minaddtime')))?:false;
        $maxaddtime = strtotime(trim(I('post.maxaddtime')))?:false;
        if (is_numeric($maxaddtime)) {
            $map['addtime'][] = array('elt',$maxaddtime);
        }
        if (is_numeric($minaddtime)) {
            $map['addtime'][] = array('egt',$minaddtime);
        }

        // 删除数组中为空的值
        // $map = \array_filter($map);
        $map = array_filter($map, function ($v) {
            if ($v != "") {
                return true;
            }
            return false;
        });
        $type = D('card');
        $total =$type->where($map)->count();
        $page  = new \Think\Page($total,10);
        $pageButton =$page->show();

        $list = $type->where($map)->limit($page->firstRow.','.$page->listRows)->getAll();
        // dump($list);die;
        $this->assign('list',$list);
        $this->assign('button',$pageButton);
        $this->display();
    }

    public function add()
    {       
        $this->display();
    }

    public function edit($id)
    {
        if (IS_POST) {
            // dump($_POST);die;
            $mod = D('card');
            $info = $mod->create();
            
            if($info){
                $res = $mod->where("id=".$_POST['id'])->save();

                if ($res) {
                    $this->success('修改成功啦！',U('Card/index'));
                }else{
                    $this->error('修改失败！');
                }
            }else{
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($filter->getError());
            }
        }else{
            $info = M('card')->where("id=".$id)->select();
            $this->assign('info',$info);
            $this->display();
        }
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
            
            $_POST['iccard'] = $val['A'];
            $_POST['type'] = $val['B'];
            // $datas['addtime'] = time();
            $card = D('card'); 
            $info = $card->create();
            if($info){
                $res = $card->add();
                if (!$res) {
                    $this->error('导入失败啦！');
                }
            } else {
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($card->getError());
            }
            $i++;   
        }
        $this->success($i . '条数据导入成功',U('card/index'));

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
<?php
namespace Admin\Model;
use Think\Model;
use Org\Util\Date;
/**
 * Class DevicesModel
 * @package Admin\Model
 * 设备添加操作
 * @author 陈昌平 <chenchangping@foxmail.com>
 */
class DevicesModel extends Model
{
    // 自动验证
    protected $_validate = array(
        array('device_code', '15', '请输入正确的设备编码', '3', 'length'),
        array('device_code', '/^\d{15}$/', '设备编码只能是数字', '2', 'regex'),
        array('device_code', '', '请不要重复录入', '1', 'unique'),
        array('type_id','require','设备类型不能为空'),
        array('address','require','设备安装地址不能为空'),

    );

    // 自动完成
    protected $_auto = array(
        array('device_statu', '1'),
        array('addtime', 'time', 1, 'function'),
    );

    // 获取产品类型
    public function getCate()
    {
        $data = M('DeviceType')->field('id')->select();
        $res = array_column( $data, 'id' );
        return $res;
    }

    /**
     * 获取信息
     * @return [type] [description]
     */
    public function getInfoBydecode($code)
    {
        $data = $this
            ->where('device_code='.$code)
            ->join('LEFT JOIN xp_devices_statu on xp_devices.device_code = xp_devices_statu.DeviceID')
            ->join('LEFT JOIN xp_binding on xp_devices.id = xp_binding.did')
            ->join('LEFT JOIN xp_vendors on xp_binding.vid = xp_vendors.id')
            ->field('xp_vendors.name,xp_devices_statu.*,xp_devices.id,xp_devices.address')
            ->find();

        return $data;
    }

    public function getFilterInfo($code)
    {
        // 查询设备使用的Filter类型
        $res = $this->where('device_code='.$code)->find();
        $res = $this->getFilter($res['type_id']);
        $res = $this->getFilterDetail($res);

        return $res;
    }

    // 根据类型查询设备滤芯
    public function getFilter($type_id)
    {
        $sum = M('device_type')->where('id='.$type_id)->find();
        return $sum;
    }

    // 查询滤芯信息
    public function getFilterDetail($sum)
    {
        unset($sum['id'],$sum['typename'],$sum['addtime']);
        $sum = array_filter($sum);
        foreach ($sum as $key => $value) {
            $str = stripos($value,'-');
            $map['filtername'] = substr($value, 0,$str);
            $map['alias'] = substr($value, $str+1);
            $res[] = M('filters')->where($map)->find();
        }
        return $res;
    }

    // 取出设备详情信息
    public function getFilterFlow($data, $devicesInfo)
    {
        $devicestause = ['制水', '冲洗', '水满', '缺水', '漏水', '检修', '欠费', '关机','开机'];
        $alivestause = ['未激活', '已激活', 2, 3];
        $count = count($data);
        foreach ($devicesInfo as $key => $value) {
            if( $key == 'devicestause' ){
                $devicesInfo['devicestause'] = $devicestause[$value];
            }
            if( $key == 'alivestause' ){
                $devicesInfo['alivestause'] = $alivestause[$value];
            }
            if( $key == 'addtime' ){
                $devicesInfo['addtime'] = date('Y-m-d H:i:s', $value);
            }
            if( $key == 'updatetime' ){
                $devicesInfo['updatetime'] = date('Y-m-d H:i:s', $value);
            }
            if($value == null) $devicesInfo[$key] = '--';
        }
        // for ($i=0; $i < $count; $i++) { 
        //     $devicesInfo['redayfilter'.($i+1)] = ( round( ($devicesInfo['redayfilter'.($i+1)] / $data[$i]['timelife']), 2) ) * 100;
        //     $devicesInfo['reflowfilter'.($i+1)] = ( round( ($devicesInfo['reflowfilter'.($i+1)] / $data[$i]['flowlife']), 2) ) * 100;
        // }
        $devicesInfo['data'] = $data;
        return $devicesInfo;
    }

    // 根据设备编号查询经销商
    public function getVendors($code)
    {
        if( !empty($code) ){
            $res = $this->where($code)
                ->join("LEFT JOIN xp_crew ON xp_devices.device_code = xp_crew.dcode")
                ->join("LEFT JOIN xp_binding ON xp_devices.id = xp_binding.did")
                ->join("LEFT JOIN xp_vendors ON xp_binding.vid = xp_vendors.id")
                ->field("xp_vendors.*")
                ->find();

            return $res;
        }
        return false;
    }

    // 获取当月充值数据
    public function getCurrentMonth()
    {
        $date = new Date();
        $firstDayOfMonth = $date->firstDayOfMonth();
        $firstat = strtotime($firstDayOfMonth);
        $lastDayOfMonth = $date->lastDayOfMonth();
        $lastat = strtotime($lastDayOfMonth) + 24*60*60;

       $map['addtime'] = array(array('gt',$firstat),array('lt',$lastat), 'and');
       // $map['_query'] = "status=1";
       $data = $this
                ->where($map)
                ->select();
                // dump($data);
       return $data;
    }

    // 当月每一天的数据条数
    public function getTotalByEveryDay($data=[])
    {
        if (count($data) == 0) {
            $data = $this->getCurrentMonth();
        }
        // dump($data);
        $date = new Date();
        $maxDayOfMonth = $date->maxDayOfMonth();
        $firstDayOfMonth = $date->firstDayOfMonth();
        $startat = strtotime($firstDayOfMonth);
        $result = [];

        for ($i=0; $i < $maxDayOfMonth; $i++) { 


          foreach ($data as $key => $value) {
            if ($value['addtime'] >= $startat && $value['addtime'] <= $startat+24*60*60) {
            //   $result["$i"+1]['count'] += 1;
            //   $result["$i"+1]['money'] += $value['money'];
                if (!array_key_exists($i+1,$result)) {
                    $result["$i"+1]['count'] = 0;
                }
              $result["$i"+1]['count']  += 1;
            //   $result["$i"+1]['flow'] += $value['currentflow'];            
            } else {
                if (!array_key_exists($i+1,$result)) {
                    $result["$i"+1]['count'] = NULL;
                }
            }
          }
          $startat = $startat+24*60*60;

        }
        return $result;
    }
}
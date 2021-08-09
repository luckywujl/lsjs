<?php

namespace app\admin\model\service;

use think\Model;


class Repair extends Model
{

    

    

    // 表名
    protected $name = 'repair';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'repair_datetime_text',
        'repair_service_datetime_text',
        'repair_isfree_text',
        'repair_status_text'
    ];
    

    
    public function getRepairIsfreeList()
    {
        return ['0' => __('Repair_isfree 0'), '1' => __('Repair_isfree 1')];
    }

    public function getRepairStatusList()
    {
        return ['0' => __('Repair_status 0'), '1' => __('Repair_status 1'), '2' => __('Repair_status 2'), '3' => __('Repair_status 3'), '4' => __('Repair_status 4'), '5' => __('Repair_status 5')];
    }


    public function getRepairDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['repair_datetime']) ? $data['repair_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getRepairServiceDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['repair_service_datetime']) ? $data['repair_service_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getRepairIsfreeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['repair_isfree']) ? $data['repair_isfree'] : '');
        $list = $this->getRepairIsfreeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getRepairStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['repair_status']) ? $data['repair_status'] : '');
        $list = $this->getRepairStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setRepairDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setRepairServiceDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}

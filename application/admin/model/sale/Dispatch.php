<?php

namespace app\admin\model\sale;

use think\Model;


class Dispatch extends Model
{

    

    

    // 表名
    protected $name = 'order_main';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'order_datetime_text',
        'order_service_datetime_text',
        'order_status_text'
    ];
    

    
    public function getOrderStatusList()
    {
        return ['0' => __('Order_status 0'), '1' => __('Order_status 1'), '3' => __('Order_status 3')];
    }


    public function getOrderDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['order_datetime']) ? $data['order_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getOrderServiceDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['order_service_datetime']) ? $data['order_service_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getOrderStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['order_status']) ? $data['order_status'] : '');
        $list = $this->getOrderStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setOrderDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setOrderServiceDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}

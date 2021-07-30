<?php

namespace app\admin\model\service;

use think\Model;


class Repair extends Model
{

    

    

    // 表名
    protected $name = 'product_log';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'log_date_text',
        'log_status_text'
    ];
    

    
    public function getLogStatusList()
    {
        return ['0' => __('Log_status 0'), '1' => __('Log_status 1'), '2' => __('Log_status 2'), '3' => __('Log_status 3'), '4' => __('Log_status 4'), '5' => __('Log_status 5')];
    }


    public function getLogDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['log_date']) ? $data['log_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getLogStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['log_status']) ? $data['log_status'] : '');
        $list = $this->getLogStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setLogDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}

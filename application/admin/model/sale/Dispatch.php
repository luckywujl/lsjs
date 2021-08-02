<?php

namespace app\admin\model\sale;

use think\Model;


class Dispatch extends Model
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
        'log_status_text'
    ];
    

    
    public function getLogStatusList()
    {
        return ['0' => __('Log_status 0'), '1' => __('Log_status 1')];
    }


    public function getLogStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['log_status']) ? $data['log_status'] : '');
        $list = $this->getLogStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }
    
    public function productinfo()
    {
        return $this->belongsTo('app\admin\model\product\Info', 'product_id', 'product_id', [], 'LEFT')->setEagerlyType(0);
    }



}

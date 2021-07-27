<?php

namespace app\admin\model\sale;

use think\Model;


class Outstock extends Model
{

    

    

    // 表名
    protected $name = 'stock_instock';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'instock_date_text',
        'instock_type_text'
    ];
    

    
    public function getInstockTypeList()
    {
        return ['0' => __('Instock_type 0'), '1' => __('Instock_type 1')];
    }


    public function getInstockDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['instock_date']) ? $data['instock_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getInstockTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['instock_type']) ? $data['instock_type'] : '');
        $list = $this->getInstockTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setInstockDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}

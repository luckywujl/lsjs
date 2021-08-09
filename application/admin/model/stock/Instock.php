<?php

namespace app\admin\model\stock;

use think\Model;


class Instock extends Model
{

    

    

    // 表名
    protected $name = 'stock_iostock';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
    'iostock_date_text'

    ];
    public function getIostockDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['iostock_date']) ? $data['iostock_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }
    
    protected function setIostockDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


    







}

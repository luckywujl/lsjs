<?php

namespace app\admin\model\service;

use think\Model;


class Detailtemp extends Model
{

    

    

    // 表名
    protected $name = 'order_detail_temp';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'detail_isrecord_text'
    ];
    

    
    public function getDetailIsrecordList()
    {
        return ['0' => __('Detail_isrecord 0'), '1' => __('Detail_isrecord 1')];
    }


    public function getDetailIsrecordTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['detail_isrecord']) ? $data['detail_isrecord'] : '');
        $list = $this->getDetailIsrecordList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}

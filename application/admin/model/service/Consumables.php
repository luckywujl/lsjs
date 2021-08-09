<?php

namespace app\admin\model\service;

use think\Model;


class Consumables extends Model
{

    

    

    // 表名
    protected $name = 'product_info';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'product_product_date_text',
        'product_instock_date_text',
        'product_sale_date_text',
        'product_install_date_text',
        'product_log_date_text',
        'product_next_date_text',
        'product_replacement_date_text',
        'product_status_text'
    ];
    

    
    public function getProductStatusList()
    {
        return ['4' => __('Product_status 4'), '6' => __('Product_status 6'), '7' => __('Product_status 7'), '8' => __('Product_status 8'), '9' => __('Product_status 9'), '10' => __('Product_status 10')];
    }


    public function getProductProductDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_product_date']) ? $data['product_product_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductInstockDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_instock_date']) ? $data['product_instock_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductSaleDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_sale_date']) ? $data['product_sale_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductInstallDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_install_date']) ? $data['product_install_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductLogDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_log_date']) ? $data['product_log_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductNextDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_next_date']) ? $data['product_next_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductReplacementDateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_replacement_date']) ? $data['product_replacement_date'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_status']) ? $data['product_status'] : '');
        $list = $this->getProductStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setProductProductDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductInstockDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductSaleDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductInstallDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductLogDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductNextDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductReplacementDateAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}

<?php

namespace app\admin\controller\stock;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\stock as stock;

/**
 * 产品信息
 *
 * @icon fa fa-circle-o
 */
class Inventory extends Backend
{
    
    /**
     * Inventory模型对象
     * @var \app\admin\model\stock\Inventory
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'production_name,production_type';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\stock\Inventory;

    }

    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
     
    /**
    * 查看明细
    */ 
    public function detailindex() 
    {
    	//设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        $iostock = new stock\Iostock();
        $iostock_product_id = $this->request->param('iostock_product_id');//接收过滤条件
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $iostock
                ->where($where)
                ->where('iostock_product_id',$iostock_product_id)
                ->order($sort, $order)
                ->paginate($limit);
            $list_total = $iostock
            	 ->field('sum(iostock_number) as iostock_number,sum(iostock_outnumber) as iostock_outnumber')
            	 ->where($where)
            	 ->where('iostock_product_id',$iostock_product_id)
            	 ->select();
            $count =[];
            $count['iostock_product_name'] ='合计：';
            $count['iostock_number'] =$list_total[0]['iostock_number'];
            $count['iostock_outnumber'] =$list_total[0]['iostock_outnumber'];
            $list[] = $count;

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        $this->assignconfig('iostock_product_id',$iostock_product_id);
        return $this->view->fetch();
    }

}

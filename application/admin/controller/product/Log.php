<?php

namespace app\admin\controller\product;

use app\common\controller\Backend;

/**
 * 服务日志
 *
 * @icon fa fa-circle-o
 */
class Log extends Backend
{
    
    /**
     * Log模型对象
     * @var \app\admin\model\product\Log
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\product\Log;
        $this->view->assign("logStatusList", $this->model->getLogStatusList());
    }

    public function import()
    {
        parent::import();
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        $product_id = $this->request->param('product_id');//接收过滤条件
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            if (!empty($product_id)){

            $list = $this->model
                ->where($where)
                ->where(['product_id'=>$product_id])
                ->order($sort, $order)
                ->paginate($limit);
             }else {
             $list = $this->model
                ->where($where)
        
                ->order($sort, $order)
                ->paginate($limit);
             }

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }

}

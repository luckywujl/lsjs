<?php

namespace app\admin\controller\stock;

use app\common\controller\Backend;

/**
 * 出入库明细
 *
 * @icon fa fa-circle-o
 */
class Iostock extends Backend
{
    
    /**
     * Iostock模型对象
     * @var \app\admin\model\stock\Iostock
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    
    protected $noNeedRight = ['orderdetail'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\stock\Iostock;
        $this->view->assign("iostockTypeList", $this->model->getIostockTypeList());
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
    public function orderdetail()
    {
        //设置过滤方法
        $iostock_main_id = $this->request->param('iostock_main_id'); 
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
                ->where($where)
                ->where(['iostock_main_id'=>$iostock_main_id])
                ->order($sort, $order)
                ->paginate($limit);
           
            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }

}
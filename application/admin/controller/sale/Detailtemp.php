<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;

/**
 * 销售明细管理
 *
 * @icon fa fa-circle-o
 */
class Detailtemp extends Backend
{
    
    /**
     * Detailtemp模型对象
     * @var \app\admin\model\sale\Detailtemp
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $noNeedRight = ['index','add','edit','del','cleardetail'];
    protected $searchFields = 'detail_product_name';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Detailtemp;
        $this->view->assign("detailIsrecordList", $this->model->getDetailIsrecordList());
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
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
                ->where($where)
                ->where(['detail_main_id'=>1,'detail_operator'=>$this->auth->nickname])
                ->order($sort, $order)
                ->paginate($limit);
            $order_sum=$this->total();

            $result = array("total" => $list->total(), "rows" => $list->items(), "extend" => $order_sum[0]);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->company_id;
                }
                $sn = $this->model
                		->where(['detail_main_id'=>1,'company_id'=>$this->auth->company_id,'detail_operator'=>$this->auth->nickname])
                		->count();
                $params['detail_sn'] = $sn+1;
                $params['detail_main_id'] = 1;
                $params['detail_date'] = time();
                $params['detail_operator'] = $this->auth->nickname;
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                   // $this->reorder();
                   // $order_sum=$this->total();
                    Db::commit();
                   // $this->reorder();
                   // $order_sum=$this->total();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success('OK',null,null);
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
    /**
     * 编辑
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    $this->reorder();
                	  //$order_sum=$this->total();
                	  Db::commit();
                	  $this->reorder();
                	  //$order_sum=$this->total();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success('OK',null,null);
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        
        return $this->view->fetch();
    }
    /**
     * 删除
     */
    public function del($ids = "")
    {
        if (!$this->request->isPost()) {
            $this->error(__("Invalid parameters"));
        }
        $ids = $ids ? $ids : $this->request->post("ids");
        if ($ids) {
            $pk = $this->model->getPk();
            $adminIds = $this->getDataLimitAdminIds();
            if (is_array($adminIds)) {
                $this->model->where($this->dataLimitField, 'in', $adminIds);
            }
            $list = $this->model->where($pk, 'in', $ids)->select();

            $count = 0;
            Db::startTrans();
            try {
                foreach ($list as $k => $v) {
                    $count += $v->delete();
                }
                $this->reorder();
                //$order_sum=$this->total();
                Db::commit();
                //$this->reorder();
                //$order_sum=$this->total();
            } catch (PDOException $e) {
                Db::rollback();
                $this->error($e->getMessage());
            } catch (Exception $e) {
                Db::rollback();
                $this->error($e->getMessage());
            }
            if ($count) {
                $this->success('OK',null,null);
            } else {
                $this->error(__('No rows were deleted'));
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }
    
    /**
    *排序
    */
    public function reorder() 
    {
    	list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    	$detail_temp = $this->model
          ->where(['detail_main_id'=>1,'company_id'=>$this->auth->company_id,'detail_operator'=>$this->auth->nickname])
          ->order('detail_id asc')
          ->select();
      $info =[];        
    	$i = 0;
      foreach ($detail_temp as $k => $v) {
        $i = $i+1;
        $infod =[];
    	  $infod['detail_id'] = $v['detail_id'];
    	  $infod['detail_sn'] = $i;
        $info[]=$infod;
      }
      $this->model->saveall($info);
    }
    	/**
    	*合计
    	*/
    	public function total() 
    	{
    	//2、合计
    	list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    	
    	$detail_sum = $this->model
    				->field('sum(detail_number) as number,sum(detail_amount) as amount')
    				->where(['detail_main_id'=>1,'company_id'=>$this->auth->company_id,'detail_operator'=>$this->auth->nickname])
    				->select();

     return $detail_sum;
    }
    /**
     * 清空明细数据
     */
    public function cleardetail()
    {
    	  list($where, $sort, $order, $offset, $limit) = $this->buildparams();
        $detai_result = $this->model
           	   ->where($where)
            	->where(['detail_main_id'=>1,'detail_operator'=>$this->auth->nickname])
            	->delete();
          $this->success('OK',null,null);
           
    }


}

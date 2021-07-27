<?php

namespace app\admin\controller\stock;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\base as base;

/**
 * 入库记录
 *
 * @icon fa fa-circle-o
 */
class Instock extends Backend
{
    
    /**
     * Instock模型对象
     * @var \app\admin\model\stock\Instock
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'instock_product_name,instock_product_type,instock_operator,instock_number';
	

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\stock\Instock;

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
                ->where(['instock_type'=>0]) //入库操作
                ->order($sort, $order)
                ->paginate($limit);

            $result = array("total" => $list->total(), "rows" => $list->items());

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
                //生成单号
                $main = $this->model
                ->where('instock_date','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                ->where(['company_id'=>$this->auth->company_id,'instock_type'=>0]) //入库单
            	 -> order('instock_code','desc')->limit(1)->select();
        	       if (count($main)>0) {
        	       $item = $main[0];
        	  	    $code = '0000'.(substr($item['instock_code'],9,4)+1);
        	  	    $code = substr($code,strlen($code)-4,4);
        	      	$params['instock_code'] = 'J'.date('Ymd').$code;
        	      	} else {
        	  	   	$params['instock_code']='J'.date('Ymd').'0001';
        	      	}
        	      //完成单号生成
        	       $production = new base\Production();
        	       $production_info = $production
        	       		->where(['production_id'=>$params['instock_product_id'],'company_id'=>$this->auth->company_id])
        	       		->find();
        	       if($production_info) {
        	       	$params['instock_stock_number'] = $params['instock_number']+$production_info['production_stock_number'];
        	       } else {
        	       	$params['instock_stock_number'] = $params['instock_number'];
        	       }
        	       $params['instock_product_type'] = $production_info['production_type'];
                $params['instock_date']=time();
                $params['instock_operator'] = $this->auth->nickname;
                $params['instock_type'] = 0;
                
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $production_result = $production
        	       		->where(['production_name'=>$params['instock_product_name'],'production_type'=>$params['instock_product_type']])
        	       		->setInc('production_stock_number',$params['instock_number']);
                    $result = $this->model->allowField(true)->save($params);
                    Db::commit();
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
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
	  /**
     * 删除
     */
    public function del($ids = "")
    {
    	  $production = new base\Production();
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
                    $production_result = $production
    	                				->where(['production_id'=>$v['instock_product_id']])
    	                				->setDec('production_stock_number',$v['instock_number']); 
                }
                Db::commit();
            } catch (PDOException $e) {
                Db::rollback();
                $this->error($e->getMessage());
            } catch (Exception $e) {
                Db::rollback();
                $this->error($e->getMessage());
            }
            if ($count) {
                $this->success();
            } else {
                $this->error(__('No rows were deleted'));
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }


}

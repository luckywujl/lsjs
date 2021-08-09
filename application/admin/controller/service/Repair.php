<?php

namespace app\admin\controller\service;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\product as product;
use app\admin\model\setting as setting;

/**
 * 报修信息
 *
 * @icon fa fa-circle-o
 */
class Repair extends Backend
{
    
    /**
     * Repair模型对象
     * @var \app\admin\model\service\Repair
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'repair_user_name,repair_address,repair_tel,repair_code';
    //protected $noNeedRight = ['detailindex','detailadd','detailedit','detaildel','cleardetail'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\service\Repair;
        $this->view->assign("repairIsfreeList", $this->model->getRepairIsfreeList());
        $this->view->assign("repairStatusList", $this->model->getRepairStatusList());
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
     * 报修接单
     */
    public function add()
    {
        $log = new product\Log();
        $info = new product\Info();
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->company_id;
                }
                $params['repair_datetime'] = time();
                $params['repair_operator'] = $this->auth->nickname;
               
                //生成单号
                $main = $this->model
                ->where('repair_datetime','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                ->where(['company_id'=>$this->auth->company_id]) //出库单
            	 -> order('repair_code','desc')->limit(1)->select();
        	       if (count($main)>0) {
        	       $item = $main[0];
        	  	    $code = '0000'.(substr($item['repair_code'],10,4)+1);
        	  	    $code = substr($code,strlen($code)-4,4);
        	      	$params['repair_code'] = 'WX'.date('Ymd').$code;
        	      	} else {
        	  	   	$params['repair_code']='WX'.date('Ymd').'0001';
        	      	}
        	       $params['repair_status'] = 0 ;//建单
        	       if($params['repair_engineer']!=='') {
        	       	$params['repair_dispatcher'] = $this->auth->nickname;
 						$params['repair_status'] = 1 ;//派单
        	       }
        	      //完成单号生成
        	      $temp_l = [];//存放日志资料
                	  //如查工程师字段有值，派工
                    if($params['repair_engineer']!=='') {
                    			$temp_l['log_operator'] = $params['repair_engineer'];
        	       				$temp_l['log_status'] = 1;//派工
        	       				$temp_l['log_dispatcher'] = $this->auth->nickname;//派单人
        	       				$temp_l['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'维修接单，并预约'.datetime($params['repair_service_datetime']).'安排'.$params['repair_engineer'].'处理；';
        	       			   $temp_l['log_date'] =  $params['repair_service_datetime'];//用预约时间作为服务时间       			
                    		} else {
                    			$temp_l['log_status'] = 0;//建单
        	         			$temp_l['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'维修接单；';
        	         			//$temp_l['log_date'] =  $params['order_datetime'];//用销售时间作为服务时间 
                    		}	
                    		$temp_l['log_saleman'] = $this->auth->nickname;//用操作员作为销售员，便于回访，回访人
                    		$temp_l['log_type'] = '售后维修';
        	       			$temp_l['log_remark'] = $params['repair_remark'];
        	       			$temp_l['log_user_name'] = $params['repair_user_name'];
        	       			$temp_l['log_address'] = $params['repair_address'];
        	       			$temp_l['log_tel'] = $params['repair_tel'];
        	       			$temp_l['log_user_id'] = $params['repair_user_id'];
        	       			$temp_l['company_id'] = $this->auth->company_id;    
        	       			
                    		$temp_l['log_code'] = $params['repair_code'];
                    		
                    		$temp_l['product_id'] = $params['repair_product_id'];
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
                    $repair_id =$this->model->repair_id;
    
                    $result = $log->allowField(true)->save($temp_l);
                    if($params['repair_engineer']!=='') {
                    		$info_result = $info->where(['product_id'=>$params['repair_product_id'],'company_id'=>$this->auth->company_id])
                    				->update(['product_status'=>5]);
                    } else {
                    		$info_result = $info->where(['product_id'=>$params['repair_product_id'],'company_id'=>$this->auth->company_id])
                    				->update(['product_status'=>6]);
                    }
                    
                    
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
                    $this->success(null,null,$repair_id);
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
        $log = new product\Log();
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
                    $log_result = $log 
                    		->where(['log_code'=>$params['repair_code'],'company_id'=>$this->auth->company_id])
                    		->update(['log_tel'=>$params['repair_tel'],'log_address'=>$params['repair_address'],'log_remark'=>$params['repair_remark']]);
                	 
                    $repair_id = $row->repair_id;
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
                    $this->success(null,null,$repair_id);
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
     * 取消服务
     */
    public function del($ids = "")
    {
        $log = new product\Log();
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
                	
                	$log_result = $log 
                    		->where(['log_code'=>$v['repair_code'],'company_id'=>$this->auth->company_id])
                    		->update(['log_status'=>4]);
                	$repair_result = $this->model
                			->where(['repair_id'=>$v['repair_id']]) 
                			->update(['repair_status'=>4]);
                    //$count += $v->delete();
                }
                Db::commit();
            } catch (PDOException $e) {
                Db::rollback();
                $this->error($e->getMessage());
            } catch (Exception $e) {
                Db::rollback();
                $this->error($e->getMessage());
            }
            if ($repair_result) {
                $this->success();
            } else {
                $this->error(__('No rows were deleted'));
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }
    
    /**
     * 打印
     */
    public function print()
    {
    	 $params = $this->request->param();//接收过滤条件
    	 if(input('?repair_id')) {
    	   $repair_info = $this->model
    	   ->where('repair_id',$params['repair_id'])->find();
    	  
    	  $company = new setting\Company();  //公司信息表
    	  list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    	  
    	  $company_info = $company
    	  	 ->where($where)
    	  	 ->find();
    	  $repair_info['repair_date'] = date("Y-m-d",$repair_info['repair_datetime']);
    	  if(!empty($repair_info['repair_service_datetime'])) {
    	  		$repair_info['repair_service_date'] = date("Y-m-d h:i",$repair_info['repair_service_datetime']);
    	  }else {
    	  		$repair_info['repair_service_date'] = '待定';
    	  }
    	  if($repair_info['repair_amount']==0) {
    	  		$repair_info['repair_amount']='免费';
    	  }
    	  $repair_info['company_name'] = $company_info['company_name'];
    	  $repair_info['company_tel'] = $company_info['company_tel'];
    	  $repair_info['company_address'] = $company_info['company_address'];
    	  $repair_info['company_websit'] = $company_info['company_websit'];
    	  
    	 
       

        $result = array("data" =>$repair_info);
       
    	 }
        
        return json($result);
    }


}

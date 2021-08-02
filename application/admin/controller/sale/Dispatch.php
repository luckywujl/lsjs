<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\product as product;
use app\admin\model\base as base;
use app\admin\model\sale as sale;
use app\admin\model\stock as stock;
use app\admin\model\setting as setting;

/**
 * 服务日志
 *
 * @icon fa fa-circle-o
 */
class Dispatch extends Backend
{
    
    /**
     * Dispatch模型对象
     * @var \app\admin\model\sale\Dispatch
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'log_code,log_tel,log_address,log_operator';
    protected $noNeedRight = ['logdetail','logedit'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Dispatch;
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
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
            	 ->field('log_code,log_type,log_saleman,log_date,log_user_name,log_tel,log_address,log_operator,log_status,count(*) as tasknumber')
                ->where($where)
                ->where(['log_status'=>['in',[0,1]]])  //只求是我销售的和未结单的
                ->group('log_code,log_type,log_saleman,log_date,log_user_name,log_tel,log_address,log_operator,log_status')
                ->order($sort, $order)
                ->paginate($limit);

            

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
    /**
     * 销售回访
     */
    public function edit($ids = null)
    {
        $info = new product\Info();
        $log = new product\Log();
        $order = new sale\Order();
        $log_status = $this->request->param('log_status');
        $list = $this->model
            	 ->field('log_code,log_type,log_date,log_saleman,log_user_id,log_user_name,log_tel,log_address,log_operator,log_status,company_id,count(*) as tasknumber')
                ->where(['log_code'=>$ids,'log_status'=>$log_status,'company_id'=>$this->auth->company_id])  //只求我的和未结单的
                ->group('log_code,log_type,log_date,log_saleman,log_user_id,log_user_name,log_tel,log_address,log_operator,log_status,company_id')
                ->select();
        $row = $list[0];
       // $row = $this->model->where(['log_code'=>$ids])->find();
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
                  //  $result = $row->allowField(true)->save($params);
                   
                   if($row['log_status']!==1) {//如果原状态不是派单状态，需执行派单操作
                    $info_result = $info
                    		->where(['product_order_code'=>$ids,'product_status'=>1,'company_id'=>$this->auth->company_id])
                    		->update(['product_status'=>2]);//改为在用
                    $log_result_1 = $log
                    		->where(['log_code'=>$ids,'log_status'=>0,'company_id'=>$this->auth->company_id])
                    		->exp('log_log','concat(log_log,"'.date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'预约'.$params['log_date'].'安排'.$params['log_operator'].'安装;'.'")')
                    		->update();
               		}
           			$log_result = $log
                    		->where(['log_code'=>$ids,'log_status'=>$row['log_status'],'company_id'=>$this->auth->company_id])
                    		->exp('log_remark','concat(log_remark,"；'.$params['log_remark'].'")')
                    		->update();
           			$log_result = $log
                    		->where(['log_code'=>$ids,'log_status'=>$row['log_status'],'company_id'=>$this->auth->company_id])
                    		->update(['log_status'=>1,'log_dispatcher'=>$this->auth->nickname,'log_operator'=>$params['log_operator'],'log_date'=>strtotime($params['log_date']),'log_user_name'=>$params['log_user_name'],'log_tel'=>$params['log_tel'],'log_address'=>$params['log_address']]);
                  $order_result = $order
                  		->where(['order_code'=>$ids,'company_id'=>$this->auth->company_id])
                  		->update(['order_dispatcher'=>$this->auth->nickname,'order_service_datetime'=>strtotime($params['log_date']),'order_status'=>1,'order_engineer'=>$params['log_operator']]);
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
                if ($log_result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        $this->assignconfig("row", $row);
        return $this->view->fetch();
    }
    /**
     * 查看明细
     */
    public function logdetail()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $log_code = $this->request->param(); 
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
            	 ->with(['productinfo'])
                ->where($where)
                ->where(['log_code'=>$log_code['log_code'],'log_status'=>$log_code['log_status']])
                ->order($sort, $order)
                ->paginate($limit);
           
            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
    /**
     * 施工
     */
    public function logedit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $info = new product\Info();
        //$production = new base\Production();
        $info_info = $info->get($row['product_id']);
        //$production_info = $production
        //		->where(['production_name'=>$info_info['product_name'],'production_type'=>$info_info['product_type'],'company_id'=>$this->auth->company_id])
        //		->find();
        //$info_info['product_replacement_date'] = time()+$production_info['production_replacement_cycle']*365*86400;
        
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            $product = $this->request->post("product/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $product = $this->preExcludeFields($product);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    
                    if($row['log_status']!=='5') {
                    	  if ($params['log_status']=='5') {
                    	  	$params['log_log'] = $params['log_log'].date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'完成销售回访；'; 
                    	  }
                    }
                    $params['log_callbacker'] = $this->auth->nickname;
                    $result = $row->allowField(true)->save($params);
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
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        $this->view->assign("product",$info_info);
        return $this->view->fetch();
    }
    /**
     * 打印
     */
    public function print()
    {
    	 $order = new sale\Order();
    	 $params = $this->request->param();//接收过滤条件
    	 if(input('?order_code')) {
    	   $order_info = $order
    	   ->where(['order_code'=>$params['order_code'],'company_id'=>$this->auth->company_id])->find();
    	  $iostock = new stock\Iostock();
    	  $company = new setting\Company();  //公司信息表
    	  list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    	  $iostock_info = $iostock
    	    ->where($where)
          ->where(['iostock_main_id'=>$order_info['order_id']])
    	    ->select();
    	  $company_info = $company
    	  	 ->where($where)
    	  	 ->find();
    	  $order_info['order_date'] = date("Y-m-d",$order_info['order_datetime']);
    	  if(!empty($order_info['order_service_datetime'])) {
    	  		$order_info['order_service_date'] = date("Y-m-d h:i",$order_info['order_service_datetime']);
    	  }else {
    	  		$order_info['order_service_date'] = '待定';
    	  }
    	  $order_info['company_name'] = $company_info['company_name'];
    	  $order_info['company_tel'] = $company_info['company_tel'];
    	  $order_info['company_address'] = $company_info['company_address'];
    	  $order_info['company_websit'] = $company_info['company_websit'];
    	  $order_info['company_remark'] =$company_info['company_remark'];
    	  $info = []; 
    	  //加入合计的信息
    	  
    	  $total['iostock_product_name'] ='合计';
    	  $total['iostock_product_type'] = '支付：'.$order_info['order_paymentmode'];
    	  $total['iostock_outnumber'] =$order_info['order_number_total'];
    	  $total['iostock_amount'] =$order_info['order_amount_total'];
    	  if($order_info['order_remark']!=='') {
    	    $total['iostock_remark'] ='备 注：'.$order_info['order_remark'];
    	  }
    	  $iostock_info[] =$total;
       

        $result = array("data" =>$order_info,"list"=>$iostock_info);
       
    	 }
        
        return json($result);
    }


}

<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\stock as stock;
use app\admin\model\base as base;
use app\admin\model\product as product;
use app\admin\model\sale as sale;
use app\admin\model\setting as setting;

/**
 * 销售记录
 *
 * @icon fa fa-circle-o
 */
class Order extends Backend
{
    
    /**
     * Order模型对象
     * @var \app\admin\model\sale\Order
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'order_user_name,order_user_address,order_user_tel';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Order;
        $this->view->assign("orderStatusList", $this->model->getOrderStatusList());
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
     * 添加
     */
    public function add()
    {
    	  $iostock = new stock\Iostock();
    	  $detailtemp = new sale\Detailtemp();
    	  $production = new base\Production();
    	  $product = new product\Info();
    	  $log = new product\Log();
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->company_id;
                }
                //生成单号
                $main = $this->model
                ->where('order_datetime','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                ->where(['company_id'=>$this->auth->company_id]) //出库单
            	 -> order('order_code','desc')->limit(1)->select();
        	       if (count($main)>0) {
        	       $item = $main[0];
        	  	    $code = '0000'.(substr($item['order_code'],10,4)+1);
        	  	    $code = substr($code,strlen($code)-4,4);
        	      	$params['order_code'] = 'XS'.date('Ymd').$code;
        	      	} else {
        	  	   	$params['order_code']='XS'.date('Ymd').'0001';
        	      	}
        	      //完成单号生成
        	       $params['order_operator'] = $this->auth->nickname;//开单人
        	       $params['order_payamount'] = $params['order_amount_total'];//支付金额
                $params['order_datetime'] = time();
                if($params['order_engineer']!=='') {//如果开单时指定工程师，则同步派单
                	$params['order_status'] = 1;
                } else { //开单时未指定工程师，则暂不派单
                	$params['order_status'] = 0; 	
                }
                //以上完成order_main表的准备
                
                //转存明细表
                $detail_info = [];//用于存放明细表数据
                $log_info = []; //用于存放日志数据
                $detailtemp_info = $detailtemp
                		->where(['detail_main_id'=>1,'detail_operator'=>$this->auth->nickname,'company_id'=>$this->auth->company_id])
                		->order('detail_id asc')
                		->select();
                
                
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
                    $order_id = $this->model->order_id;  //获得保存主表后生成的main_id
                    $count = 0;
                    foreach ($detailtemp_info as $k => $v) {
                    $production_info = $production
                		->where(['production_id'=>$v['detail_product_id']])
                		->find();
                    $temp = [];
                    $temp['iostock_main_id']=$order_id;
                    $temp['iostock_code'] = $params['order_code'];
                    $temp['iostock_date'] = $params['order_datetime'];
                    $temp['iostock_sn'] = $v['detail_sn'];
                    $temp['iostock_product_id'] =$v['detail_product_id'];
                    $temp['iostock_product_name'] =$v['detail_product_name'];
                    $temp['iostock_product_type'] =$v['detail_product_type'];
                    $temp['iostock_unit'] =$v['detail_unit'];
                    $temp['iostock_outnumber'] =$v['detail_number'];
                    $temp['iostock_price'] =$v['detail_price'];
                    $temp['iostock_amount'] =$v['detail_amount'];
                    $temp['iostock_stock_number'] =$production_info['production_stock_number']-$v['detail_number'];  //实时库存
                    $temp['iostock_operator'] =$v['detail_operator'];
                    $temp['iostock_type'] = 2;  //销售
                	  $temp['iostock_remark']  = $v['detail_remark'];
                    $temp['company_id'] =$this->auth->company_id;
                    
                    //更新库存数量(扣减)
                    $production_result = $production
                    		->where(['production_id'=>$v['detail_product_id']])
                    		->setDec('production_stock_number',$v['detail_number']);
                    //是否建档
                    if($v['detail_isrecord']) {
                    		$temp_p = [];//存放建档资料
                    		$temp_l = [];//存放日志资料
                			$temp_p['product_name'] = $v['detail_product_name'];
                			$temp_p['product_type'] = $v['detail_product_type'];
                			$temp_p['product_instock_date'] = $params['order_datetime'];//统一日期
                			$temp_p['product_sale_date'] = $params['order_datetime'];
                			$temp_p['product_consumable_material'] = $production_info['production_consumable_material'];
                			$temp_p['product_remark'] = $params['order_remark'].'-'.$v['detail_remark'];
                			$temp_p['product_user_id'] = $params['order_user_id'];
               			$temp_p['product_user_name'] = $params['order_user_name'];
                			$temp_p['product_tel'] = $params['order_user_tel'];
                			$temp_p['product_address'] = $params['order_user_address'];
                			$temp_p['product_sale_type'] = $params['order_sale_type'];
                			$temp_p['company_id'] =$this->auth->company_id;
                			//如查工程师字段有值，派工
                    		if($params['order_engineer']!=='') {
                    			$temp_p['product_status'] = 2 ;//装机派单    
                    			$temp_l['log_operator'] = $params['order_engineer'];
        	       				$temp_l['log_status'] = 1;//派工
        	       				$temp_l['log_dispatcher'] = $this->auth->nickname;//派单人
        	       				$temp_l['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'销售出库，并预约'.datetime($params['order_service_datetime']).'安排'.$params['order_engineer'].'安装；';
        	       			   $temp_l['log_date'] =  $params['order_service_datetime'];//用预约时间作为服务时间       			
                    		} else {
                    			$temp_p['product_status'] = 1 ;//销售未派单	
                    			$temp_l['log_status'] = 0;//建单
        	         			$temp_l['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'销售出库；';
        	         			$temp_l['log_date'] =  $params['order_datetime'];//用销售时间作为服务时间 
                    		}	
                    		
                    		$temp_l['log_type'] = '新机销售';
        	       			$temp_l['log_remark'] = $v['detail_remark'];
        	       			$temp_l['log_user_name'] = $params['order_user_name'];
        	       			$temp_l['log_address'] = $params['order_user_address'];
        	       			$temp_l['log_tel'] = $params['order_user_tel'];
        	       			$temp_l['log_user_id'] = $params['order_user_id'];
        	       			$temp_l['company_id'] = $this->auth->company_id;
                    		
                    		
                    		$product_result = $product->allowField(true)->save($temp_p);
                    		$temp_l['product_id'] = $product->product_id;
                    		
                    }
                    $detail_info[] = $temp; 
                    $log_info[] =$temp_l;
                    //删除临时明细数据
                    $count += $v->delete();
                }
                  
                  $iostock_result = $iostock->allowField(true)->saveAll($detail_info);
                  $log_result = $log->allowField(true)->saveAll($log_info);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rllback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success(null,null,$order_id);
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
                    $this->success('OK',null,null);
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        $this->assignconfig("row", $row['order_id']);
        return $this->view->fetch();
    }
    /**
     * 打印
     */
    public function print()
    {
    	 $params = $this->request->param();//接收过滤条件
    	 if(input('?order_id')) {
    	   $order_info = $this->model
    	   ->where('order_id',$params['order_id'])->find();
    	  $iostock = new stock\Iostock();
    	  $company = new setting\Company();  //公司信息表
    	  list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    	  $iostock_info = $iostock
    	    ->where($where)
          ->where(['iostock_main_id'=>$params['order_id']])
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
    	  $total = [];
    	  $total['iostock_product_name'] ='- ';
    	  $iostock_info[] =$total;
    	  $total = [];
    	  $total['iostock_product_name'] ='合计';
    	  $total['iostock_outnumber'] =$order_info['order_number_total'];
    	  $total['iostock_amount'] =$order_info['order_amount_total'];
    	  $total['iostock_remark'] ='备 注：'.$order_info['order_remark'];
    	  $iostock_info[] =$total;
       

        $result = array("data" =>$order_info,"list"=>$iostock_info);
       
    	 }
        
        return json($result);
    }


}

<?php

namespace app\admin\controller\service;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\stock as stock;
use app\admin\model\base as base;
use app\admin\model\product as product;
use app\admin\model\sale as sale;
use app\admin\model\setting as setting;
use app\admin\model\service as service;

/**
 * 销售记录
 *
 * @icon fa fa-circle-o
 */
class Corder extends Backend
{
    
    /**
     * Order模型对象
     * @var \app\admin\model\sale\Order
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'order_user_name,order_user_address,order_user_tel';
    protected $noNeedRight = ['add','detailindex','detailadd','detailedit','detaildel','cleardetail'];


    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\service\Corder;
        $this->view->assign("orderStatusList", $this->model->getOrderStatusList());
        //$this->view->assign("detailIsrecordList", $this->model->getDetailIsrecordList());
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
    	  $detailtemp = new service\Cdetailtemp();
    	  $production = new base\Production();
    	  $product = new product\Info();
    	  $log = new product\Log();
    	  $user_info = $this->request->param();//接收传过来的客户信息
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
                	$params['order_dispatcher'] = $this->auth->nickname;
                	$params['order_status'] = 1;
                } else { //开单时未指定工程师，则暂不派单
                	$params['order_status'] = 0; 	
                }
                //以上完成order_main表的准备
                
                //转存明细表
                $detail_info = [];//用于存放明细表数据
                $log_info = [];//用于存放日志数据
               
                $detailtemp_info = $detailtemp
                		->where(['detail_main_id'=>3,'detail_operator'=>$this->auth->nickname,'company_id'=>$this->auth->company_id])
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
                    
                
                   foreach ( $detailtemp_info as $k => $v) {
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
                    $temp['iostock_person'] =$this->auth->nickname;//报修接单人
                    $temp['iostock_type'] = 2;  //销售
                	  $temp['iostock_remark']  = $v['detail_remark'];
                    $temp['company_id'] =$this->auth->company_id;
                    
                    //更新库存数量(扣减)
                    $production_result = $production
                    		->where(['production_id'=>$v['detail_product_id']])
                    		->setDec('production_stock_number',$v['detail_number']);
						  
						  $temp_l = [];//存放日志资料
                    //如查工程师字段有值，派工
                    if($params['order_engineer']!=='') {  
                    		$temp_l['log_operator'] = $params['order_engineer'];
        	       			$temp_l['log_status'] = 1;//派工
        	       			$temp_l['log_dispatcher'] = $this->auth->nickname;//派单人
        	       			$temp_l['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'销售出库，并预约'.datetime($params['order_service_datetime']).'安排'.$params['order_engineer'].'安装；';
        	       			$temp_l['log_date'] =  $params['order_service_datetime'];//用预约时间作为服务时间       			
                    	} else {
                    		$temp_l['log_status'] = 0;//建单
        	         		$temp_l['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'销售出库；';
        	         	}	
                    	$temp_l['log_saleman'] = $this->auth->nickname;//销售员填写自己，便于回访
                    	$temp_l['log_type'] = '换芯售后';
        	       		$temp_l['log_remark'] = $v['detail_remark'];
        	       		$temp_l['log_user_name'] = $params['order_user_name'];
        	       		$temp_l['log_address'] = $params['order_user_address'];
        	       		$temp_l['log_tel'] = $params['order_user_tel'];
        	       		$temp_l['log_user_id'] = $params['order_user_id'];
        	       		$temp_l['company_id'] = $this->auth->company_id;    
                    	$temp_l['log_code'] = $params['order_code'];
                    	$temp_l['product_id'] = $params['product_id'];
                    	$log_info[] = $temp_l;
                    	
						  
                     $detail_info[] = $temp; //出入库明细
                    //删除临时明细数据
                    $count += $v->delete();
                }
                  $log_result = $log->allowField(true)->saveAll($log_info);
                  $iostock_result = $iostock->allowField(true)->saveAll($detail_info);//入库明细
             
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
        $this->view->assign('user_info',$user_info);
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
        $info = new product\Info();
        $log = new product\Log();
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
                    $order_id=$row->order_id;
                    $info_result = $info 
                    		->where(['product_order_code'=>$params['order_code'],'company_id'=>$this->auth->company_id])
                    		->update(['product_user_id'=>$params['order_user_id'],'product_user_name'=>$params['order_user_name'],'product_tel'=>$params['order_user_tel'],'product_address'=>$params['order_user_address'],'product_saleman'=>$params['order_saleman']]);
                	  $log_result = $log 
                    		->where(['log_code'=>$params['order_code'],'company_id'=>$this->auth->company_id])
                    		->update(['log_user_id'=>$params['order_user_id'],'log_user_name'=>$params['order_user_name'],'log_tel'=>$params['order_user_tel'],'log_address'=>$params['order_user_address'],'log_saleman'=>$params['order_saleman']]);
                	 
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
                	 $this->success(null,null,$order_id);
                   //$this->success('OK',null,null);
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
    	  if($order_info['order_remark']!=='') {
    	    $total['iostock_remark'] ='备 注：'.$order_info['order_remark'];
    	  }
    	  $info = []; 
    	  //加入合计的信息
    	  
    	  $total['iostock_product_name'] ='合计';
    	  $total['iostock_product_type'] = '支付：'.$order_info['order_paymentmode'];
    	  $total['iostock_outnumber'] =$order_info['order_number_total'];
    	  $total['iostock_amount'] =$order_info['order_amount_total'];
    	  $total['iostock_remark'] ='备 注：'.$order_info['order_remark'];
    	  $iostock_info[] =$total;
       

        $result = array("data" =>$order_info,"list"=>$iostock_info);
       
    	 }
        
        return json($result);
    }
    
    /**
     * 销售退货
     */
    public function del($ids = "")
    {
    	  $production = new base\Production();
    	  $iostock = new stock\Iostock();
    	  $info = new product\Info();
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
                	if($v['order_status']==4) {
                		Db::rollback();
                  	$this->error(__('不可以重复退货'));
                  }
                	//1、退库存(先查出单据包含哪些明细，再逐条遍历)
                	$iostock_info = $iostock
                			->where(['iostock_main_id'=>$v['order_id']])
                			->select();
                	foreach($iostock_info as $x => $y){
                		$production_info = $production
                				->where(['production_id'=>$y['iostock_product_id']])
                				->find();
                		//添加退货记录
                		$iostock_row = [];
                		$iostock_row['iostock_main_id'] = $y['iostock_main_id'];
                		$iostock_row['iostock_code'] = $y['iostock_code'];
                		$iostock_row['iostock_date'] = time();
                		$iostock_row['iostock_sn'] = $y['iostock_sn'];
                		$iostock_row['iostock_product_id'] = $y['iostock_product_id'];
                		$iostock_row['iostock_product_name'] = $y['iostock_product_name'];
                		$iostock_row['iostock_product_type'] = $y['iostock_product_type'];
                		$iostock_row['iostock_unit'] = $y['iostock_unit'];
                		$iostock_row['iostock_number'] = $y['iostock_outnumber'];
                		$iostock_row['iostock_price'] = $y['iostock_price'];
                		$iostock_row['iostock_amount'] = $y['iostock_amount'];
                		$iostock_row['iostock_stock_number'] = $production_info['production_stock_number']+$y['iostock_outnumber'];
                		$iostock_row['iostock_operator'] = $this->auth->nickname;
                		$iostock_row['iostock_type'] = 3;//销售退货 
                		$iostock_row['iostock_remark'] = '客户'.$v['order_user_name'].'销售退货，原销售单号：'.$v['order_code'];
                		$iostock_row['company_id'] = $this->auth->company_id;
                		$iostock_result = $iostock->allowField(true)->save($iostock_row);//保证退货出入库记录
                		
                		//退库存数量
                		$production_result = $production
                				->where(['production_id'=>$y['iostock_product_id']])
                				->setInc('production_stock_number',$y['iostock_outnumber']);  //将库存加上去
                		$info_info = $info
                				->where(['product_order_id'=>$v['order_id']])
                				->select();
                		$log_result = $log
                				->where(['product_id'=>['in',array_column($info_info,'product_id')]])
                				->delete();//删除LOG表中所有与主条产品信息相关的记录
                		$log_result = $log
                				->where(['log_code'=>$v['order_code'],'company_id'=>$this->auth->company_id])
                				->delete();//删除LOG表中所有与主条产品信息相关的记录
                		$info_result =$info 
                				->where(['product_order_id'=>$v['order_id']])
                				->delete();//删除档案主表
                	}
                	$order_result = $this->model
                			->where(['order_id'=>$v['order_id']])
                			->update(['order_status'=>4]);//将销售单主表状态设置为作废
                	
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
            if ($order_result) {
                $this->success();
            } else {
                $this->error(__('No rows were deleted'));
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }
    /**
     * 明细清单
     */
    public function detailindex()
    {
        $detailtemp = new sale\Detailtemp();
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $detailtemp
                ->where($where)
                ->where(['detail_main_id'=>3,'detail_operator'=>$this->auth->nickname])  //2为售后销售
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
    public function detailadd()
    {
    	  $detailtemp = new sale\Detailtemp();
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->company_id;
                }
                $sn = $detailtemp
                		->where(['detail_main_id'=>3,'company_id'=>$this->auth->company_id,'detail_operator'=>$this->auth->nickname])
                		->count();
                $params['detail_sn'] = $sn+1;
                $params['detail_main_id'] = 3;
                $params['detail_date'] = time();
                $params['detail_operator'] = $this->auth->nickname;
                $params['detail_isrecord'] = 0;
                $params['detal_isinstall'] = 0;
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $detailtemp->allowField(true)->save($params);
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
                    $this->success('OK',null,$params);//将提交的信息返回给JS,再由JS中的api_add去解析给parent里的字段赋值
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->assignconfig("user_id", $this->request->param('user_id'));
        return $this->view->fetch();
      
    }
    /**
     * 编辑
     */
    public function detailedit($ids = null)
    {
    	  $detailtemp = new sale\Detailtemp();
        $row = $detailtemp->get($ids);
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
                        $name = str_replace("\\model\\", "\\validate\\", get_class($detailtemp));
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
    public function detaildel($ids = "")
    {
        $detailtemp = new sale\Detailtemp();
        if (!$this->request->isPost()) {
            $this->error(__("Invalid parameters"));
        }
        $ids = $ids ? $ids : $this->request->post("ids");
        if ($ids) {
            $pk = $detailtemp->getPk();
            $adminIds = $this->getDataLimitAdminIds();
            if (is_array($adminIds)) {
                $this->model->where($this->dataLimitField, 'in', $adminIds);
            }
            $list = $detailtemp->where($pk, 'in', $ids)->select();

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
    	$detailtemp = new sale\Detailtemp();
    	list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    	$detail_temp = $detailtemp
          ->where(['detail_main_id'=>3,'company_id'=>$this->auth->company_id,'detail_operator'=>$this->auth->nickname])
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
    	$detailtemp = new sale\Detailtemp();
    	list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    	
    	$detail_sum = $detailtemp
    				->field('sum(detail_number) as number,sum(detail_amount) as amount')
    				->where(['detail_main_id'=>3,'company_id'=>$this->auth->company_id,'detail_operator'=>$this->auth->nickname])
    				->select();

     return $detail_sum;
    }
    /**
     * 清空明细数据
     */
    public function cleardetail()
    {
    	  $detailtemp = new sale\Detailtemp();
    	  list($where, $sort, $order, $offset, $limit) = $this->buildparams();
        $detai_result = $detailtemp
           	   ->where($where)
            	->where(['detail_main_id'=>3,'detail_operator'=>$this->auth->nickname])
            	->delete();
          $this->success('OK',null,null);
           
    }


}

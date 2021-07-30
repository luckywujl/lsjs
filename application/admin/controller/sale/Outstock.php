<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\base as base;
use app\admin\model\user as user;
use app\admin\model\product as product;

/**
 * 入库记录
 *
 * @icon fa fa-circle-o
 */
class Outstock extends Backend
{
    
    /**
     * Outstock模型对象
     * @var \app\admin\model\sale\Outstock
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'instock_product_name,instock_product_type,instock_operator';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Outstock;
        $this->view->assign("instockTypeList", $this->model->getInstockTypeList());
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
                ->where(['instock_type'=>2]) //销售操作
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
    	  $production = new base\Production();//定义production模型
    	  $user = new user\User();//定义user模型
    	  $info = new product\Info(); //定义装机档案模型
    	  $log = new product\Log();//定义服务日志模型
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
                ->where(['company_id'=>$this->auth->company_id,'instock_type'=>2]) //出库单
            	 -> order('instock_code','desc')->limit(1)->select();
        	       if (count($main)>0) {
        	       $item = $main[0];
        	  	    $code = '0000'.(substr($item['instock_code'],9,4)+1);
        	  	    $code = substr($code,strlen($code)-4,4);
        	      	$params['instock_code'] = 'X'.date('Ymd').$code;
        	      	} else {
        	  	   	$params['instock_code']='X'.date('Ymd').'0001';
        	      	}
        	      //完成单号生成
        	       
        	       $production_info = $production
        	       		->where(['production_id'=>$params['instock_product_id'],'company_id'=>$this->auth->company_id])
        	       		->find();
        	       $user_info = $user
        	       		->where(['id'=>$params['product_user_id'],'company_id'=>$this->auth->company_id])
        	       		->find();
        	       if($production_info) {
        	       	$params['instock_stock_number'] = $production_info['production_stock_number']-$params['instock_outnumber'];
        	       } else {
        	       	$params['instock_stock_number'] = 0-$params['instock_outnumber'];
        	       }
        	       $product_info = [];//用于生成装机档案
        	       $product_log = []; //用于生成装机服务日志
        	       $params['instock_product_type'] = $production_info['production_type'];
                $params['instock_date']=time();
                $params['instock_operator'] = $this->auth->nickname;
                $params['instock_type'] = 2; //销售
                if($params['instock_remark']!=='') {
                	$remark = ';备注：'.$params['instock_remark'];
                } else {
                	$remark = '';
                }
                $params['instock_remark'] = '客户名称：'.$user_info['name'].'；联系电话：'.$params['product_tel'].'；装机地址：'.$params['product_address'].$remark;
                
                $product_info = [];//用于生成装机档案
                $product_info['product_name'] = $params['instock_product_name'];
                $product_info['product_type'] = $params['instock_product_type'];
                $product_info['product_instock_date'] = $params['instock_date'];//统一日期
                $product_info['product_sale_date'] = $params['instock_date'];
                $product_info['product_consumable_material'] = $production_info['production_consumable_material'];
                $product_info['product_remark'] = $params['instock_remark'];
                $product_info['product_user_id'] = $params['product_user_id'];
                $product_info['product_user_name'] = $user_info['name'];
                $product_info['product_tel'] = $params['product_tel'];
                $product_info['product_address'] = $params['product_address'];
                $product_info['product_sale_type'] = $params['product_sale_type'];
                $product_info['product_status'] = 1 ;
                $product_info['company_id'] =$this->auth->company_id;

        	       $product_log = []; //用于生成装机服务日志
        	       //生成单号
                $main_1 = $log
                ->where('log_date','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                ->where(['company_id'=>$this->auth->company_id,'log_type'=>'新机销售']) //出库单
            	 -> order('log_code','desc')->limit(1)->select();
        	       if (count($main_1)>0) {
        	       $item = $main_1[0];
        	  	    $code = '0000'.(substr($item['log_code'],9,4)+1);
        	  	    $code = substr($code,strlen($code)-4,4);
        	      	$product_log['log_code'] = 'X'.date('Ymd').$code;
        	      	} else {
        	  	   	$product_log['log_code']='X'.date('Ymd').'0001';
        	      	}
        	      //完成单号生成
        	       $product_log['log_type'] = '新机销售';
        	       $product_log['log_date'] = $params['instock_date'];//统一日期
        	       $product_log['log_remark'] = $params['instock_remark'];
        	       $product_log['log_address'] = $params['product_address'];
        	       $product_log['log_tel'] = $params['product_tel'];
        	       $product_log['log_user_id'] = $params['product_user_id'];
        	       if($params['log_operator']!=='') {
        	       	$product_log['log_operator'] = $params['log_operator'];
        	       	$product_log['log_status'] = 1;//派工
        	       	$product_log['log_dispatcher'] = $this->auth->nickname;//派单人
        	       	$product_log['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'销售出库，并安排'.$params['log_operator'].'安装；';
        	       }else{
        	         $product_log['log_status'] = 0;//建单
        	         $product_log['log_log'] = date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'销售出库；';
        	       }
        	       $product_log['company_id'] = $this->auth->company_id;
        	      
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $production_result = $production//减少库存
        	       		->where(['production_id'=>$params['instock_product_id'],'company_id'=>$this->auth->company_id])
        	       		->setDec('production_stock_number',$params['instock_outnumber']);
                    $result = $this->model->allowField(true)->save($params);
                    $result_1 =$info->allowField(true)->save($product_info);
                    $product_log['product_id'] = $info->product_id;
                    $result_2 =$log->allowField(true)->save($product_log);
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
     * 退货
     */
    public function del($ids = "")
    {
    	  $production = new base\Production();
    	  $info = new product\Info(); //定义装机档案模型
    	  $log = new product\Log();//定义服务日志模型
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
                    $production_result = $production
    	                				->where(['production_id'=>$v['instock_product_id']])
    	                				->setInc('production_stock_number',$v['instock_outnumber']); //把退掉的数量加到库存上
    	              $info_info = $info  //根据销售时间，长到装机库里的记录
    	              					->where(['product_sale_date'=>$v['instock_date'],'company_id'=>$this->auth->company_id])
    	              					->find();
    	              if($info_info) {
    	              		$log_result = $log  // 删除服务日志
    	              					->where(['product_id'=>$info_info['product_id'],'company_id'=>$this->auth->company_id])
    	              					->delete();
    	              		$info_result = $info  //删除装机库中的记录
    	              					->where(['product_id'=>$info_info['product_id'],'company_id'=>$this->auth->company_id])
    	              					->delete();
    	              }				   					
    	              $count += $v->delete();
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

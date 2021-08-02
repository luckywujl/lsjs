<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\product as product;
use app\admin\model\base as base;
use app\admin\model\sale as sale;

/**
 * 服务日志
 *
 * @icon fa fa-circle-o
 */
class Callback extends Backend
{
    
    /**
     * Callback模型对象
     * @var \app\admin\model\sale\Callback
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $searchFields = 'log_code,log_tel,log_address,log_operator';
    protected $noNeedRight = ['logdetail','logedit'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Callback;
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
            	 ->field('log_code,log_type,log_date,log_saleman,log_user_name,log_tel,log_address,log_operator,log_status,count(*) as tasknumber')
                ->where($where)
                ->where(['log_saleman'=>$this->auth->nickname,'log_status'=>['in',[2,3,4,5]]])  //只求是我销售的和未结单的
                ->group('log_code,log_type,log_date,log_saleman,log_user_name,log_tel,log_address,log_operator,log_status')
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
            	 ->field('log_code,log_type,log_date,log_saleman,log_user_name,log_tel,log_address,log_operator,log_status,company_id,count(*) as tasknumber')
                ->where(['log_saleman'=>$this->auth->nickname,'log_code'=>$ids,'log_status'=>$log_status,'company_id'=>$this->auth->company_id])  //只求我的和未结单的
                ->group('log_code,log_type,log_date,log_saleman,log_user_name,log_tel,log_address,log_operator,log_status,company_id')
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
                   if($params['log_status']==5) {
                   	 if($row['log_status']!==5) {
                    $info_result = $info
                    		->where(['product_order_code'=>$ids,'product_saleman'=>$this->auth->nickname,'product_status'=>3,'company_id'=>$this->auth->company_id])
                    		->update(['product_status'=>4]);//改为在用
                    $order_result = $order
                    		->where(['order_code'=>$ids,'order_saleman'=>$this->auth->nickname,'company_id'=>$this->auth->company_id])
                    		->update(['order_status'=>2]); //订单状态改为安装完成，结单
                    $log_result_1 = $log
                    		->where(['log_code'=>$ids,'log_saleman'=>$this->auth->nickname,'log_status'=>2,'company_id'=>$this->auth->company_id])
                    		->exp('log_log','concat(log_log,"'.date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'完成销售回访;'.'")')
                    		->update();
               		}
           			}
           			$log_result = $log
                    		->where(['log_code'=>$ids,'log_saleman'=>$this->auth->nickname,'log_status'=>$row['log_status'],'company_id'=>$this->auth->company_id])
                    		->update(['log_status'=>$params['log_status'],'log_valuation'=>$params['log_valuation'],'log_valuation_star'=>$params['log_valuation_star'],'log_callback'=>$params['log_callback'],'log_callbacker'=>$this->auth->nickname]);
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
                ->where(['log_code'=>$log_code['log_code'],'log_saleman'=>$this->auth->nickname,'log_status'=>$log_code['log_status']])
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

}

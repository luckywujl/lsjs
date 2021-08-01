<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\product as product;

/**
 * 销售记录
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

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Dispatch;
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
                ->where(['order_status'=>['in',[0,1,3]]])
                ->order($sort, $order)
                ->paginate($limit);

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
    /**
     * 编辑
     */
    public function edit($ids = null)
    {
    	  $info = new product\Info();
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
                    $params['order_status'] = 1;
                    $params['order_dispatcher'] = $this->auth->nickname;
                    //保存
                    $result = $row->allowField(true)->save($params);
                    $order_id=$row->order_id;
                    //修改建档数据中的机器状态为装机派单
                    $info_result = $info 
                    		->where(['product_order_id'=>$order_id])
                    		->update(['product_status'=>2,'product_next_date'=>$params['order_service_datetime']]);
                    //更正派单数据即工程师，预约时间
                    if($row['order_status']!==1) { //如果状态发生改变，即从原来的销售转为派单，则写日志 ，否则不写日志
                    	 if ($params['order_status']==1){

                      $log_result = $log
                    		->where(['log_code'=>$params['order_code'],'company_id'=>$this->auth->company_id])
                    		->exp('log_log','concat(log_log,"'.date('Y-m-d H:i:s',time()).':由'.$this->auth->nickname.'预约'.datetime($params['order_service_datetime']).'安排'.$params['order_engineer'].'安装；'.'")')
                    		->update();
                    		}
                		}
                      $log_result = $log
                    		->where(['log_code'=>$params['order_code'],'company_id'=>$this->auth->company_id])
                    		->update(['log_status'=>1,'log_date'=>$params['order_service_datetime'],'log_operator'=>$params['order_engineer'],'log_dispatcher'=>$this->auth->nickname]);		

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

}

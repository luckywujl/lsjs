<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:95:"/home/www/admin/localhost_9006/wwwroot/public/../application/admin/view/service/corder/add.html";i:1630151238;s:81:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:78:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:80:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="referrer" content="never">
<meta name="robots" content="noindex, nofollow">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<?php if(\think\Config::get('fastadmin.adminskin')): ?>
<link href="/assets/css/skins/<?php echo \think\Config::get('fastadmin.adminskin'); ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<?php endif; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>

    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav') && \think\Config::get('fastadmin.breadcrumb')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <?php if($auth->check('dashboard')): ?>
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <?php endif; ?>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    
    <div class="form-group">
        
   
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_user_name" data-rule="required" readonly="readonly" class="form-control" name="row[order_user_name]" type="text" value="<?php echo htmlentities($user_info['user_name']); ?>">
        		
        </div>
         
        <div class="col-xs-12 col-sm-8" hidden="hidden" >
            <input id="c-order_user_id" data-rule="required" readonly="readonly" class="form-control "  name="row[order_user_id]" type="text" value="<?php echo htmlentities($user_info['user_id']); ?>">
        		<input id="c-order_id"  class="form-control"  type="text">
        		<input id="c-product_id" data-rule="required" readonly="readonly" class="form-control "  name="row[product_id]" type="text" value="<?php echo htmlentities($user_info['product_id']); ?>">
        		
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_user_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_user_tel"  class="form-control" readonly="readonly" name="row[order_user_tel]" type="text" value="<?php echo htmlentities($user_info['user_tel']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_user_address'); ?>:</label>
        <div class="col-xs-12 col-sm-3">
            <input id="c-order_user_address"  class="form-control" readonly="readonly" name="row[order_user_address]" type="text" value="<?php echo htmlentities($user_info['user_address']); ?>">
        </div>
        
    </div>
    <div class="form-group" hidden="hidden">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_engineer'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_engineer"  class="form-control "  name="row[order_engineer]" type="text" >
        </div>
       
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_service_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_service_datetime" class="form-control "  name="row[order_service_datetime]" type="text" >
        </div> 
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_sale_type'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_sale_type"  class="form-control" name="row[order_sale_type]" type="text" value="售后报修">
        </div>      
    </div>
     <div class="form-group">
     	  <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_number_total'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_number_total" readonly="readonly"  data-rule="required" class="form-control" name="row[order_number_total]" type="number">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_amount_total'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_amount_total" readonly="readonly" data-rule="required" class="form-control" name="row[order_amount_total]" type="number">
        </div>
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_paymentmode'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
           <?php echo build_radios('row[order_paymentmode]', ['现金'=>__('现金'), '转账'=>__('转账'), '支付宝'=>__('支付宝'), '微信'=>__('微信'), '其它'=>__('其它')], '现金'); ?>
        </div>
        
    </div>
    <div class="form-group">
       
    
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_engineer'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_engineer"  class="form-control selectpage" data-source="auth/admin/index" data-field="nickname" data-primary-key="nickname" name="row[order_engineer]" type="text">
        </div>
       
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_service_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_service_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[order_service_datetime]" type="text">
        </div>  
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_user_contact'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_user_contact"  class="form-control" readonly="readonly" name="row[order_user_contact]" type="text" value="<?php echo htmlentities($user_info['user_contact']); ?>">
        </div>     
    </div>
    
   
    <div class="form-group">
        
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-7">
            <textarea id="c-order_remark" class="form-control " rows="1" name="row[order_remark]" cols="50"></textarea>
        </div>
           
            
            <button type="button" class="btn btn-info btn-embossed btn-printing "><?php echo __('打印'); ?></button>
            <button type="button" class="btn btn-success btn-embossed btn-verify"><?php echo __('保存'); ?></button>
           
            
       
    </div>
    
   
    
   
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        
    </div>
</form>
			<div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        <button type="button" class="btn btn-info btn-embossed btn-newadd <?php echo $auth->check('sale/order/add')?'':'hide'; ?>"><i class="fa fa-plus"></i><?php echo __('Add'); ?></button>
                        <button type="button" class="btn btn-success btn-embossed btn-newedit <?php echo $auth->check('sale/order/add')?'':'hide'; ?>"><i class="fa fa-pencil"></i><?php echo __('Edit'); ?></button>
                        
                        <a href="javascript:;" class="btn btn-danger btn-del btn-disabled disabled <?php echo $auth->check('sale/order/del')?'':'hide'; ?>" title="<?php echo __('Delete'); ?>" ><i class="fa fa-trash"></i> <?php echo __('Delete'); ?></a>     
                   		
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                           data-operate-edit="<?php echo $auth->check('sale/order/edit'); ?>" 
                           data-operate-del="<?php echo $auth->check('sale/order/del'); ?>" 
                           width="50%">
                    </table>
                </div>
            </div>
        </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>

<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:108:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/public/../application/admin/view/sale/order/edit.html";i:1627636943;s:97:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:94:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:96:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_code'); ?>:</label>
        <div class="col-xs-12 col-sm-2" >
            <input id="c-order_code" data-rule="required" readonly="readonly" class="form-control" name="row[order_code]" type="text" value="<?php echo htmlentities($row['order_code']); ?>">
        </div>
        <div class="col-xs-12 col-sm-2" >
            <input id="c-order_id" data-rule="required" readonly="readonly" class="form-control" name="row[order_id]" type="text" value="<?php echo htmlentities($row['order_id']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_datetime" data-rule="required"readonly="readonly" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[order_datetime]" type="text" value="<?php echo $row['order_datetime']?datetime($row['order_datetime']):''; ?>">
        </div>
        
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_sale_type'); ?>:</label>
        <div class="col-xs-12 col-sm-2" >
            <input id="c-order_sale_type" data-rule="required" readonly="readonly" class="form-control" name="row[order_sale_type]" type="text" value="<?php echo htmlentities($row['order_sale_type']); ?>">
        </div>
   
        
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_user_name" data-rule="required" class="form-control" name="row[order_user_name]" type="text" value="<?php echo htmlentities($row['order_user_name']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_user_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_user_tel" class="form-control" name="row[order_user_tel]" type="text" value="<?php echo htmlentities($row['order_user_tel']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_user_address'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_user_address" class="form-control" name="row[order_user_address]" type="text" value="<?php echo htmlentities($row['order_user_address']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_number_total'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_number_total" class="form-control" name="row[order_number_total]" type="number" value="<?php echo htmlentities($row['order_number_total']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_amount_total'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_amount_total" class="form-control" name="row[order_amount_total]" type="number" value="<?php echo htmlentities($row['order_amount_total']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_paymentmode'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_paymentmode" class="form-control" name="row[order_paymentmode]" type="text" value="<?php echo htmlentities($row['order_paymentmode']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_dispatcher'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_dispatcher" class="form-control" name="row[order_dispatcher]" type="text" value="<?php echo htmlentities($row['order_dispatcher']); ?>">
        </div>
        
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_saleman'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_saleman" class="form-control" name="row[order_saleman]" type="text" value="<?php echo htmlentities($row['order_saleman']); ?>">
        </div>
        
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_engineer'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_engineer" class="form-control" name="row[order_engineer]" type="text" value="<?php echo htmlentities($row['order_engineer']); ?>">
        </div>
    </div>
    <div class="form-group">
        
        
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_operator'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-order_operator" class="form-control" name="row[order_operator]" type="text" value="<?php echo htmlentities($row['order_operator']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Order_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <textarea id="c-order_remark" class="form-control " rows="1" name="row[order_remark]" cols="50"><?php echo htmlentities($row['order_remark']); ?></textarea>
        </div>
        <button type="button" class="btn btn-info btn-printing  btn-embossed"><?php echo __('打印'); ?></button>
    </div>
    <div class="form-group">
        
    </div>
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>
<div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        
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

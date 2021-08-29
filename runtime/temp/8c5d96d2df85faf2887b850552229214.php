<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:95:"/home/www/admin/localhost_9006/wwwroot/public/../application/admin/view/service/repair/add.html";i:1630148401;s:81:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:78:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:80:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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

    
    
    <div class="form-group" hidden="hidden">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_user_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_user_id" data-rule="required"  class="form-control " name="row[repair_user_id]" type="text" value="">
        		<input id="c-repair_id"  class="form-control"  type="text">
        </div>
        
    </div>
    <div class="form-group" >
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-7">
            <input id="c-repair_user_name" readonly="readonly" class="form-control" name="row[repair_user_name]" type="text">
        </div>
        <button type="button" class="btn btn-success btn-adduser"><?php echo __('查找'); ?></button>
    </div>
    <div class="form-group" >
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_user_contact'); ?>:</label>
        <div class="col-xs-12 col-sm-7">
            <input id="c-repair_user_contact"  class="form-control" name="row[repair_user_contact]" type="text">
        </div>
        
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_tel" class="form-control" name="row[repair_tel]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_address'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_address" class="form-control" name="row[repair_address]" type="text">
        </div>
    </div>
    <div class="form-group" hidden="hidden">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_product_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_product_id" data-rule="required" data-source="repair/product/index" class="form-control selectpage" name="row[repair_product_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_product_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_product_code" readonly="readonly" class="form-control" name="row[repair_product_code]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-repair_remark" class="form-control " rows="5" name="row[repair_remark]" cols="50"></textarea>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_service_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_service_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[repair_service_datetime]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_engineer'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_engineer" class="form-control selectpage" data-source="auth/admin/index" data-field="nickname" data-primary-key="nickname"  name="row[repair_engineer]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_isfree'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
           <?php echo build_radios('row[repair_isfree]', [0=>__('Repair_isfree 0'),1=>__('Repair_isfree 1')],0); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_amount'); ?>:</label>
        <div class="col-xs-12 col-sm-6">
            <input id="c-repair_amount" class="form-control" name="row[repair_amount]" type="number" value="0.00">
        </div>
        <div class="col-xs-12 col-sm-2">
            
        </div>
        
    </div>
    
   
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
        		<button type="reset" class="btn btn-default btn-embossed"><?php echo __('新建'); ?></button>
            
            <button type="button" class="btn btn-info btn-print"><i class="fa fa-print"></i><?php echo __('打印'); ?></button>
            
            <button type="button" class="btn btn-success btn-embossed btn-verify"><?php echo __('保存'); ?></button>
            <button type="button" class="btn btn-info btn-addsale"><?php echo __('销售出库'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>

<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:95:"/home/www/admin/localhost_9006/wwwroot/public/../application/admin/view/stock/outstock/add.html";i:1629962871;s:81:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:78:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:80:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
<center><h3><?php echo __('出库'); ?></h3></center>
	 <div class="form-group">
       
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Iostock_product_classify'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-iostock_product_classify" class="form-control selectpage" data-source="base/classify/index" data-field="classify_name" data-primary-key="classify_name" name="row[iostock_product_classify]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Iostock_product_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-iostock_product_name" class="form-control selectpage" data-source="base/production/getproductname" data-field="production_name" data-primary-key="production_name" name="row[iostock_product_name]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Iostock_product_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-iostock_product_id" class="form-control selectpage" data-source="base/production/getproducttype" data-field="production_type" data-primary-key="production_id"name="row[iostock_product_id]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Iostock_unit'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-iostock_unit" data-rule="required" class="form-control" name="row[iostock_unit]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Iostock_outnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-iostock_outnumber" class="form-control" name="row[iostock_outnumber]" type="number">
        </div>
    </div>
    <div class="form-group">
    	<label  class="control-label col-xs-12 col-sm-2"><?php echo __('Iostock_remark'); ?>:</label>
    	<div class="col-xs-12 col-sm-8">
  			  	<textarea id="c-iostock_remark" class="form-control editor" rows="5" name="row[iostock_remark]" cols="50"></textarea>
		</div>
	</div>
    
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
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

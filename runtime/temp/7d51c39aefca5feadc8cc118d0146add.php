<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:111:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/public/../application/admin/view/sale/callback/edit.html";i:1627838167;s:97:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:94:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:96:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_code" readonly="readonly" class="form-control" name="row[log_code]" type="text" value="<?php echo htmlentities($row['log_code']); ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_type" readonly="readonly" class="form-control" name="row[log_type]" type="text" value="<?php echo htmlentities($row['log_type']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_date'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_date" readonly="readonly" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[log_date]" type="text" value="<?php echo $row['log_date']?datetime($row['log_date']):''; ?>">
        </div>
    </div>
    
   
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_user_name" readonly="readonly" class="form-control" name="row[log_user_name]" type="text" value="<?php echo htmlentities($row['log_user_name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_address'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_address" readonly="readonly" class="form-control" name="row[log_address]" type="text" value="<?php echo htmlentities($row['log_address']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_tel" class="form-control" readonly="readonly" name="row[log_tel]" type="text" value="<?php echo htmlentities($row['log_tel']); ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_operator'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_operator" readonly="readonly" class="form-control" name="row[log_operator]" type="text" value="<?php echo htmlentities($row['log_operator']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_radios('row[log_status]', [2=>__('Log_status 2'), 3=>__('Log_status 3'), 4=>__('Log_status 4'), 5=>__('Log_status 5')], $row['log_status']); ?>
            

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_callback'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
        		<textarea id="c-log_callback" class="form-control " rows="5" name="row[log_callback]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_valuation'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-log_valuation" class="form-control" name="row[log_valuation]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_valuation_star'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
        		<?php echo build_radios('row[log_valuation_star]', [5=>__('非常满意'), 4=>__('满意'), 3=>__('一般'), 2=>__('不满意'), 1=>__('很不满意')], ); ?>
        </div>
    </div>
<div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('整单回访'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>   
    
    
    
</form>
		<div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        <a href="javascript:;" class="btn btn-success btn-edit btn-disabled disabled <?php echo $auth->check('sale/callback/edit')?'':'hide'; ?>" title="<?php echo __('查看施工情况'); ?>" ><i class="fa fa-pencil"></i> <?php echo __('查看施工情况'); ?></a>
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                           data-operate-edit="<?php echo $auth->check('sale/callback/edit'); ?>" 
                           
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

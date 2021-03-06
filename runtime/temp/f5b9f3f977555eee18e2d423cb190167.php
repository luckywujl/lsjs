<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:93:"/home/www/admin/localhost_9006/wwwroot/public/../application/admin/view/product/log/edit.html";i:1628528960;s:81:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:78:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:80:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_code" class="form-control" name="row[log_code]" type="text" value="<?php echo htmlentities($row['log_code']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_type'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_type" class="form-control" name="row[log_type]" type="text" value="<?php echo htmlentities($row['log_type']); ?>">
        </div>

        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_date'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_date" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[log_date]" type="text" value="<?php echo $row['log_date']?datetime($row['log_date']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_user_name" class="form-control" name="row[log_user_name]" type="text" value="<?php echo htmlentities($row['log_user_name']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_address'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_address" class="form-control" name="row[log_address]" type="text" value="<?php echo htmlentities($row['log_address']); ?>">
        </div>
  
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_tel" class="form-control" name="row[log_tel]" type="text" value="<?php echo htmlentities($row['log_tel']); ?>">
        </div>
    </div>
 
    
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_operator'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_operator" class="form-control" name="row[log_operator]" type="text" value="<?php echo htmlentities($row['log_operator']); ?>">
        </div>
        
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_saleman'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_saleman" class="form-control" name="row[log_saleman]" type="text" value="<?php echo htmlentities($row['log_saleman']); ?>">
        </div>
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_callbacker'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_callbacker" class="form-control" name="row[log_callbacker]" type="text" value="<?php echo htmlentities($row['log_callbacker']); ?>">
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_valuation'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_valuation" class="form-control" name="row[log_valuation]" type="text" value="<?php echo htmlentities($row['log_valuation']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_valuation_star'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_valuation_star" class="form-control" name="row[log_valuation_star]" type="text" value="<?php echo htmlentities($row['log_valuation_star']); ?>">
        </div>
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_water_gage'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_water_gage" class="form-control" name="row[log_water_gage]" type="text" value="<?php echo htmlentities($row['log_water_gage']); ?>">
        </div>
    </div>
    <div class="form-group">
    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-3">
            <input id="c-log_remark" class="form-control" name="row[log_remark]" type="text" value="<?php echo htmlentities($row['log_remark']); ?>">
        </div>
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Log_status'); ?>:</label>
        <div class="col-xs-12 col-sm-6">
            
            <div class="radio">
            <?php if(is_array($logStatusList) || $logStatusList instanceof \think\Collection || $logStatusList instanceof \think\Paginator): if( count($logStatusList)==0 ) : echo "" ;else: foreach($logStatusList as $key=>$vo): ?>
            <label for="row[log_status]-<?php echo $key; ?>"><input id="row[log_status]-<?php echo $key; ?>" name="row[log_status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['log_status'])?$row['log_status']:explode(',',$row['log_status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_callback'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-log_callback" class="form-control " rows="2" name="row[log_callback]" cols="50"><?php echo htmlentities($row['log_callback']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_log'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
        		<textarea id="c-log_log" class="form-control " rows="4" name="row[log_log]" cols="50"><?php echo htmlentities($row['log_log']); ?></textarea>  
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_pic'); ?>:</label>
        <div class="col-xs-12 col-sm-8"  >
            <div class="input-group">
                <input id="c-log_pic" readonly="readonly" class="form-control" size="50" name="row[log_pic]" type="text" value="<?php echo (isset($row['log_pic']) && ($row['log_pic'] !== '')?$row['log_pic']:''); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button"  id="faupload-question_files" class="btn btn-danger plupload" data-input-id="c-log_pic" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" capture="camera" data-multiple="true" data-preview-id="p-log_pic"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
  
                </div>
                <span class="msg-box n-right" for="c-log_pic"></span>
            </div>
            <ul class="row list-inline faupload-preview" id="p-log_pic"></ul>
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

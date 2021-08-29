<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:96:"/home/www/admin/localhost_9006/wwwroot/public/../application/admin/view/service/repair/edit.html";i:1630148535;s:81:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:78:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:80:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_code'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-repair_code" readonly="readonly" class="form-control" name="row[repair_code]" type="text" value="<?php echo htmlentities($row['repair_code']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Repair_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-repair_datetime" readonly="readonly" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[repair_datetime]" type="text" value="<?php echo $row['repair_datetime']?datetime($row['repair_datetime']):''; ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Repair_service_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-repair_service_datetime"  class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[repair_service_datetime]" type="text" value="<?php echo $row['repair_service_datetime']?datetime($row['repair_service_datetime']):''; ?>">
        </div>
    </div>
    <div class="form-group" hidden="hidden">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_user_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
        		<input id="c-repair_id" data-rule="required" class="form-control " type="text" value="<?php echo htmlentities($row['repair_id']); ?>">
            <input id="c-repair_user_id" data-rule="required"  class="form-control " name="row[repair_user_id]" type="text" value="<?php echo htmlentities($row['repair_user_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-repair_user_name" readonly="readonly" class="form-control" name="row[repair_user_name]" type="text" value="<?php echo htmlentities($row['repair_user_name']); ?>">
        </div>
  
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Repair_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-repair_tel" class="form-control"  name="row[repair_tel]" type="text" value="<?php echo htmlentities($row['repair_tel']); ?>">
        </div>

        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Repair_address'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-repair_address" class="form-control"  name="row[repair_address]" type="text" value="<?php echo htmlentities($row['repair_address']); ?>">
        </div>
    </div>
    <div class="form-group" hidden="hidden">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_product_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_product_id"  data-rule="required"  class="form-control" name="row[repair_product_id]" type="text" value="<?php echo htmlentities($row['repair_product_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_product_code'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-repair_product_code" readonly="readonly" class="form-control" name="row[repair_product_code]" type="text" value="<?php echo htmlentities($row['repair_product_code']); ?>">
        </div>
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Repair_user_contact'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-repair_user_contact"  class="form-control" name="row[repair_user_contact]" type="text" value="<?php echo htmlentities($row['repair_user_contact']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-repair_remark" class="form-control " rows="5" name="row[repair_remark]" cols="50"><?php echo htmlentities($row['repair_remark']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_dispatcher'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_dispatcher" readonly="readonly" class="form-control" name="row[repair_dispatcher]" type="text" value="<?php echo htmlentities($row['repair_dispatcher']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_engineer'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_engineer" readonly="readonly" class="form-control" name="row[repair_engineer]" type="text" value="<?php echo htmlentities($row['repair_engineer']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_isfree'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($repairIsfreeList) || $repairIsfreeList instanceof \think\Collection || $repairIsfreeList instanceof \think\Paginator): if( count($repairIsfreeList)==0 ) : echo "" ;else: foreach($repairIsfreeList as $key=>$vo): ?>
            <label for="row[repair_isfree]-<?php echo $key; ?>"><input id="row[repair_isfree]-<?php echo $key; ?>" name="row[repair_isfree]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['repair_isfree'])?$row['repair_isfree']:explode(',',$row['repair_isfree']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_amount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_amount" class="form-control" name="row[repair_amount]" type="number" value="<?php echo htmlentities($row['repair_amount']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_operator'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-repair_operator" readonly="readonly" class="form-control" name="row[repair_operator]" type="text" value="<?php echo htmlentities($row['repair_operator']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Repair_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-repair_status"  class="form-control selectpicker" name="row[repair_status]">
                <?php if(is_array($repairStatusList) || $repairStatusList instanceof \think\Collection || $repairStatusList instanceof \think\Paginator): if( count($repairStatusList)==0 ) : echo "" ;else: foreach($repairStatusList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['repair_status'])?$row['repair_status']:explode(',',$row['repair_status']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
            <button type="button" class="btn btn-info btn-print"><i class="fa fa-print"></i><?php echo __('打印'); ?></button>
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
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

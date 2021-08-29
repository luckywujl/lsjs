<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:101:"/home/www/admin/localhost_9006/wwwroot/public/../application/admin/view/service/consumables/edit.html";i:1630151014;s:81:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:78:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:80:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
    	  <div class="col-xs-12 col-sm-2" hidden="hidden">
            <input id="c-product_id" class="form-control" name="row[product_id]" type="text" value="<?php echo htmlentities($row['product_id']); ?>">
        		<input id="c-product_user_id" class="form-control" name="row[product_user_id]" type="text" value="<?php echo htmlentities($row['product_user_id']); ?>">
        		
        </div>
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_code'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_code" class="form-control" name="row[product_code]" type="text" value="<?php echo htmlentities($row['product_code']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_name" class="form-control" name="row[product_name]" type="text" value="<?php echo htmlentities($row['product_name']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_type'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_type" class="form-control" name="row[product_type]" type="text" value="<?php echo htmlentities($row['product_type']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_sale_date'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_sale_date" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" name="row[product_sale_date]" type="text" value="<?php echo $row['product_sale_date']?datetime($row['product_sale_date']):''; ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_install_date'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_install_date" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" name="row[product_install_date]" type="text" value="<?php echo $row['product_install_date']?datetime($row['product_install_date']):''; ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_log_date'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_log_date" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" name="row[product_log_date]" type="text" value="<?php echo $row['product_log_date']?datetime($row['product_log_date']):''; ?>">
        </div>
    </div>
   
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_replacement_date'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_replacement_date" class="form-control datetimepicker" style="color: red;" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[product_replacement_date]" type="text" value="<?php echo $row['product_replacement_date']?datetime($row['product_replacement_date']):''; ?>">
        </div>
  
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_water_gage'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_water_gage" class="form-control" name="row[product_water_gage]" type="text" value="<?php echo htmlentities($row['product_water_gage']); ?>">
        </div>

        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_consumable_material'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_consumable_material" class="form-control" style="color: red;" name="row[product_consumable_material]" type="text" value="<?php echo htmlentities($row['product_consumable_material']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-product_remark" class="form-control " rows="3" name="row[product_remark]" cols="50"><?php echo htmlentities($row['product_remark']); ?></textarea>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_user_name" class="form-control" name="row[product_user_name]" type="text" value="<?php echo htmlentities($row['product_user_name']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_tel" class="form-control" name="row[product_tel]" type="text" value="<?php echo htmlentities($row['product_tel']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_address'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_address" class="form-control" name="row[product_address]" type="text" value="<?php echo htmlentities($row['product_address']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_sale_type'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_sale_type" class="form-control" name="row[product_sale_type]" type="text" value="<?php echo htmlentities($row['product_sale_type']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_order_code'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_order_code" class="form-control" name="row[product_order_code]" type="text" value="<?php echo htmlentities($row['product_order_code']); ?>">
        </div>
        
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_saleman'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_saleman" class="form-control" name="row[product_saleman]" type="text" value="<?php echo htmlentities($row['product_saleman']); ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_install_place'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_install_place" class="form-control" name="row[product_install_place]" type="text" value="<?php echo htmlentities($row['product_install_place']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_install_type'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_install_type" class="form-control" name="row[product_install_type]" type="text" value="<?php echo htmlentities($row['product_install_type']); ?>">
        </div>

        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_purpose'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_purpose" class="form-control" name="row[product_purpose]" type="text" value="<?php echo htmlentities($row['product_purpose']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('沟通状态'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            
            <div class="radio">
            <?php if(is_array($productStatusList) || $productStatusList instanceof \think\Collection || $productStatusList instanceof \think\Paginator): if( count($productStatusList)==0 ) : echo "" ;else: foreach($productStatusList as $key=>$vo): ?>
            <label for="row[product_status]-<?php echo $key; ?>"><input id="row[product_status]-<?php echo $key; ?>" name="row[product_status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['product_status'])?$row['product_status']:explode(',',$row['product_status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_user_contact'); ?>:</label>
        <div class="col-xs-12 col-sm-1">
            <input id="c-product_user_contact" class="form-control" name="row[product_user_contact]" type="text" value="<?php echo htmlentities($row['product_user_contact']); ?>">
        </div>
        <button type="button" class="btn btn-info btn-addsale"><?php echo __('销售开单'); ?></button>
    </div>
    <div class="form-group">
        
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_pic'); ?>:</label>
        <div class="col-xs-12 col-sm-8"  >
            <div class="input-group">
                <input id="c-product_pic" readonly="readonly" class="form-control" size="50" name="row[product_pic]" type="text" value="<?php echo (isset($row['product_pic']) && ($row['product_pic'] !== '')?$row['product_pic']:''); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button"  id="faupload-question_files" class="btn btn-danger plupload" data-input-id="c-product_pic" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" capture="camera" data-multiple="true" data-preview-id="p-product_pic"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
  
                </div>
                <span class="msg-box n-right" for="c-product_pic"></span>
            </div>
            <ul class="row list-inline faupload-preview" id="p-product_pic"></ul>
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

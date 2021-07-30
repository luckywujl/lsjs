<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:113:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/public/../application/admin/view/sale/detailtemp/edit.html";i:1627575054;s:97:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:94:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:96:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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

    
    <div class="form-group" hidden="hidden">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_main_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_main_code" class="form-control" name="row[detail_main_code]" type="text" value="<?php echo htmlentities($row['detail_main_code']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_date'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_date" class="form-control" name="row[detail_date]" type="number" value="<?php echo htmlentities($row['detail_date']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_product_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_product_type" class="form-control" name="row[detail_product_type]" type="text" value="<?php echo htmlentities($row['detail_product_type']); ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_product_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_product_name" data-rule="required" class="form-control selectpage" data-source="base/production/getproductname" data-field="production_name" data-primary-key="production_name" name="row[detail_product_name]" type="text" value="<?php echo htmlentities($row['detail_product_name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_product_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_product_id" data-rule="required" class="form-control selectpage" data-source="base/production/getproducttype?production_name=<?php echo htmlentities($row['detail_product_name']); ?>" data-field="production_type" data-primary-key="production_id" name="row[detail_product_id]" type="text" value="<?php echo htmlentities($row['detail_product_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_unit'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_unit" class="form-control" name="row[detail_unit]" type="text" value="<?php echo htmlentities($row['detail_unit']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_number'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_number" class="form-control" name="row[detail_number]" type="number" value="<?php echo htmlentities($row['detail_number']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_price" class="form-control" name="row[detail_price]" type="number" value="<?php echo htmlentities($row['detail_price']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_amount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail_amount" class="form-control" name="row[detail_amount]" type="number" value="<?php echo htmlentities($row['detail_amount']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-detail_remark" class="form-control " rows="5" name="row[detail_remark]" cols="50"><?php echo htmlentities($row['detail_remark']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_isrecord'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($detailIsrecordList) || $detailIsrecordList instanceof \think\Collection || $detailIsrecordList instanceof \think\Paginator): if( count($detailIsrecordList)==0 ) : echo "" ;else: foreach($detailIsrecordList as $key=>$vo): ?>
            <label for="row[detail_isrecord]-<?php echo $key; ?>"><input id="row[detail_isrecord]-<?php echo $key; ?>" name="row[detail_isrecord]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['detail_isrecord'])?$row['detail_isrecord']:explode(',',$row['detail_isrecord']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

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

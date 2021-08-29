<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:97:"/home/www/admin/localhost_9006/wwwroot/public/../application/admin/view/base/production/edit.html";i:1629959342;s:81:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:78:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:80:"/home/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_classify'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_classify" data-rule="required" class="form-control selectpage"  data-source="base/classify/index" data-field="classify_name" data-primary-key="classify_name" name="row[production_classify]" type="text" value="<?php echo htmlentities($row['production_classify']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_name" data-rule="required" class="form-control" name="row[production_name]" type="text" value="<?php echo htmlentities($row['production_name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_type"  class="form-control" name="row[production_type]" type="text" value="<?php echo htmlentities($row['production_type']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_unit'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_unit" data-rule="required" class="form-control" name="row[production_unit]" type="text" value="<?php echo htmlentities($row['production_unit']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_price" data-rule="required" class="form-control" name="row[production_price]" type="text" value="<?php echo htmlentities($row['production_price']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_consumable_material'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_consumable_material"  class="form-control" name="row[production_consumable_material]" type="text" value="<?php echo htmlentities($row['production_consumable_material']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_replacement_cycle'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_replacement_cycle" data-rule="required" class="form-control" name="row[production_replacement_cycle]" type="number" value="<?php echo htmlentities($row['production_replacement_cycle']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_stock_number'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-production_stock_number" data-rule="required" class="form-control" name="row[production_stock_number]" type="text" value="<?php echo htmlentities($row['production_stock_number']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Production_isrecord'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_radios('row[production_isrecord]', [0=>__('Production_isrecord 0'), 1=>__('Production_isrecord 1')], $row['production_isrecord']); ?>
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

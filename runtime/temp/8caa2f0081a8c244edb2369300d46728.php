<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:110:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/public/../application/admin/view/sale/outstock/add.html";i:1627491217;s:97:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/layout/default.html";i:1626771292;s:94:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/meta.html";i:1626771292;s:96:"/media/luckywujl/data/www/admin/localhost_9006/wwwroot/application/admin/view/common/script.html";i:1626771292;}*/ ?>
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
	 <center><h3><?php echo __('销售出库'); ?></h3></center>

	 <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_user_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_user_id" data-rule="required" class="form-control selectpage" data-source="user/user/index" data-field="name" data-primary-key="id" name="row[product_user_id]" type="text">
            
        </div>
        <button type="button" class="btn btn-success btn-adduser"><?php echo __('Adduser'); ?></button>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_tel" data-rule="required" class="form-control "  name="row[product_tel]" type="text">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_address'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_address" data-rule="required" class="form-control "  name="row[product_address]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Log_operator'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-log_operator"  class="form-control selectpage" data-source="auth/admin/index" data-field="nickname" data-primary-key="nickname" name="row[log_operator]" type="text">
        </div>
        <label class="control-label col-xs-12 col-sm-2"><font color="red"><?php echo __('为空则暂不派单'); ?></font></label>
    </div>
    <table width="80%" cellspacing="2" id="table1" style="font-size:14px; border:1px solid #cad9ea;margin:0 auto;margin-top:20px">
		<tr bgcolor="#90EE90" height=30>
			<td>序号</td>
			<td>产品名称</td>
			<td>规格型号</td>
			<td>单位</td>
			<td >数量</td>
			<td>单价</td>
			<td>金额</td>
			<td>备注</td>
		</tr>
		<tr  height=40>
			<td>1</td>
			<td><div class="col-xs-12 col-sm-1"><input id="c-instock_product_name" data-rule="required" class="form-control selectpage" data-source="base/production/getproductname" data-field="production_name" data-primary-key="production_name" name="row[instock_product_name]" type="text"></div></td>
			<td><div class="col-xs-12 col-sm-1"><input id="c-instock_product_id" class="form-control selectpage" data-source="base/production/getproducttype" data-field="production_type" data-primary-key="production_id"name="row[instock_product_id]" type="text">
        </div></td>
			<td><div contenteditable='true'>台</div></td>
			<td><div contenteditable='true'>1</div></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Instock_product_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8"><input id="c-instock_product_name" data-rule="required" class="form-control selectpage" data-source="base/production/getproductname" data-field="production_name" data-primary-key="production_name" name="row[instock_product_name]" type="text"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Instock_product_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-instock_product_id" class="form-control selectpage" data-source="base/production/getproducttype" data-field="production_type" data-primary-key="production_id"name="row[instock_product_id]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Instock_outnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-instock_outnumber" class="form-control" name="row[instock_outnumber]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_sale_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_sale_type" data-rule="required" class="form-control selectpage" data-source="base/saletype/index" data-field="sale_type" data-primary-key="sale_type" name="row[product_sale_type]" type="text">
        </div>
    </div>
    
    <div class="form-group">
    	<label  class="control-label col-xs-12 col-sm-2"><?php echo __('Instock_remark'); ?>:</label>
    	<div class="col-xs-12 col-sm-8">
  			  	<textarea id="c-instock_remark" class="form-control editor" rows="4" name="row[instock_remark]" cols="50"></textarea>
		</div>
	</div>
	
   <div class="form-group">
        <label class="control-label col-xs-12 col-sm-10" ><font color="red"><?php echo __('注：仅限整机产品销售出库时使用，完成销售出库，系统将自动完成建档操作！如无需建档，请至“仓储管理->出库操作”中完成出库！'); ?></font></label>
        
    </div> 
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
    <script language="javascript" src="GridEdit.js"></script>
<script language="javascript">
var tabProduct = document.getElementById("table1");

// 设置表格可编辑
// 可一次设置多个，例如：EditTables(tb1,tb2,tb2,......)
EditTables(tabProduct);


</script>

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

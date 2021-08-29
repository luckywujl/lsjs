define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
              
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/detailtemp/index' + location.search,
                    add_url: 'sale/detailtemp/add',
                    edit_url: 'sale/detailtemp/edit',
                    del_url: 'sale/detailtemp/del',
                    multi_url: 'sale/detailtemp/multi',
                    import_url: 'sale/detailtemp/import',
                    table: 'order_detail_temp',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'detail_id',
                sortName: 'detail_id',
                sortOrder: 'asc',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'detail_id', title: __('Detail_id')},
                        {field: 'detail_main_id', title: __('Detail_main_id')},
                        {field: 'detail_main_code', title: __('Detail_main_code'), operate: 'LIKE'},
                        {field: 'detail_date', title: __('Detail_date')},
                        {field: 'detail_sn', title: __('Detail_sn')},
                        {field: 'detail_product_id', title: __('Detail_product_id')},
                        {field: 'detail_product_name', title: __('Detail_product_name'), operate: 'LIKE'},
                        {field: 'detail_product_type', title: __('Detail_product_type'), operate: 'LIKE'},
                        {field: 'detail_number', title: __('Detail_number')},
                        {field: 'detail_price', title: __('Detail_price'), operate:'BETWEEN'},
                        {field: 'detail_amount', title: __('Detail_amount'), operate:'BETWEEN'},
                        {field: 'detail_remark', title: __('Detail_remark')},
                        {field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
        	//手动点选是否建档立卡
        	 $('input:radio[name="row[detail_isrecord]"]').change(function(){
   			 var checkValue = $('input:radio[name="row[detail_isrecord]"]:checked').val();
   			 if (checkValue=="1") {
   			  		document.getElementById("install").style.visibility="hidden";
   			  } else {
   			  		document.getElementById("install").style.visibility="visible";
   			  }
    			  
		     });
        	 //手动选择是否安装
        	  $('input:radio[name="row[detail_isinstall]"]').click(function(){
   			  var checkValue = $('input:radio[name="row[detail_isinstall]"]:checked').val();
   			  if (checkValue=="1") {
   			  	//弹窗显示支付方式
         	  Fast.api.open('product/info/finduser','查找客户',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '90%'],
		           callback: function (data) {	
		           //alert(data);
		           if (data.length >0) {
		            $("#c-product_id").val(data[0].product_id);
		           } else{
		             document.getElementById("row[detail_isinstall]-0").checked=true;
		             $("#c-product_id").val('');
		           }
		           //$("#c-order_user_id").val(data);
		           //$("#c-order_user_id").selectPageRefresh();
		           //var id = $("#c-order_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		
	       	    },function (data) {
	       	    	
	       	    }
	            });
   			  }
    			  
		     });
		     
		     
		     
        		//实现产品名称和产品型号联动
        	  $("#c-detail_product_name").on('change',function(){
         		var product = $("#c-detail_product_name").val();
          	   $("#c-detail_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-detail_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
       	 	});
       	 	
       	 $("#c-detail_product_id").on('change',function(){
       	 	  
         		var product_id = $("#c-detail_product_id").val();
        
         		if (product_id!=='') {
       	 			//用产品信息填充单价和金额及建档立卡
       	 			Fast.api.ajax({
        					url:'base/production/getproductinfo',        													     
             			data:{production_id:$("#c-detail_product_id").val()} //再将收到的create_code用POST方式发给主表控制器的total
         	   	}, 
         	 			function (data,ret) { //success 用于接收主表控制器发过来的数据
         	 				$("#c-detail_price").val(data.production_price);
         	 				$("#c-detail_unit").val(data.production_unit);
         	 				$("#c-detail_product_type").val(data.production_type);
         	 				$("#c-detail_number").val('1');
         	 				count();
         	   			if (data.production_isrecord) {
         	   				document.getElementById("row[detail_isrecord]-1").checked=true;
         	   				document.getElementById("install").style.visibility="hidden";
         	   				
         	   			}else {
         	   				document.getElementById("row[detail_isrecord]-0").checked=true;
         	   				document.getElementById("install").style.visibility="visible";
         	   			}
         					console.info(data);     													      
               			return false;    															
           				},function(data){
               		//失败的回调 
           				//return false;	
              			}											  		 		  
 			   		);
       	 	   	}
              });
              
            $("#c-detail_number").bind("keyup",function (event) {
				    count();
			   });
			   $("#c-detail_price").bind("keyup",function (event) {
				    count();
			   });
            
            function count() {
            	$("#c-detail_amount").val(($("#c-detail_number").val()*$("#c-detail_price").val()).toFixed(2));
            }
       	  //关闭时执行
            parent.window.$(".layui-layer-iframe").find(".layui-layer-close").on('click',function () {
                    var ids = $("#product_id").val();   //获取选中的id，获取到的是个数组
                    Fast.api.close(ids); //往父窗口回调参数 
                  
             });
            Controller.api.bindevent();
            
        },
        edit: function () {
            //手动点选是否建档立卡
        	 $('input:radio[name="row[detail_isrecord]"]').change(function(){
   			 var checkValue = $('input:radio[name="row[detail_isrecord]"]:checked').val();
   			 if (checkValue=="1") {
   			  		document.getElementById("install").style.visibility="hidden";
   			  		document.getElementById("user_info").style.visibility="hidden";
   			  		document.getElementById("row[detail_isinstall]-0").checked=true;
   			  		
   			  } else {
   			  		document.getElementById("install").style.visibility="visible";
   			  		//document.getElementById("user_info").style.visibility="visible";
   			  }
    			  
		     });
        	 //手动选择是否安装
        	  $('input:radio[name="row[detail_isinstall]"]').click(function(){
   			  var checkValue = $('input:radio[name="row[detail_isinstall]"]:checked').val();
   			  if (checkValue=="1") {
   			  	//alert(Config.user_id);
   			  	//弹窗显示支付方式
   			  	
         	  Fast.api.open('product/info/finduser?product_user_id='+Config.user_id,'查找客户',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '90%'],
		           callback: function (data) {	
		           //alert(data);
		           if (data.length >0) {
		           	document.getElementById("user_info").style.visibility="visible";
		            $("#c-detail_user_id").val(data[0].product_user_id);
		            $("#c-detail_user_name").val(data[0].product_user_name);
		            $("#c-detail_user_tel").val(data[0].product_tel);
		            $("#c-detail_user_address").val(data[0].product_address);
		            $("#c-detail_product_info_id").val(data[0].product_id);
		           } else{
		             document.getElementById("row[detail_isinstall]-0").checked=true;
		             document.getElementById("user_info").style.visibility="hidden";
		             $("#c-product_id").val('');
		           }
		           //$("#c-order_user_id").val(data);
		           //$("#c-order_user_id").selectPageRefresh();
		           //var id = $("#c-order_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		
	       	    },function (data) {
	       	    	
	       	    }
	            });
   			  } else {
   			  	    document.getElementById("row[detail_isinstall]-0").checked=true;
		             document.getElementById("user_info").style.visibility="hidden";
		             $("#c-product_id").val('');
   			  
   			  }
    			  
		     });
		     
		     //实现产品名称和产品型号联动
        	  $("#c-detail_product_classify").on('change',function(){
         		var classify = $("#c-detail_product_classify").val();
          	   $("#c-detail_product_name").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-detail_product_name_text").data("selectPageObject").option.data = 'base/production/getproductname?production_classify='+classify;   
       	 	});
		     
        		//实现产品名称和产品型号联动
        	  $("#c-detail_product_name").on('change',function(){
         		var product = $("#c-detail_product_name").val();
          	   $("#c-detail_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-detail_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
       	 	});
       	 	
       	 $("#c-detail_product_id").on('change',function(){
       	 	  
         		var product_id = $("#c-detail_product_id").val();
        
         		if (product_id!=='') {
       	 			//用产品信息填充单价和金额及建档立卡
       	 			Fast.api.ajax({
        					url:'base/production/getproductinfo',        													     
             			data:{production_id:$("#c-detail_product_id").val()} //再将收到的create_code用POST方式发给主表控制器的total
         	   	}, 
         	 			function (data,ret) { //success 用于接收主表控制器发过来的数据
         	 				$("#c-detail_price").val(data.production_price);
         	 				$("#c-detail_unit").val(data.production_unit);
         	 				$("#c-detail_product_type").val(data.production_type);
         	 				$("#c-detail_number").val('1');
         	 				count();
         	   			if (data.production_isrecord) {
         	   				document.getElementById("row[detail_isrecord]-1").checked=true;
         	   				document.getElementById("row[detail_isinstall]-0").checked=true;
         	   				document.getElementById("install").style.visibility="hidden";
         	   				document.getElementById("user_info").style.visibility="hidden";
         	   				
         	   			}else {
         	   				document.getElementById("row[detail_isrecord]-0").checked=true;
         	   				document.getElementById("install").style.visibility="visible";
         	   				//document.getElementById("user_info").style.visibility="visible";
         	   			}
         					console.info(data);     													      
               			return false;    															
           				},function(data){
               		//失败的回调 
           				//return false;	
              			}											  		 		  
 			   		);
       	 	   	}
              });
              
            $("#c-detail_number").bind("keyup",function (event) {
				    count();
			   });
			   $("#c-detail_price").bind("keyup",function (event) {
				    count();
			   });
            
            function count() {
            	$("#c-detail_amount").val(($("#c-detail_number").val()*$("#c-detail_price").val()).toFixed(2));
            }
       	  
            Controller.api.bindevent();
            
        },
        api: {
            bindevent: function () {
               Form.api.bindevent($("form[role=form]"), function(data, ret){
					//如果我们需要在提交表单成功后做跳转，可以在此使用location.href="链接";进行跳转
					//Toastr.success("成功");				
					if (data.datail_isinstall) {
					parent.$("#c-order_user_name").val(data.detail_user_name);
					parent.$("#c-order_user_tel").val(data.detail_user_tel);
					parent.$("#c-order_user_address").val(data.detail_user_address);
					}
					//刷新表格
   				parent.$("#table").bootstrapTable('refresh');
   				//return false;
					}, function(data, ret){
  						Toastr.success("失败");
					}, function(success, error){

					//bindevent的第三个参数为提交前的回调
					//如果我们需要在表单提交前做一些数据处理，则可以在此方法处理
					//注意如果我们需要阻止表单，可以在此使用return false;即可
					//如果我们处理完成需要再次提交表单则可以使用submit提交,如下
					//Form.api.submit(this, success, error);
					//return false;
					});
            }
        }
    };
    return Controller;
});
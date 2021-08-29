define(['jquery', 'bootstrap', 'backend', 'table','form','printing'], function ($, undefined, Backend, Table, Form,Printing) {

    var Controller = {
        index: function () {
        		$(".btn-add").data("area",["90%","90%"]);
         	$(".btn-edit").data("area",["90%","90%"]);
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/order/index' + location.search,
                    add_url: 'sale/order/add',
                    edit_url: 'sale/rorder/edit',
                    del_url: 'sale/rorder/del',
                    multi_url: 'sale/rorder/multi',
                    import_url: 'sale/rorder/import',
                    table: 'order_main',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'order_id',
                sortName: 'order_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'order_id', title: __('Order_id')},
                        {field: 'order_code', title: __('Order_code'), operate: 'LIKE'},
                        {field: 'order_datetime', title: __('Order_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        //{field: 'order_user_id', title: __('Order_user_id')},
                        {field: 'order_user_name', title: __('Order_user_name'), operate: 'LIKE'},
                        {field: 'order_user_tel', title: __('Order_user_tel'), operate: 'LIKE'},
                        {field: 'order_user_address', title: __('Order_user_address'), operate: 'LIKE'},
                        {field: 'order_number_total', title: __('Order_number_total'), operate:'BETWEEN'},
                        {field: 'order_amount_total', title: __('Order_amount_total'), operate:'BETWEEN'},
                        {field: 'order_payamount', title: __('Order_payamount'), operate:'BETWEEN'},
                        {field: 'order_paymentmode', title: __('Order_paymentmode'), operate: 'LIKE'},
                        {field: 'order_dispatcher', title: __('Order_dispatcher'), operate: 'LIKE'},
                        {field: 'order_status', title: __('Order_status'), searchList: {"0":__('Order_status 0'),"1":__('Order_status 1'),"2":__('Order_status 2'),"3":__('Order_status 3'),"4":__('Order_status 4')}, formatter: Table.api.formatter.status},
                        {field: 'order_remark', title: __('Order_remark')},
                        {field: 'order_operator', title: __('Order_operator'), operate: 'LIKE'},
                        {field: 'order_saleman', title: __('Order_saleman'), operate: 'LIKE'},
                        {field: 'order_engineer', title: __('Order_engineer'), operate: 'LIKE'},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            table.on('post-body.bs.table',function (e,settings,json,xhr) {
            	$(".btn-editone").data("area",["90%","90%"]);
            	$(".btn-editone").data("title",'查看');
            })
        },
        add: function () { 
              
             Controller.api.bindevent();
            	
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'service/rorder/detailindex' + location.search,
                    //add_url: 'sale/order/detailadd?user_id='+$("#c-order_user_id").val(),
                    //edit_url: 'sale/detailtemp/edit?user_id='+$("#c-order_user_id").val(),
                    del_url: 'service/detailtemp/del',
                    table: 'order_detail_temp',
                }
            });

            var table = $("#table");
            //当表格数据加载完成时
            table.on('load-success.bs.table', function (e, data) {
                //这里可以获取从服务端获取的JSON数据
                console.log(data);
                //这里我们手动设置底部的值
                $("#c-order_number_total").val(data.extend.number);
                $("#c-order_amount_total").val(data.extend.amount);
            });

           // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'detail_id',
                sortName: 'detail_sn',
                sortOrder:'asc',
                commonSearch: false,
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'detail_id', title: __('Detail_id')},
                        //{field: 'detail_main_id', title: __('Detail_main_id')},
                        //{field: 'detail_main_code', title: __('Detail_main_code'), operate: 'LIKE'},
                        //{field: 'detail_date', title: __('Detail_date')},
                        {field: 'detail_sn', title: __('Detail_sn')},
                        //{field: 'detail_product_id', title: __('Detail_product_id')},
                        {field: 'detail_product_name', title: __('Detail_product_name'), operate: 'LIKE'},
                        {field: 'detail_product_type', title: __('Detail_product_type'), operate: 'LIKE'},
                        {field: 'detail_number', title: __('Detail_number')},
                        {field: 'detail_price', title: __('Detail_price'), operate:'BETWEEN'},
                        {field: 'detail_amount', title: __('Detail_amount'), operate:'BETWEEN'},
                        {field: 'detail_remark', title: __('Detail_remark')},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });
            // 为表格绑定事件
            Table.api.bindevent(table);
            
            
       	 	//选定客户名称后，自动填写客户其它信息
       	 	$("#c-order_user_id").on('change',function(){
       	 		var id = $("#c-order_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		if (id!=='') {
       	 			//用用户信填写表中的地址，电话，联系人等信息
       	 			Fast.api.ajax({
        					url:'user/user/getuserinfo',        													     
             			data:{id:$("#c-order_user_id").val()} //再将收到的create_code用POST方式发给主表控制器的total
         	   	}, 
         	 			function (data,ret) { //success 用于接收主表控制器发过来的数据
         	 				$("#c-order_user_tel").val(data.mobile);
         	   			$("#c-order_user_address").val(data.address);
         	   			$("#c-order_user_name").val(data.name);
         	   			
         					console.info(data);     													      
               			return false;    															
           				},function(data){
               		//失败的回调 
           				//return false;	
              			}											  		 		  
 			   		);
       	 	   	}
       	 		});
       	 	
       	 	//查找用户
       	 	$(document).on("click",".btn-adduser",function () {
				    //弹窗显示支付方式
         	  Fast.api.open('user/user/index','查找客户',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '90%'],
		           callback: function (data) {	
		          // alert(data);
		          if (data.length>0) {
		           $("#c-order_user_id").val(data[0].id);
		           $("#c-order_user_id").selectPageRefresh();
		           $("#c-order_user_tel").val(data[0].mobile);
         	     $("#c-order_user_address").val(data[0].address);
		           }
	       	    },function (data) {
	       	    	
	       	    }
	            });
	       
	         });
	         
	         //添加明细
       		$(document).on("click",".btn-newadd",function () {
       		  if ($("#c-order_user_id").val()!=='') {
       			//alert($("#c-order_user_id").val());
       			Fast.api.open('service/rorder/detailadd?user_id='+$("#c-order_user_id").val(),'添加产品',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	            area:['85%', '95%'],
		           callback: function (data) {	
		   
	       	    },function (data) {
    	
	       	    }
	            });
       		} else{
       			alert('请先选择客户，再添加产品明细！');
       		}
       		});
       		//编辑
       		$(document).on("click",".btn-newedit",function () {
       		  if ($("#c-order_user_id").val()!=='') {
       		  	var ids = Table.api.selectedids(table);
       			if (ids.length>0) {
       			Fast.api.open('service/detailtemp/edit?ids='+ids[0]+'&user_id='+$("#c-order_user_id").val(),'修改产品',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	            area:['85%', '95%'],
		           callback: function (data) {
		           	 
		   
	       	    },function (data) {
    	
	       	    }
	            });
	           } 
       		} else{
       			alert('请先选择客户，再添加产品明细！');
       		}
       		});
	         //保存
       		$(document).on("click",".btn-verify",function () {
       		  if ($("#c-order_id").val()=='') {
       			$("#add-form").attr("action","service/rorder/add").submit(); 
       		} else{
       			alert('请新建单据，重新填写后再执行保存操作！');
       		}
       		});
       		
       		//打印
       		$(document).on("click",".btn-printing",function () {
       			if ($("#c-order_id").val()!=='') {
       			//打印单据
						$.ajax({
                        url: "sale/order/print",
                        type: 'post',
                        dataType: 'json',
                        data: {order_id:$("#c-order_id").val()},
                        success: function (ret) {
                            var options ={
                                templateCode:'XSD',
                                data:ret.data,
                                list:ret.list
                            };
                            Printing.api.printTemplate(options);
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });
                 } else {
                 	alert('请先保存单据再执行打印！');
                 }
       		});
        },
        edit: function () {
        		//选定客户名称后，自动填写客户其它信息
       	 	$("#c-order_user_id").on('change',function(){
       	 		var id = $("#c-order_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		if (id!=='') {
       	 			//用用户信填写表中的地址，电话，联系人等信息
       	 			Fast.api.ajax({
        					url:'user/user/getuserinfo',        													     
             			data:{id:$("#c-order_user_id").val()} //再将收到的create_code用POST方式发给主表控制器的total
         	   	}, 
         	 			function (data,ret) { //success 用于接收主表控制器发过来的数据
         	 				$("#c-order_user_tel").val(data.mobile);
         	   			$("#c-order_user_address").val(data.address);
         	   			$("#c-order_user_name").val(data.name);
         	   			
         					console.info(data);     													      
               			return false;    															
           				},function(data){
               		//失败的回调 
           				//return false;	
              			}											  		 		  
 			   		);
       	 	   	}
       	 		});
       	 	//查找用户
       	 	$(document).on("click",".btn-adduser",function () {
				    //弹窗显示支付方式
         	  Fast.api.open('user/user/index','查找客户',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '90%'],
		           callback: function (data) {	
		          // alert(data);
		          if (data.length>0) {
		           $("#c-order_user_id").val(data[0].id);
		           $("#c-order_user_id").selectPageRefresh();
		           $("#c-order_user_tel").val(data[0].mobile);
         	     $("#c-order_user_address").val(data[0].address);
		           }
	       	    },function (data) {
	       	    	
	       	    }
	            });
	       
	         });
        		//打印
       		$(document).on("click",".btn-printing",function () {
       			//打印单据
					$.ajax({
                        url: "sale/order/print",
                        type: 'post',
                        dataType: 'json',
                        data: {order_id:Config.row},
                        success: function (ret) {
                            var options ={
                                templateCode:'XSD',
                                data:ret.data,
                                list:ret.list
                            };
                            Printing.api.printTemplate(options);
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });
       		});
            Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'stock/iostock/orderdetail?iostock_main_id='+Config.row + location.search,
                    //add_url: 'sale/detailtemp/add',
                    //edit_url: 'sale/detailtemp/edit',
                    //del_url: 'sale/detailtemp/del',
                    table: 'stock_iostock',
                }
            });

            var table = $("#table");
            

           // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'iostock_id',
                sortName: 'iostock_sn',
                sortOrder:'asc',
                commonSearch: false,
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'iostock_main_id', title: __('Iostock_main_id')},
                        //{field: 'detail_main_id', title: __('Detail_main_id')},
                        //{field: 'detail_main_code', title: __('Detail_main_code'), operate: 'LIKE'},
                        //{field: 'detail_date', title: __('Detail_date')},
                        {field: 'iostock_sn', title: __('Iostock_sn')},
                        //{field: 'detail_product_id', title: __('Detail_product_id')},
                        {field: 'iostock_product_name', title: __('Iostock_product_name'), operate: 'LIKE'},
                        {field: 'iostock_product_type', title: __('Iostock_product_type'), operate: 'LIKE'},
                        {field: 'iostock_unit', title: __('Iostock_unit'), operate: 'LIKE'},
                        {field: 'iostock_outnumber', title: __('Iostock_outnumber')},
                        {field: 'iostock_price', title: __('Iostock_price'), operate:'BETWEEN'},
                        {field: 'iostock_amount', title: __('Iostock_amount'), operate:'BETWEEN'},
                        {field: 'iostock_remark', title: __('Iostock_remark')},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                    ]
                ]
            });
            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        detailadd: function () {   
		     
        		//实现产品名称和产品型号联动
        		 $("#c-detail_product_classify").on('change',function(){
         		var classify = $("#c-detail_product_classify").val();
          	   $("#c-detail_product_name").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-detail_product_name_text").data("selectPageObject").option.data = 'base/production/getproductname?production_classify='+classify;   
       	 	});
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
       	  
            Controller.api_detail.bindevent();
            
        },
        detailedit: function () {
            Controller.api_detail.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"), function(data, ret){
					//如果我们需要在提交表单成功后做跳转，可以在此使用location.href="链接";进行跳转
					//Toastr.success("成功");				
					$("#c-order_id").val(data);
					//打印单据
					$.ajax({
                        url: "sale/order/print",
                        type: 'post',
                        dataType: 'json',
                        data: {order_id:data},
                        success: function (ret) {
                            var options ={
                                templateCode:'XSD',
                                data:ret.data,
                                list:ret.list
                            };
                            Printing.api.printTemplate(options);
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });
					
                
					//刷新表格
   				parent.$("#table").bootstrapTable('refresh');
   				return false;
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
        },
    api_detail: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"), function(data, ret){
					//如果我们需要在提交表单成功后做跳转，可以在此使用location.href="链接";进行跳转
					//Toastr.success("成功");	
					//alert(data.detail_user_address);			
					//$("#c-order_id").val(data.product_user_id);
					if (data.detail_isinstall==1) {
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
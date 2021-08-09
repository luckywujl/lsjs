define(['jquery', 'bootstrap', 'backend', 'table','form','printing'], function ($, undefined, Backend, Table, Form,Printing) {

    var Controller = {
        index: function () {
        	$(".btn-add").data("area",["90%","90%"]);
         	$(".btn-edit").data("area",["90%","90%"]);
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'service/repair/index' + location.search,
                    add_url: 'service/repair/add',
                    edit_url: 'service/repair/edit',
                    del_url: 'service/repair/del',
                    
                    table: 'repair',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'repair_id',
                sortName: 'repair_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'repair_id', title: __('Repair_id')},
                        {field: 'repair_code', title: __('Repair_code'), operate: 'LIKE'},
                        {field: 'repair_datetime', title: __('Repair_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'repair_service_datetime', title: __('Repair_service_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'repair_user_id', title: __('Repair_user_id'), operate: 'LIKE'},
                        {field: 'repair_user_name', title: __('Repair_user_name'), operate: 'LIKE'},
                        {field: 'repair_tel', title: __('Repair_tel'), operate: 'LIKE'},
                        {field: 'repair_address', title: __('Repair_address'), operate: 'LIKE'},
                        //{field: 'repair_product_id', title: __('Repair_product_id')},
                        {field: 'repair_product_code', title: __('Repair_product_code'), operate: 'LIKE'},
                        {field: 'repair_remark', title: __('Repair_remark')},
                        {field: 'repair_dispatcher', title: __('Repair_dispatcher'), operate: 'LIKE'},
                        {field: 'repair_engineer', title: __('Repair_engineer'), operate: 'LIKE'},
                        {field: 'repair_isfree', title: __('Repair_isfree'), searchList: {"0":__('Repair_isfree 0'),"1":__('Repair_isfree 1')}, formatter: Table.api.formatter.normal},
                        {field: 'repair_amount', title: __('Repair_amount'), operate:'BETWEEN'},
                        {field: 'repair_operator', title: __('Repair_operator'), operate: 'LIKE'},
                        {field: 'repair_status', title: __('Repair_status'), searchList: {"0":__('Repair_status 0'),"1":__('Repair_status 1'),"2":__('Repair_status 2'),"3":__('Repair_status 3'),"4":__('Repair_status 4'),"5":__('Repair_status 5')}, formatter: Table.api.formatter.status},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });
            table.on('post-body.bs.table',function (e,settings,json,xhr) {
            	$(".btn-editone").data("area",["90%","90%"]);
            	$(".btn-editone").data("title",'查看');
            })

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
        		$(document).on("click",".btn-adduser",function () {
        		//弹窗显示查找客户
         	  Fast.api.open('product/info/finduser','查找客户',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '90%'],
		           callback: function (data) {	
		           //alert(data);
		           if (data.length >0) {
		           	//document.getElementById("user_info").style.visibility="visible";
		            $("#c-repair_user_id").val(data[0].product_user_id);
		            $("#c-repair_user_name").val(data[0].product_user_name);
		            $("#c-repair_tel").val(data[0].product_tel);
		            $("#c-repair_address").val(data[0].product_address);
		            $("#c-repair_product_id").val(data[0].product_id);
		            $("#c-repair_product_code").val(data[0].product_code);
		           } else{
		             //document.getElementById("row[detail_isinstall]-0").checked=true;
		             //document.getElementById("user_info").style.visibility="hidden";
		             //$("#c-product_id").val('');
		           }
		           //$("#c-order_user_id").val(data);
		           //$("#c-order_user_id").selectPageRefresh();
		           //var id = $("#c-order_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		
	       	    },function (data) {
	       	    	
	       	    }
	            });
	         });
	         //保存
       		$(document).on("click",".btn-verify",function () {
       		  if ($("#c-repair_id").val()=='') {
       			$("#add-form").attr("action","service/repair/add").submit(); 
       		} else{
       			alert('请新建单据，重新填写后再执行保存操作！');
       		}
       		});
       		//弹窗显示开具销售单
	         $(document).on("click",".btn-addsale",function () {
	           if ($("#c-repair_user_id").val()!=='') {
         	  Fast.api.open('service/rorder/add?user_id='+$("#c-repair_user_id").val()+'&user_name='+$("#c-repair_user_name").val()+'&user_tel='+$("#c-repair_tel").val()+'&user_address='+$("#c-repair_address").val()+'&engineer='+$("#c-repair_engineer").val()+'&service_datetime='+$("#c-repair_service_datetime").val(),'产品销售',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '90%'],
		           callback: function (data) {	
		           //alert(data);
		           
		           //$("#c-order_user_id").val(data);
		           //$("#c-order_user_id").selectPageRefresh();
		           //var id = $("#c-order_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		
	       	    },function (data) {
	       	    	
	       	    }
	            });
	         } else {
	         		alert('请先确定报修客户！');
	         }
	         });
	         //打印
       		$(document).on("click",".btn-print",function () {
       			if ($("#c-repair_id").val()!=='') {
       			//打印单据
						$.ajax({
                        url: "service/repair/print",
                        type: 'post',
                        dataType: 'json',
                        data: {repair_id:$("#c-repair_id").val()},
                        success: function (ret) {
                            var options ={
                                templateCode:'WXD',
                                data:ret.data,
                                
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
            Controller.api.bindevent();
        },
        edit: function () {
        	//弹窗显示开具销售单
	         $(document).on("click",".btn-addsale",function () {
	         	
         	  Fast.api.open('service/rorder/add?user_id='+$("#c-repair_user_id").val()+'&user_name='+$("#c-repair_user_name").val()+'&user_tel='+$("#c-repair_tel").val()+'&user_address='+$("#c-repair_address").val()+'&engineer='+$("#c-repair_engineer").val()+'&service_datetime='+$("#c-repair_service_datetime").val(),'产品销售',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '90%'],
		           callback: function (data) {	
		           //alert(data);
		           
		           //$("#c-order_user_id").val(data);
		           //$("#c-order_user_id").selectPageRefresh();
		           //var id = $("#c-order_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		
	       	    },function (data) {
	       	    	
	       	    }
	            });
	         });
	         //打印
       		$(document).on("click",".btn-print",function () {
       			if ($("#c-repair_id").val()!=='') {
       			//打印单据
						$.ajax({
                        url: "service/repair/print",
                        type: 'post',
                        dataType: 'json',
                        data: {repair_id:$("#c-repair_id").val()},
                        success: function (ret) {
                            var options ={
                                templateCode:'WXD',
                                data:ret.data,
                                
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
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"), function(data, ret){
					//如果我们需要在提交表单成功后做跳转，可以在此使用location.href="链接";进行跳转
					//Toastr.success("成功");				
					$("#c-repair_id").val(data);
					//打印单据
					$.ajax({
                        url: "service/repair/print",
                        type: 'post',
                        dataType: 'json',
                        data: {repair_id:$("#c-repair_id").val()},
                        success: function (ret) {
                            var options ={
                                templateCode:'WXD',
                                data:ret.data
                                //list:ret.list
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
					});
            }
        }
    };
    return Controller;
});
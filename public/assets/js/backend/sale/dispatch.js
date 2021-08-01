define(['jquery', 'bootstrap', 'backend', 'table','form','printing'], function ($, undefined, Backend, Table, Form,Printing) {

    var Controller = {
        index: function () {
          	$(".btn-add").data("area",["90%","90%"]);
         	$(".btn-edit").data("area",["90%","90%"]);
         	$(".btn-edit").data("title",'派单');
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/dispatch/index' + location.search,
                    add_url: 'sale/dispatch/add',
                    edit_url: 'sale/dispatch/edit',
                    del_url: 'sale/dispatch/del',
                    multi_url: 'sale/dispatch/multi',
                    import_url: 'sale/dispatch/import',
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
                        {field: 'order_datetime', title: __('Order_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'order_service_datetime', title: __('Order_service_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'order_user_id', title: __('Order_user_id')},
                        {field: 'order_engineer', title: __('Order_engineer'), operate: 'LIKE'},
                        {field: 'order_user_name', title: __('Order_user_name'), operate: 'LIKE'},
                        {field: 'order_user_tel', title: __('Order_user_tel'), operate: 'LIKE'},
                        {field: 'order_user_address', title: __('Order_user_address'), operate: 'LIKE'},
                        {field: 'order_number_total', title: __('Order_number_total'), operate:'BETWEEN'},
                        //{field: 'order_amount_total', title: __('Order_amount_total'), operate:'BETWEEN'},
                        //{field: 'order_payamount', title: __('Order_payamount'), operate:'BETWEEN'},
                        //{field: 'order_paymentmode', title: __('Order_paymentmode'), operate: 'LIKE'},
                        {field: 'order_dispatcher', title: __('Order_dispatcher'), operate: 'LIKE'},
                        {field: 'order_status', title: __('Order_status'), searchList: {"0":__('Order_status 0'),"1":__('Order_status 1'),"3":__('Order_status 3')}, formatter: Table.api.formatter.status},
                        {field: 'order_remark', title: __('Order_remark')},
                        {field: 'order_operator', title: __('Order_operator'), operate: 'LIKE'},
                        {field: 'order_saleman', title: __('Order_saleman'), operate: 'LIKE'},
                        {field: 'order_sale_type', title: __('Order_sale_type'), operate: 'LIKE'},
                        
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            table.on('post-body.bs.table',function (e,settings,json,xhr) {
            	$(".btn-editone").data("area",["90%","90%"]);
            	$(".btn-editone").data("title",'派单');
            })
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
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
            Controller.api.bindevent();
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
        }
    };
    return Controller;
});
define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'printing'], function ($, undefined, Backend, Table, Form, Printing) {

    var Controller = {
        index: function () {
      
         	$(".btn-edit").data("area",["90%","90%"]);
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/dispatch/index' + location.search,
                    edit_url: 'sale/dispatch/edit?log_status={log_status}', 
                    table: 'product_log',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'log_code',
                sortName: 'log_code',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'log_id', title: __('Log_id')},
                        {field: 'log_code', title: __('Log_code'), operate: 'LIKE'},
                        //{field: 'product_id', title: __('Product_id')},
                        {field: 'log_type', title: __('Log_type'), operate: 'LIKE'},
                        {field: 'log_date', title: __('Log_date'),operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'log_saleman', title: __('Log_saleman'), operate: 'LIKE'},
                        {field: 'tasknumber', title: __('Tasknumber'), operate: 'LIKE'},
                        //{field: 'log_remark', title: __('Log_remark'), operate: 'LIKE'},
                        {field: 'log_user_name', title: __('Log_user_name'), operate: 'LIKE'},
                        {field: 'log_user_contact', title: __('Log_user_contact'), operate: 'LIKE'},
                        {field: 'log_address', title: __('Log_address'), operate: 'LIKE'},
                        {field: 'log_tel', title: __('Log_tel'), operate: 'LIKE'},
                        //{field: 'log_user_id', title: __('Log_user_id')},
                        {field: 'log_operator', title: __('Log_operator'), operate: 'LIKE'},
                        //{field: 'log_pic', title: __('Log_pic')},
                        //{field: 'log_dispatcher', title: __('Log_dispatcher'), operate: 'LIKE'},
                        //{field: 'log_valuation', title: __('Log_valuation'), operate: 'LIKE'},
                        //{field: 'log_valuation_star', title: __('Log_valuation_star'), operate: 'LIKE'},
                        {field: 'log_status', title: __('Log_status'), searchList: {"0":__('Log_status 0'),"1":__('Log_status 1'),"2":__('Log_status 2'),"3":__('Log_status 3'),"4":__('Log_status 4'),"5":__('Log_status 5')}, formatter: Table.api.formatter.status},
                        //{field: 'log_callbacker', title: __('Log_callbacker'), operate: 'LIKE'},
                        //{field: 'log_callback', title: __('Log_callback')},
                        //{field: 'log_log', title: __('Log_log')},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            
            table.on('post-body.bs.table',function (e,settings,json,xhr) {
            	$(".btn-editone").data("area",["90%","90%"]);
            	$(".btn-editone").data("title",'派单');
            })
            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
        	$(".btn-edit").data("area",["90%","90%"]);
        	// 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/dispatch/logdetail?log_code='+Config.row.log_code+'&log_status='+Config.row.log_status ,
                    //add_url: 'sale/detailtemp/add',
                    edit_url: 'sale/dispatch/logedit',
                    //del_url: 'sale/detailtemp/del',
                    table: 'product_log',
                }
            });
        	var table = $("#table");
           // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'log_id',
                sortName: 'log_id',
                sortOrder:'asc',
                commonSearch: false,
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'log_id', title: __('Log_id'),visible:false},
                        {field: 'log_address', title: __('Log_address'), operate: 'LIKE'},
                        {field: 'log_user_contact', title: __('Log_user_contact'), operate: 'LIKE'},
                        //{field: 'log_code', title: __('Log_code'), operate: 'LIKE'},
                        //{field: 'product_id', title: __('Product_id')},
                        //{field: 'log_type', title: __('Log_type'), operate: 'LIKE'},
                        //{field: 'log_date', title: __('Log_date')},
                        {field: 'productinfo.product_name', title: __('Productinfo.product_name'), operate: 'LIKE'},
                        {field: 'productinfo.product_type', title: __('Productinfo.product_type'), operate: 'LIKE'},
                        {field: 'log_remark', title: __('Log_remark'), operate: 'LIKE'},
                        //{field: 'log_user_name', title: __('Log_user_name'), operate: 'LIKE'},
                        
                        //{field: 'log_tel', title: __('Log_tel'), operate: 'LIKE'},
                        //{field: 'log_user_id', title: __('Log_user_id')},
                        //{field: 'log_operator', title: __('Log_operator'), operate: 'LIKE'},
                        //{field: 'log_pic', title: __('Log_pic')},
                        //{field: 'log_dispatcher', title: __('Log_dispatcher'), operate: 'LIKE'},
                        //{field: 'log_valuation', title: __('Log_valuation'), operate: 'LIKE'},
                        //{field: 'log_valuation_star', title: __('Log_valuation_star'), operate: 'LIKE'},
                        {field: 'log_status', title: __('Log_status'), searchList: {"0":__('Log_status 0'),"1":__('Log_status 1'),"2":__('Log_status 2'),"3":__('Log_status 3'),"4":__('Log_status 4'),"5":__('Log_status 5')}, formatter: Table.api.formatter.status},
                        //{field: 'log_callbacker', title: __('Log_callbacker'), operate: 'LIKE'},
                        //{field: 'log_callback', title: __('Log_callback')},
                        //{field: 'log_log', title: __('Log_log')},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });
            // 为表格绑定事件
            Table.api.bindevent(table);
            table.on('post-body.bs.table',function (e,settings,json,xhr) {
            	$(".btn-editone").data("area",["90%","90%"]);
            	$(".btn-editone").data("title",'单个派单');
            })
            //选定客户名称后，自动填写客户其它信息
       	 	$("#c-log_user_id").on('change',function(){
       	 		var id = $("#c-log_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		if (id!=='') {
       	 			//用用户信填写表中的地址，电话，联系人等信息
       	 			Fast.api.ajax({
        					url:'user/user/getuserinfo',        													     
             			data:{id:$("#c-log_user_id").val()} //再将收到的create_code用POST方式发给主表控制器的total
         	   	}, 
         	 			function (data,ret) { //success 用于接收主表控制器发过来的数据
         	 				$("#c-log_tel").val(data.mobile);
         	   			$("#c-log_address").val(data.address);
         	   			$("#c-log_user_name").val(data.name);
         	   			
         					console.info(data);     													      
               			return false;    															
           				},function(data){
               		//失败的回调 
           				//return false;	
              			}											  		 		  
 			   		);
       	 	   	}
       	 		});
       	 		
       	 		//打印
       		$(document).on("click",".btn-printing",function () {
       			if ($("#c-log_code").val()!=='') {
       			//打印单据
						$.ajax({
                        url: "sale/dispatch/print",
                        type: 'post',
                        dataType: 'json',
                        data: {order_code:$("#c-log_code").val()},
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
            Controller.api.bindevent();
        },
        logedit:function () {
        		Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
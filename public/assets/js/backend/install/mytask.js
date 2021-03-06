define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
          
         	$(".btn-edit").data("area",["90%","90%"]);
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'install/mytask/index' + location.search,
                    edit_url: 'install/mytask/edit?log_status={log_status}',
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
                        {field: 'log_saleman', title: __('Log_saleman'), operate: 'LIKE'},
                        {field: 'log_date', title: __('Log_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
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

            // 为表格绑定事件
            Table.api.bindevent(table);
            table.on('post-body.bs.table',function (e,settings,json,xhr) {
            	$(".btn-editone").data("area",["90%","90%"]);
            	$(".btn-editone").data("title",'查看明细');
            })
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
        	
         	$(".btn-edit").data("area",["90%","90%"]);
        	// 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'install/mytask/logdetail?log_code='+Config.row.log_code+'&log_status='+Config.row.log_status ,
                    //add_url: 'sale/detailtemp/add',
                    edit_url: 'install/mytask/logedit',
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
                        {field: 'productinfo.product_name', title: __('Productinfo.product_name'), operate: 'LIKE'},
                        {field: 'productinfo.product_type', title: __('Productinfo.product_type'), operate: 'LIKE'},
                        
                        //{field: 'log_code', title: __('Log_code'), operate: 'LIKE'},
                        //{field: 'product_id', title: __('Product_id')},
                        //{field: 'log_type', title: __('Log_type'), operate: 'LIKE'},
                        //{field: 'log_date', title: __('Log_date')},
                        {field: 'log_water_gage', title: __('Log_water_gage'), operate: 'LIKE'},
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
            	$(".btn-editone").data("title",'施工记录');
            })
            //弹窗显示开具销售单
	         $(document).on("click",".btn-addsale",function () {
	           if ($("#c-log_user_id").val()!=='') {
	           var inDate = new Date();
	           var order_service_datetime = inDate.getFullYear()+'-'+(inDate.getMonth()+1)+'-'+inDate.getDate()+" "+inDate.getHours()+':'+inDate.getMinutes()+':'+inDate.getSeconds();
         		
         	  Fast.api.open('service/rorder/add?user_id='+$("#c-log_user_id").val()+'&user_name='+$("#c-log_user_name").val()+'&user_tel='+$("#c-log_tel").val()+'&user_address='+$("#c-log_address").val()+'&engineer='+$("#c-log_operator").val()+'&service_datetime='+order_service_datetime+'&user_contact='+$("#c-log_user_contact").val(),'产品销售',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
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
            Controller.api.bindevent();
        },
        logedit: function () {
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
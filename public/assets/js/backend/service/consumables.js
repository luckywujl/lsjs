define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
        	$(".btn-edit").data("area",["90%","90%"]);
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'service/consumables/index' + location.search,
                    add_url: 'service/consumables/add',
                    edit_url: 'service/consumables/edit',
                    del_url: 'service/consumables/del',
                    multi_url: 'service/consumables/multi',
                    import_url: 'service/consumables/import',
                    table: 'product_info',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'product_id',
                sortName: 'product_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'product_id', title: __('Product_id')},
                        {field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), operate: 'LIKE'},
                        {field: 'product_type', title: __('Product_type'), operate: 'LIKE'},
                        //{field: 'product_product_date', title: __('Product_product_date')},
                        //{field: 'product_instock_date', title: __('Product_instock_date')},
                        {field: 'product_sale_date', title: __('Product_sale_date'), addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_install_date', title: __('Product_install_date'), addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_log_date', title: __('Product_log_date'),operate:false, addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_next_date', title: __('Product_next_date'),operate:false, visible:false,addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_replacement_date', title: __('Product_replacement_date'), addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_water_gage', title: __('Product_water_gage'), operate: false,visible:false},
                        {field: 'product_consumable_material', title: __('Product_consumable_material'), operate: 'LIKE'},
                        {field: 'product_remark', title: __('Product_remark')},
                        //{field: 'product_user_id', title: __('Product_user_id'), operate: 'LIKE'},
                        {field: 'product_user_name', title: __('Product_user_name'), operate: 'LIKE'},
                        {field: 'product_user_contact', title: __('Product_user_contact'), operate: 'LIKE'},
                        {field: 'product_tel', title: __('Product_tel'), operate: 'LIKE'},
                        {field: 'product_address', title: __('Product_address'), operate: 'LIKE'},
                        {field: 'product_sale_type', title: __('Product_sale_type'), operate: 'LIKE'},
                        {field: 'product_order_code', title: __('Product_order_code'), operate: 'LIKE',visible:false},
                        //{field: 'product_order_id', title: __('Product_order_id')},
                        {field: 'product_install_place', title: __('Product_install_place'), operate: 'LIKE'},
                        {field: 'product_install_type', title: __('Product_install_type'), operate: 'LIKE'},
                        {field: 'product_purpose', title: __('Product_purpose'), operate: 'LIKE'},
                        {field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3'),"4":__('Product_status 4'),"5":__('Product_status 5'),"6":__('Product_status 6'),"7":__('Product_status 7'),"8":__('Product_status 8'),"9":__('Product_status 9'),"10":__('Product_status 10')}, formatter: Table.api.formatter.status},
                        {field: 'product_saleman', title: __('Product_saleman'), operate: 'LIKE'},
                        {field: 'product_pic', title: __('Product_pic'), operate:false,visible:false},
                        //{field: 'company_id', title: __('Company_id')},
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
            Controller.api.bindevent();
        },
        edit: function () {
        	//弹窗显示开具销售单
	         $(document).on("click",".btn-addsale",function () {
	         	
         	  Fast.api.open('service/corder/add?user_id='+$("#c-product_user_id").val()+'&user_name='+$("#c-product_user_name").val()+'&user_contact='+$("#c-product_user_contact").val()+'&user_tel='+$("#c-product_tel").val()+'&user_address='+$("#c-product_address").val()+'&product_id='+$("#c-product_id").val(),'产品销售',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['90%', '100%'],
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'stock/inventory/index' + location.search,
                    //add_url: 'stock/inventory/add',
                    edit_url: 'stock/inventory/edit',
                   // del_url: 'stock/inventory/del',
                   // multi_url: 'stock/inventory/multi',
                    import_url: 'stock/inventory/import',
                    table: 'base_production_info',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'production_id',
                sortName: 'production_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'production_id', title: __('Production_id')},
                        {field: 'production_name', title: __('Production_name'), operate: 'LIKE'},
                        {field: 'production_type', title: __('Production_type'), operate: 'LIKE'},
                        {field: 'production_unit', title: __('iostock_unit')},
                        {field: 'production_consumable_material', title: __('Production_consumable_material'), operate: 'LIKE'},
                        
                        {field: 'production_stock_number', title: __('Production_stock_number')},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, 
													buttons: [
 												  		 {
 												  		 	name: 'detail', 
 												  		 	text: '出入明细', 
 												  		 	title: '出入明细', 
 												  		 	icon: 'fa fa-list', 
 												  		 	extend: 'data-area=\'["95%","95%"]\'',    //设置最大化
 												  		 	classname: 'btn btn-xs btn-primary btn-dialog',  												  
 												  		 	url: 'stock/inventory/detailindex?iostock_product_id={production_id}',
 												  		 	callback:function (data) { //接收到弹窗关闭发过来的参数-create_code
 												  		 		  }
 												  		 	}
														],        formatter: Table.api.formatter.operate  } 
                        //{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        detailindex: function () {
        	// 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'stock/inventory/detailindex/iostock_product_id='+Config.iostock_product_id + location.search,
                    
                    table: 'stock_iostock',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'iostock_id',
                sortName: 'iostock_id',
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'iostock_id', title: __('Iostock_id')},
                        //{field: 'iostock_main_id', title: __('Iostock_main_id')},
                        {field: 'iostock_type', title: __('Iostock_type'), searchList: {"0":__('Iostock_type 0'),"1":__('Iostock_type 1'),"2":__('Iostock_type 2'),"3":__('Iostock_type 3'),"4":__('Iostock_type 4')}, formatter: Table.api.formatter.normal},
                        {field: 'iostock_date', title: __('Iostock_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        //{field: 'iostock_sn', title: __('Iostock_sn')},
                        //{field: 'iostock_product_id', title: __('Iostock_product_id')},
                        {field: 'iostock_product_name', title: __('Iostock_product_name'), operate: false},
                        {field: 'iostock_product_type', title: __('Iostock_product_type'), operate: false},
                        {field: 'iostock_unit', title: __('Iostock_unit'), operate: false},
                        {field: 'iostock_number', title: __('Iostock_number')},
                        {field: 'iostock_outnumber', title: __('Iostock_outnumber')},
                        {field: 'iostock_price', title: __('Iostock_price'), operate:false,visible:false},
                        {field: 'iostock_amount', title: __('Iostock_amount'), operate:false,visible:false},
                        {field: 'iostock_stock_number', title: __('Iostock_stock_number')},
                        {field: 'iostock_operator', title: __('Iostock_operator'), operate: 'LIKE'},
                        {field: 'iostock_remark', title: __('Iostock_remark'),visible:false},
								{field: 'iostock_code', title: __('Iostock_code'), operate: 'LIKE'},
                        
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        //{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
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
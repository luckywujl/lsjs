define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/info/index' + location.search,
                    add_url: 'product/info/add',
                    edit_url: 'product/info/edit',
                    del_url: 'product/info/del',
                    multi_url: 'product/info/multi',
                    import_url: 'product/info/import',
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
                        {field: 'product_area', title: __('Product_area'), operate: 'LIKE'},
                        {field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), operate: 'LIKE'},
                        {field: 'product_type', title: __('Product_type'), operate: 'LIKE'},
                        //{field: 'product_product_date', title: __('Product_product_date')},
                        //{field: 'product_instock_date', title: __('Product_instock_date')},
                        {field: 'product_sale_date', title: __('Product_sale_date'), visible:false,operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_install_date', title: __('Product_install_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_log_date', title: __('Product_log_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_next_date', title: __('Product_next_date'), visible:false, operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_replacement_date', title: __('Product_replacement_date'),visible:false, operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_water_gage', title: __('Product_water_gage'), operate: false,visible:false},
                        {field: 'product_consumable_material', title: __('Product_consumable_material'), operate: 'LIKE'},
                        {field: 'product_remark', title: __('Product_remark'),operate:false,visible:false},
                        //{field: 'product_user_id', title: __('Product_user_id'), operate: 'LIKE'},
                        {field: 'product_user_name', title: __('Product_user_name'), operate: 'LIKE'},
                        {field: 'product_tel', title: __('Product_tel'), operate: 'LIKE'},
                        {field: 'product_address', title: __('Product_address'), operate: 'LIKE'},
                        {field: 'product_sale_type', title: __('Product_sale_type'), operate: 'LIKE', formatter: Table.api.formatter.status},
                        {field: 'product_order_code', title: __('Product_order_code'), operate: 'LIKE'},
                        //{field: 'product_order_id', title: __('Product_order_id')},
                        {field: 'product_install_place', title: __('Product_install_place'), operate: 'LIKE'},
                        {field: 'product_install_type', title: __('Product_install_type'), operate: 'LIKE'},
                        {field: 'product_purpose', title: __('Product_purpose'), operate: 'LIKE'},
                        {field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3'),"4":__('Product_status 4'),"5":__('Product_status 5'),"6":__('Product_status 6'),"7":__('Product_status 7'),"8":__('Product_status 8'),"9":__('Product_status 9'),"10":__('Product_status 10')}, formatter: Table.api.formatter.status},
                        {field: 'product_saleman', title: __('Product_saleman'), operate: 'LIKE'},
                        {field: 'product_pic', title: __('Product_pic'), operate: false,visible:false},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, 
													buttons: [
 												  		 {
 												  		 	name: 'detail', 
 												  		 	text: '维护日志', 
 												  		 	title: '维护日志', 
 												  		 	icon: 'fa fa-list', 
 												  		 	extend: 'data-area=\'["95%","95%"]\'',    //设置最大化
 												  		 	classname: 'btn btn-xs btn-primary btn-dialog',  												  
 												  		 	url: 'product/log/index?product_id={product_id}',
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
        viewall: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/info/viewall' + location.search,
                    add_url: 'product/info/add',
                    edit_url: 'product/info/edit',
                    del_url: 'product/info/del',
                    multi_url: 'product/info/multi',
                    import_url: 'product/info/import',
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
                        {field: 'product_area', title: __('Product_area'), operate: 'LIKE'},
                        {field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), operate: 'LIKE'},
                        {field: 'product_type', title: __('Product_type'), operate: 'LIKE'},
                        //{field: 'product_product_date', title: __('Product_product_date')},
                        //{field: 'product_instock_date', title: __('Product_instock_date')},
                        {field: 'product_sale_date', title: __('Product_sale_date'), visible:false,operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_install_date', title: __('Product_install_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_log_date', title: __('Product_log_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_next_date', title: __('Product_next_date'), visible:false, operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_replacement_date', title: __('Product_replacement_date'),visible:false, operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_water_gage', title: __('Product_water_gage'), operate: false,visible:false},
                        {field: 'product_consumable_material', title: __('Product_consumable_material'), operate: 'LIKE'},
                        {field: 'product_remark', title: __('Product_remark'),operate:false,visible:false},
                        //{field: 'product_user_id', title: __('Product_user_id'), operate: 'LIKE'},
                        {field: 'product_user_name', title: __('Product_user_name'), operate: 'LIKE'},
                        {field: 'product_tel', title: __('Product_tel'), operate: 'LIKE'},
                        {field: 'product_address', title: __('Product_address'), operate: 'LIKE'},
                        {field: 'product_sale_type', title: __('Product_sale_type'), operate: 'LIKE', formatter: Table.api.formatter.status},
                        {field: 'product_order_code', title: __('Product_order_code'), operate: 'LIKE'},
                        //{field: 'product_order_id', title: __('Product_order_id')},
                        {field: 'product_install_place', title: __('Product_install_place'), operate: 'LIKE',visible:false},
                        {field: 'product_install_type', title: __('Product_install_type'), operate: 'LIKE',visible:false},
                        {field: 'product_purpose', title: __('Product_purpose'), operate: 'LIKE'},
                        {field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3'),"4":__('Product_status 4'),"5":__('Product_status 5'),"6":__('Product_status 6'),"7":__('Product_status 7'),"8":__('Product_status 8'),"9":__('Product_status 9'),"10":__('Product_status 10')}, formatter: Table.api.formatter.status},
                        {field: 'product_saleman', title: __('Product_saleman'), operate: 'LIKE'},
                        {field: 'product_pic', title: __('Product_pic'), operate: false,visible:false},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, 
													buttons: [
 												  		 {
 												  		 	name: 'detail', 
 												  		 	text: '维护日志', 
 												  		 	title: '维护日志', 
 												  		 	icon: 'fa fa-list', 
 												  		 	extend: 'data-area=\'["95%","95%"]\'',    //设置最大化
 												  		 	classname: 'btn btn-xs btn-primary btn-dialog',  												  
 												  		 	url: 'product/log/index?product_id={product_id}',
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
        finduser: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/info/index' + location.search,
                    
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
                        {field: 'product_address', title: __('Product_address'), operate: 'LIKE'},
                        {field: 'product_user_contact', title: __('Product_user_contact'), operate: 'LIKE'},
                        {field: 'product_tel', title: __('Product_tel'), operate: 'LIKE'},
                        
                        {field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), operate: 'LIKE'},
                        
                        {field: 'product_type', title: __('Product_type'), operate: 'LIKE'},
                        //{field: 'product_product_date', title: __('Product_product_date')},
                        //{field: 'product_instock_date', title: __('Product_instock_date')},
                        {field: 'product_sale_date', title: __('Product_sale_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        {field: 'product_install_date', title: __('Product_install_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        //{field: 'product_log_date', title: __('Product_log_date')},
                       // {field: 'product_next_date', title: __('Product_next_date')},
                        {field: 'product_replacement_date', title: __('Product_replacement_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime, datetimeFormat:"YYYY-MM-DD"},
                        //{field: 'product_water_gage', title: __('Product_water_gage'), operate: 'LIKE'},
                        //{field: 'product_consumable_material', title: __('Product_consumable_material'), operate: 'LIKE'},
                        //{field: 'product_remark', title: __('Product_remark')},
                        //{field: 'product_user_id', title: __('Product_user_id'), operate: 'LIKE'},
                        {field: 'product_user_name', title: __('Product_user_name'), operate: 'LIKE'},
                        
                        
                       // {field: 'product_sale_type', title: __('Product_sale_type'), operate: 'LIKE'},
                        //{field: 'product_order_code', title: __('Product_order_code'), operate: 'LIKE'},
                       // {field: 'product_order_id', title: __('Product_order_id')},
                       // {field: 'product_install_place', title: __('Product_install_place'), operate: 'LIKE'},
                        //{field: 'product_install_type', title: __('Product_install_type'), operate: 'LIKE'},
                        //{field: 'product_purpose', title: __('Product_purpose'), operate: 'LIKE'},
                        {field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3'),"4":__('Product_status 4'),"5":__('Product_status 5'),"6":__('Product_status 6'),"7":__('Product_status 7'),"8":__('Product_status 8'),"9":__('Product_status 9'),"10":__('Product_status 10')}, formatter: Table.api.formatter.status},
                       // {field: 'product_saleman', title: __('Product_saleman'), operate: 'LIKE'},
                        //{field: 'product_pic', title: __('Product_pic'), operate: 'LIKE'},
                        //{field: 'company_id', title: __('Company_id')},
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            //关闭时执行
            parent.window.$(".layui-layer-iframe").find(".layui-layer-close").on('click',function () {
                    //var ids = Table.api.selectedids(table);   //获取选中的id，获取到的是个数组
                    var temp=table.bootstrapTable('getSelections');
                    Fast.api.close(temp); //往父窗口回调参数 
                  
             });
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
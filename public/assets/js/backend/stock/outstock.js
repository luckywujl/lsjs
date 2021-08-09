define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'stock/outstock/index' + location.search,
                    add_url: 'stock/outstock/add',
                    edit_url: 'stock/outstock/edit',
                    del_url: 'stock/outstock/del',
                    multi_url: 'stock/outstock/multi',
                    import_url: 'stock/outstock/import',
                    table: 'stock_instock',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'iostock_id',
                sortName: 'iostock_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'instock_id', title: __('Instock_id')},
                        {field: 'iostock_date', title: __('Iostock_date'),operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'iostock_code', title: __('Iostock_code'), operate: 'LIKE'},
                        //{field: 'instock_product_id', title: __('Instock_product_id')},
                        {field: 'iostock_product_name', title: __('Iostock_product_name'), operate: 'LIKE'},
                        {field: 'iostock_product_type', title: __('Iostock_product_type'), operate: 'LIKE'},
                        //{field: 'instock_number', title: __('Instock_number')},
                        {field: 'iostock_outnumber', title: __('Iostock_outnumber')},
                        {field: 'iostock_stock_number', title: __('Iostock_stock_number')},
                        {field: 'iostock_operator', title: __('Iostock_operator'), operate: 'LIKE'},
                        //{field: 'instock_type', title: __('Instock_type'), searchList: {"0":__('Instock_type 0'),"1":__('Instock_type 1')}, formatter: Table.api.formatter.normal},
                        {field: 'iostock_remark', title: __('Iostock_remark')},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
        	$("#c-iostock_product_name").on('change',function(){
         		var product = $('#c-iostock_product_name').val();
         		
          	   $("#c-iostock_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-iostock_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
       	 	});
            Controller.api.bindevent();
        },
        edit: function () {
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'stock/instock/index' + location.search,
                    add_url: 'stock/instock/add',
                    edit_url: 'stock/instock/edit',
                    del_url: 'stock/instock/del',
                    multi_url: 'stock/instock/multi',
                    import_url: 'stock/instock/import',
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
                        //{field: 'iostock_id', title: __('iostock_id')},
                        {field: 'iostock_date', title: __('iostock_date'),operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'iostock_code', title: __('iostock_code'), operate: 'LIKE'},
                        {field: 'iostock_product_name', title: __('iostock_product_name'), operate: 'LIKE'},
                        {field: 'iostock_product_type', title: __('iostock_product_type'), operate: 'LIKE'},
                        {field: 'iostock_number', title: __('iostock_number')},
                        {field: 'iostock_stock_number', title: __('iostock_stock_number')},
                        {field: 'iostock_operator', title: __('iostock_operator'), operate: 'LIKE'},
                        {field: 'iostock_remark', title: __('iostock_remark'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
				Controller.api.bindevent();
         	$("#c-iostock_product_name").on('change',function(){
         		var product = $('#c-iostock_product_name').val();
         		
          	   $("#c-iostock_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-iostock_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
       	 	});
            
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
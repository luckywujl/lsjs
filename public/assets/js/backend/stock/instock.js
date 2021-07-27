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
                pk: 'instock_id',
                sortName: 'instock_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'instock_id', title: __('Instock_id')},
                        {field: 'instock_date', title: __('Instock_date'),operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'instock_code', title: __('Instock_code'), operate: 'LIKE'},
                        {field: 'instock_product_name', title: __('Instock_product_name'), operate: 'LIKE'},
                        {field: 'instock_product_type', title: __('Instock_product_type'), operate: 'LIKE'},
                        {field: 'instock_number', title: __('Instock_number')},
                        {field: 'instock_stock_number', title: __('Instock_stock_number')},
                        {field: 'instock_operator', title: __('Instock_operator'), operate: 'LIKE'},
                        {field: 'instock_remark', title: __('Instock_remark'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
				Controller.api.bindevent();
         	$("#c-instock_product_name").on('change',function(){
         		var product = $('#c-instock_product_name').val();
         		
          	   $("#c-instock_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-instock_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'stock/iostock/index' + location.search,
                    add_url: 'stock/iostock/add',
                    edit_url: 'stock/iostock/edit',
                    del_url: 'stock/iostock/del',
                    multi_url: 'stock/iostock/multi',
                    import_url: 'stock/iostock/import',
                    table: 'stock_iostock',
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
                        {field: 'iostock_id', title: __('Iostock_id')},
                        {field: 'iostock_main_id', title: __('Iostock_main_id')},
                        {field: 'iostock_code', title: __('Iostock_code'), operate: 'LIKE'},
                        {field: 'iostock_date', title: __('Iostock_date')},
                        {field: 'iostock_sn', title: __('Iostock_sn')},
                        {field: 'iostock_product_id', title: __('Iostock_product_id')},
                        {field: 'iostock_product_name', title: __('Iostock_product_name'), operate: 'LIKE'},
                        {field: 'iostock_product_type', title: __('Iostock_product_type'), operate: 'LIKE'},
                        {field: 'iostock_unit', title: __('Iostock_unit'), operate: 'LIKE'},
                        {field: 'iostock_number', title: __('Iostock_number')},
                        {field: 'iostock_outnumber', title: __('Iostock_outnumber')},
                        {field: 'iostock_price', title: __('Iostock_price'), operate:'BETWEEN'},
                        {field: 'iostock_amount', title: __('Iostock_amount'), operate:'BETWEEN'},
                        {field: 'iostock_stock_number', title: __('Iostock_stock_number')},
                        {field: 'iostock_operator', title: __('Iostock_operator'), operate: 'LIKE'},
                        {field: 'iostock_type', title: __('Iostock_type'), searchList: {"0":__('Iostock_type 0'),"1":__('Iostock_type 1'),"2":__('Iostock_type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'iostock_remark', title: __('Iostock_remark')},
                        {field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
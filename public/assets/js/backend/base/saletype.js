define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/saletype/index' + location.search,
                    add_url: 'base/saletype/add',
                    edit_url: 'base/saletype/edit',
                    del_url: 'base/saletype/del',
                    multi_url: 'base/saletype/multi',
                    import_url: 'base/saletype/import',
                    table: 'base_sale_type',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'sale_type_id',
                sortName: 'sale_type_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'sale_type_id', title: __('Sale_type_id')},
                        {field: 'sale_type', title: __('Sale_type'), operate: 'LIKE'},
                        //{field: 'company_id', title: __('Company_id')},
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
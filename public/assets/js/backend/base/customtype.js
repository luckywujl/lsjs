define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/customtype/index' + location.search,
                    add_url: 'base/customtype/add',
                    edit_url: 'base/customtype/edit',
                    del_url: 'base/customtype/del',
                    multi_url: 'base/customtype/multi',
                    import_url: 'base/customtype/import',
                    table: 'base_custom_type',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'custom_type_id',
                sortName: 'custom_type_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'custom_type_id', title: __('Custom_type_id')},
                        {field: 'custom_type', title: __('Custom_type'), operate: 'LIKE'},
                       // {field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
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
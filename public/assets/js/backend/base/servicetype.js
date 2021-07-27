define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/servicetype/index' + location.search,
                    add_url: 'base/servicetype/add',
                    edit_url: 'base/servicetype/edit',
                    del_url: 'base/servicetype/del',
                    multi_url: 'base/servicetype/multi',
                    import_url: 'base/servicetype/import',
                    table: 'base_service_type',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'service_type_id',
                sortName: 'service_type_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'service_type_id', title: __('Service_type_id')},
                        {field: 'service_type', title: __('Service_type'), operate: 'LIKE'},
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
define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/classify/index' + location.search,
                    add_url: 'base/classify/add',
                    edit_url: 'base/classify/edit',
                    del_url: 'base/classify/del',
                    multi_url: 'base/classify/multi',
                    import_url: 'base/classify/import',
                    table: 'base_production_classify',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'classify_id',
                sortName: 'classify_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'classify_id', title: __('Classify_id')},
                        {field: 'classify_name', title: __('Classify_name'), operate: 'LIKE'},
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
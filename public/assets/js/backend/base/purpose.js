define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/purpose/index' + location.search,
                    add_url: 'base/purpose/add',
                    edit_url: 'base/purpose/edit',
                    del_url: 'base/purpose/del',
                    multi_url: 'base/purpose/multi',
                    import_url: 'base/purpose/import',
                    table: 'base_purpose',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'purpose_id',
                sortName: 'purpose_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'purpose_id', title: __('Purpose_id')},
                        {field: 'purpose', title: __('Purpose'), operate: 'LIKE'},
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
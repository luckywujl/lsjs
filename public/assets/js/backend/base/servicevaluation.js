define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/servicevaluation/index' + location.search,
                    add_url: 'base/servicevaluation/add',
                    edit_url: 'base/servicevaluation/edit',
                    del_url: 'base/servicevaluation/del',
                    multi_url: 'base/servicevaluation/multi',
                    import_url: 'base/servicevaluation/import',
                    table: 'base_service_valuation',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'service_valuation_id',
                sortName: 'service_valuation_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'service_valuation_id', title: __('Service_valuation_id')},
                        {field: 'service_valuation', title: __('Service_valuation'), operate: 'LIKE'},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
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
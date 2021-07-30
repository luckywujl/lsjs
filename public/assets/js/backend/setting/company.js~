define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        add: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'setting/company/index' + location.search,
                    add_url: 'setting/company/add',
                    edit_url: 'setting/company/edit',
                    del_url: 'setting/company/del',
                    multi_url: 'setting/company/multi',
                    import_url: 'setting/company/import',
                    table: 'company_info',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'company_id',
                sortName: 'company_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'company_id', title: __('Company_id')},
                        {field: 'company_name', title: __('Company_name'), operate: 'LIKE'},
                        {field: 'company_tel', title: __('Company_tel'), operate: 'LIKE'},
                        {field: 'company_address', title: __('Company_address'), operate: 'LIKE'},
                        {field: 'company_regtime', title: __('Company_regtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'company_status', title: __('Company_status'), searchList: {"0":__('Company_status 0'),"1":__('Company_status 1')}, formatter: Table.api.formatter.status},
                        {field: 'company_type', title: __('Company_type'), searchList: {"0":__('Company_type 0'),"1":__('Company_type 1'),"2":__('Company_type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'company_asofdate', title: __('Company_asofdate'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        index: function () {
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
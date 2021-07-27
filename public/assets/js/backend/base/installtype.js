define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/installtype/index' + location.search,
                    add_url: 'base/installtype/add',
                    edit_url: 'base/installtype/edit',
                    del_url: 'base/installtype/del',
                    multi_url: 'base/installtype/multi',
                    import_url: 'base/installtype/import',
                    table: 'base_install_type',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'install_type_id',
                sortName: 'install_type_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'install_type_id', title: __('Install_type_id')},
                        {field: 'install_type', title: __('Install_type'), operate: 'LIKE'},
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
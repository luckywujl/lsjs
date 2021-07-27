define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/installplace/index' + location.search,
                    add_url: 'base/installplace/add',
                    edit_url: 'base/installplace/edit',
                    del_url: 'base/installplace/del',
                    multi_url: 'base/installplace/multi',
                    import_url: 'base/installplace/import',
                    table: 'base_install_place',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'install_place_id',
                sortName: 'install_place_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'install_place_id', title: __('Install_place_id')},
                        {field: 'install_place', title: __('Install_place'), operate: 'LIKE'},
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
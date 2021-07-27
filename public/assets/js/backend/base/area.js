define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/area/index' + location.search,
                    add_url: 'base/area/add',
                    edit_url: 'base/area/edit',
                    del_url: 'base/area/del',
                    multi_url: 'base/area/multi',
                    import_url: 'base/area/import',
                    table: 'base_area',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'area_id',
                sortName: 'area_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'area_id', title: __('Area_id')},
                        {field: 'area', title: __('Area'), operate: 'LIKE'},
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
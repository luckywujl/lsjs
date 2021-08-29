define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/production/index' + location.search,
                    add_url: 'base/production/add',
                    edit_url: 'base/production/edit',
                    del_url: 'base/production/del',
                    multi_url: 'base/production/multi',
                    import_url: 'base/production/import',
                    table: 'base_production_info',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'production_id',
                sortName: 'production_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'production_id', title: __('Production_id')},
                        {field: 'production_name', title: __('Production_name'), operate: 'LIKE'},
                        {field: 'production_type', title: __('Production_type'), operate: 'LIKE'},
                        {field: 'production_unit', title: __('Production_unit'),operate:false},
                        {field: 'production_classify', title: __('Production_classify'), operate: 'LIKE'},
                        {field: 'production_stock_number', title: __('Production_stock_number'),operate:false},
                        {field: 'production_consumable_material', title: __('Production_consumable_material'), operate: 'LIKE'},
                        {field: 'production_replacement_cycle', title: __('Production_replacement_cycle')},
                        {field: 'production_stock_number', title: __('Production_stock_number')},
                        {field: 'production_isrecord', title: __('Production_isrecord'), searchList: {"0":__('Production_isrecord 0'),"1":__('Production_isrecord 1')}, formatter: Table.api.formatter.status},
                        
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
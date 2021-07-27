define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/dispatch/index' + location.search,
                    add_url: 'sale/dispatch/add',
                    edit_url: 'sale/dispatch/edit',
                    del_url: 'sale/dispatch/del',
                    multi_url: 'sale/dispatch/multi',
                    import_url: 'sale/dispatch/import',
                    table: 'product_log',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'log_id',
                sortName: 'log_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'log_id', title: __('Log_id')},
                        {field: 'log_code', title: __('Log_code'), operate: 'LIKE'},
                        {field: 'log_status', title: __('Log_status'), searchList: {"0":__('Log_status 0'),"1":__('Log_status 1'),"2":__('Log_status 2'),"3":__('Log_status 3'),"4":__('Log_status 4'),"5":__('Log_status 5')}, formatter: Table.api.formatter.status},
                        //{field: 'product_id', title: __('Product_id')},
                        {field: 'log_type', title: __('Log_type'), align:'left',operate: 'LIKE'},
                        {field: 'log_date', title: __('Log_date'),operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'log_water_gage', title: __('Log_water_gage'), operate: 'LIKE'},
                        {field: 'log_remark', title: __('Log_remark'), align:'left',operate: 'LIKE'},
                        {field: 'log_address', title: __('Log_address'), operate: 'LIKE'},
                        {field: 'log_tel', title: __('Log_tel'), operate: 'LIKE'},
                        //{field: 'log_user_id', title: __('Log_user_id')},
                        {field: 'log_operator', title: __('Log_operator'), operate: 'LIKE'},
                        //{field: 'log_pic', title: __('Log_pic'), operate: 'LIKE'},
                        {field: 'log_dispatcher', title: __('Log_dispatcher'), operate: 'LIKE'},
                        //{field: 'log_valuation', title: __('Log_valuation'), operate: 'LIKE'},
                        //{field: 'log_valuation_star', title: __('Log_valuation_star'), operate: 'LIKE'},
                        
                        //{field: 'log_callbacker', title: __('Log_callbacker'), operate: 'LIKE'},
                        //{field: 'log_callback', title: __('Log_callback')},
                        //{field: 'log_log', title: __('Log_log')},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });
            table.on('post-body.bs.table',function () {
            	$(".btn-editone").data("area",["58%","75%"]);
            	$(".btn-editone").data("title",'安装派单');
            })

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
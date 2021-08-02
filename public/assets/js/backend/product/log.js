define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/log/index' + location.search,
                    add_url: 'product/log/add',
                    edit_url: 'product/log/edit',
                    del_url: 'product/log/del',
                    multi_url: 'product/log/multi',
                    import_url: 'product/log/import',
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
                        {field: 'log_id', title: __('Log_id')},
                        {field: 'log_code', title: __('Log_code'), operate: 'LIKE'},
                        {field: 'product_id', title: __('Product_id')},
                        {field: 'log_type', title: __('Log_type'), operate: 'LIKE'},
                        {field: 'log_date', title: __('Log_date')},
                        {field: 'log_water_gage', title: __('Log_water_gage'), operate: 'LIKE'},
                        {field: 'log_remark', title: __('Log_remark'), operate: 'LIKE'},
                        {field: 'log_user_name', title: __('Log_user_name'), operate: 'LIKE'},
                        {field: 'log_address', title: __('Log_address'), operate: 'LIKE'},
                        {field: 'log_tel', title: __('Log_tel'), operate: 'LIKE'},
                        {field: 'log_user_id', title: __('Log_user_id')},
                        {field: 'log_operator', title: __('Log_operator'), operate: 'LIKE'},
                        {field: 'log_saleman', title: __('Log_saleman'), operate: 'LIKE'},
                        {field: 'log_pic', title: __('Log_pic')},
                        {field: 'log_dispatcher', title: __('Log_dispatcher'), operate: 'LIKE'},
                        {field: 'log_valuation', title: __('Log_valuation'), operate: 'LIKE'},
                        {field: 'log_valuation_star', title: __('Log_valuation_star'), operate: 'LIKE'},
                        {field: 'log_status', title: __('Log_status'), searchList: {"0":__('Log_status 0'),"1":__('Log_status 1'),"2":__('Log_status 2'),"3":__('Log_status 3'),"4":__('Log_status 4'),"5":__('Log_status 5')}, formatter: Table.api.formatter.status},
                        {field: 'log_callbacker', title: __('Log_callbacker'), operate: 'LIKE'},
                        {field: 'log_callback', title: __('Log_callback')},
                        {field: 'log_log', title: __('Log_log')},
                        {field: 'company_id', title: __('Company_id')},
                        {field: 'productinfo.product_id', title: __('Productinfo.product_id')},
                        {field: 'productinfo.product_code', title: __('Productinfo.product_code'), operate: 'LIKE'},
                        {field: 'productinfo.product_name', title: __('Productinfo.product_name'), operate: 'LIKE'},
                        {field: 'productinfo.product_type', title: __('Productinfo.product_type'), operate: 'LIKE'},
                        {field: 'productinfo.product_product_date', title: __('Productinfo.product_product_date')},
                        {field: 'productinfo.product_instock_date', title: __('Productinfo.product_instock_date')},
                        {field: 'productinfo.product_sale_date', title: __('Productinfo.product_sale_date')},
                        {field: 'productinfo.product_install_date', title: __('Productinfo.product_install_date')},
                        {field: 'productinfo.product_log_date', title: __('Productinfo.product_log_date')},
                        {field: 'productinfo.product_next_date', title: __('Productinfo.product_next_date')},
                        {field: 'productinfo.product_replacement_date', title: __('Productinfo.product_replacement_date')},
                        {field: 'productinfo.product_water_gage', title: __('Productinfo.product_water_gage'), operate: 'LIKE'},
                        {field: 'productinfo.product_consumable_material', title: __('Productinfo.product_consumable_material'), operate: 'LIKE'},
                        {field: 'productinfo.product_remark', title: __('Productinfo.product_remark')},
                        {field: 'productinfo.product_user_id', title: __('Productinfo.product_user_id'), operate: 'LIKE'},
                        {field: 'productinfo.product_user_name', title: __('Productinfo.product_user_name'), operate: 'LIKE'},
                        {field: 'productinfo.product_tel', title: __('Productinfo.product_tel'), operate: 'LIKE'},
                        {field: 'productinfo.product_address', title: __('Productinfo.product_address'), operate: 'LIKE'},
                        {field: 'productinfo.product_sale_type', title: __('Productinfo.product_sale_type'), operate: 'LIKE'},
                        {field: 'productinfo.product_order_code', title: __('Productinfo.product_order_code'), operate: 'LIKE'},
                        {field: 'productinfo.product_order_id', title: __('Productinfo.product_order_id')},
                        {field: 'productinfo.product_install_place', title: __('Productinfo.product_install_place'), operate: 'LIKE'},
                        {field: 'productinfo.product_install_type', title: __('Productinfo.product_install_type'), operate: 'LIKE'},
                        {field: 'productinfo.product_purpose', title: __('Productinfo.product_purpose'), operate: 'LIKE'},
                        {field: 'productinfo.product_status', title: __('Productinfo.product_status'), formatter: Table.api.formatter.status},
                        {field: 'productinfo.product_saleman', title: __('Productinfo.product_saleman'), operate: 'LIKE'},
                        {field: 'productinfo.product_pic', title: __('Productinfo.product_pic'), operate: 'LIKE'},
                        {field: 'productinfo.company_id', title: __('Productinfo.company_id')},
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
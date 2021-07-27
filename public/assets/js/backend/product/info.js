define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/info/index' + location.search,
                    add_url: 'product/info/add',
                    edit_url: 'product/info/edit',
                    del_url: 'product/info/del',
                    multi_url: 'product/info/multi',
                    import_url: 'product/info/import',
                    table: 'product_info',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'product_id',
                sortName: 'product_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'product_id', title: __('Product_id')},
                        {field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), operate: 'LIKE'},
                        {field: 'product_type', title: __('Product_type'), operate: 'LIKE'},
                        {field: 'product_product_date', title: __('Product_product_date')},
                        {field: 'product_instock_date', title: __('Product_instock_date')},
                        {field: 'product_sale_date', title: __('Product_sale_date')},
                        {field: 'product_install_date', title: __('Product_install_date')},
                        {field: 'product_log_date', title: __('Product_log_date')},
                        {field: 'product_next_date', title: __('Product_next_date')},
                        {field: 'product_replacement_date', title: __('Product_replacement_date')},
                        {field: 'product_water_gage', title: __('Product_water_gage'), operate: 'LIKE'},
                        {field: 'product_consumable_material', title: __('Product_consumable_material'), operate: 'LIKE'},
                        {field: 'product_remark', title: __('Product_remark')},
                        {field: 'product_user_id', title: __('Product_user_id'), operate: 'LIKE'},
                        {field: 'product_user_name', title: __('Product_user_name'), operate: 'LIKE'},
                        {field: 'product_tel', title: __('Product_tel'), operate: 'LIKE'},
                        {field: 'product_address', title: __('Product_address'), operate: 'LIKE'},
                        {field: 'product_sale_type', title: __('Product_sale_type'), operate: 'LIKE'},
                        {field: 'product_install_place', title: __('Product_install_place'), operate: 'LIKE'},
                        {field: 'product_install_type', title: __('Product_install_type'), operate: 'LIKE'},
                        {field: 'product_purpose', title: __('Product_purpose'), operate: 'LIKE'},
                        {field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3'),"4":__('Product_status 4'),"5":__('Product_status 5'),"6":__('Product_status 6'),"7":__('Product_status 7'),"8":__('Product_status 8'),"9":__('Product_status 9'),"10":__('Product_status 10')}, formatter: Table.api.formatter.status},
                        {field: 'product_pic', title: __('Product_pic'), operate: 'LIKE'},
                        {field: 'company_id', title: __('Company_id')},
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
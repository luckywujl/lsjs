define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/callback/index' + location.search,
                    add_url: 'sale/callback/add',
                    edit_url: 'sale/callback/edit',
                    del_url: 'sale/callback/del',
                    multi_url: 'sale/callback/multi',
                    import_url: 'sale/callback/import',
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
                        {field: 'log_address', title: __('Log_address'), operate: 'LIKE'},
                        {field: 'log_tel', title: __('Log_tel'), operate: 'LIKE'},
                        {field: 'log_user_id', title: __('Log_user_id')},
                        {field: 'log_operator', title: __('Log_operator'), operate: 'LIKE'},
                        {field: 'log_pic', title: __('Log_pic'), operate: 'LIKE'},
                        {field: 'log_dispatcher', title: __('Log_dispatcher'), operate: 'LIKE'},
                        {field: 'log_valuation', title: __('Log_valuation'), operate: 'LIKE'},
                        {field: 'log_valuation_star', title: __('Log_valuation_star'), operate: 'LIKE'},
                        {field: 'log_status', title: __('Log_status'), searchList: {"0":__('Log_status 0'),"1":__('Log_status 1'),"2":__('Log_status 2'),"3":__('Log_status 3'),"4":__('Log_status 4'),"5":__('Log_status 5')}, formatter: Table.api.formatter.status},
                        {field: 'log_callbacker', title: __('Log_callbacker'), operate: 'LIKE'},
                        {field: 'log_callback', title: __('Log_callback')},
                        {field: 'log_log', title: __('Log_log')},
                        {field: 'company_id', title: __('Company_id')},
                        {field: 'user.id', title: __('User.id')},
                        {field: 'user.group_id', title: __('User.group_id')},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        {field: 'user.nickname', title: __('User.nickname'), operate: 'LIKE'},
                        {field: 'user.name', title: __('User.name'), operate: 'LIKE'},
                        {field: 'user.password', title: __('User.password'), operate: 'LIKE'},
                        {field: 'user.salt', title: __('User.salt'), operate: 'LIKE'},
                        {field: 'user.email', title: __('User.email'), operate: 'LIKE'},
                        {field: 'user.mobile', title: __('User.mobile'), operate: 'LIKE'},
                        {field: 'user.address', title: __('User.address'), operate: 'LIKE'},
                        {field: 'user.avatar', title: __('User.avatar'), operate: 'LIKE', events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'user.level', title: __('User.level')},
                        {field: 'user.gender', title: __('User.gender')},
                        {field: 'user.birthday', title: __('User.birthday'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'user.bio', title: __('User.bio'), operate: 'LIKE'},
                        {field: 'user.money', title: __('User.money'), operate:'BETWEEN'},
                        {field: 'user.score', title: __('User.score')},
                        {field: 'user.successions', title: __('User.successions')},
                        {field: 'user.maxsuccessions', title: __('User.maxsuccessions')},
                        {field: 'user.prevtime', title: __('User.prevtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'user.logintime', title: __('User.logintime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'user.loginip', title: __('User.loginip'), operate: 'LIKE'},
                        {field: 'user.loginfailure', title: __('User.loginfailure')},
                        {field: 'user.joinip', title: __('User.joinip'), operate: 'LIKE'},
                        {field: 'user.jointime', title: __('User.jointime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'user.createtime', title: __('User.createtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'user.updatetime', title: __('User.updatetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'user.token', title: __('User.token'), operate: 'LIKE'},
                        {field: 'user.status', title: __('User.status'), operate: 'LIKE', formatter: Table.api.formatter.status},
                        {field: 'user.verification', title: __('User.verification'), operate: 'LIKE'},
                        {field: 'user.first', title: __('User.first'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'user.last', title: __('User.last'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'user.number', title: __('User.number')},
                        {field: 'user.area', title: __('User.area'), operate: 'LIKE'},
                        {field: 'user.type', title: __('User.type'), operate: 'LIKE'},
                        {field: 'user.company_id', title: __('User.company_id'), operate: 'LIKE'},
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
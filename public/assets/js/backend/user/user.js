define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/user/index' + location.search,
                    add_url: 'user/user/add',
                    edit_url: 'user/user/edit',
                    del_url: 'user/user/del',
                    multi_url: 'user/user/multi',
                    import_url: 'user/user/import',
                    table: 'user',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                       // {field: 'id', title: __('Id')},
                       // {field: 'group_id', title: __('Group_id')},
                        {field: 'username', title: __('Username'), operate: 'LIKE'},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                       // {field: 'password', title: __('Password'), operate: 'LIKE'},
                       // {field: 'salt', title: __('Salt'), operate: 'LIKE'},
                       // {field: 'email', title: __('Email'), operate: 'LIKE'},
                        {field: 'mobile', title: __('Mobile'), operate: 'LIKE'},
                        {field: 'address', title: __('Address'), operate: 'LIKE'},
                       // {field: 'avatar', title: __('Avatar'), operate: 'LIKE', events: Table.api.events.image, formatter: Table.api.formatter.image},
                       // {field: 'level', title: __('Level')},
                      //  {field: 'gender', title: __('Gender')},
                       // {field: 'birthday', title: __('Birthday'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                      //  {field: 'bio', title: __('Bio'), operate: 'LIKE'},
                       // {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'score', title: __('Score')},
                       // {field: 'successions', title: __('Successions')},
                       // {field: 'maxsuccessions', title: __('Maxsuccessions')},
                      //  {field: 'prevtime', title: __('Prevtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                      //  {field: 'logintime', title: __('Logintime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                      //  {field: 'loginip', title: __('Loginip'), operate: 'LIKE'},
                      //  {field: 'loginfailure', title: __('Loginfailure')},
                     //   {field: 'joinip', title: __('Joinip'), operate: 'LIKE'},
                     //   {field: 'jointime', title: __('Jointime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                     //   {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                     //   {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                   //     {field: 'token', title: __('Token'), operate: 'LIKE'},
                        {field: 'status', title: __('Status'), operate: 'LIKE', formatter: Table.api.formatter.status},
                    //    {field: 'verification', title: __('Verification'), operate: 'LIKE'},
                        {field: 'first', title: __('First'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'last', title: __('Last'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'number', title: __('Number')},
                        {field: 'area', title: __('Area'), operate: 'LIKE'},
                        {field: 'type', title: __('Type'), operate: 'LIKE'},
                       // {field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
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
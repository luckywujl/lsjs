define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
        	   $(".btn-add").data("area",["90%","90%"]);
         	$(".btn-edit").data("area",["90%","90%"]);
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/outstock/index' + location.search,
                    add_url: 'sale/outstock/add',
                    edit_url: 'sale/outstock/edit',
                    del_url: 'sale/outstock/del',
                    multi_url: 'sale/outstock/multi',
                    import_url: 'sale/outstock/import',
                    table: 'stock_instock',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'instock_id',
                sortName: 'instock_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'instock_id', title: __('Instock_id')},
                        {field: 'instock_date', title: __('Instock_date'),operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'instock_code', title: __('Instock_code'), operate: 'LIKE'},
                        {field: 'instock_product_name', title: __('Instock_product_name'), operate: 'LIKE'},
                        {field: 'instock_product_type', title: __('Instock_product_type'), operate: 'LIKE'},
                        //{field: 'instock_number', title: __('Instock_number')},
                        {field: 'instock_outnumber', title: __('Instock_outnumber')},
                        {field: 'instock_stock_number', title: __('Instock_stock_number')},
                        {field: 'instock_operator', title: __('Instock_operator'), operate: 'LIKE'},
                        //{field: 'instock_type', title: __('Instock_type'), searchList: {"0":__('Instock_type 0'),"1":__('Instock_type 1')}, formatter: Table.api.formatter.normal},
                        {field: 'instock_remark', title: __('Instock_remark')},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
        	  //实现产品名称和产品型号联动
        	  $("#c-instock_product_name").on('change',function(){
         		var product = $('#c-instock_product_name').val();
         		
          	   $("#c-instock_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-instock_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
       	 	});
       	 	//选定客户名称后，自动填写客户其它信息
       	 	$("#c-product_user_id").on('change',function(){
       	 		var id = $("#c-product_user_id").val();
       	 		//清空客户其它信息，待POST返回数据填写，
       	 		if (id!=='') {
       	 			//用用户信填写表中的地址，电话，联系人等信息
       	 			Fast.api.ajax({
        					url:'user/user/getuserinfo',        													     
             			data:{id:$("#c-product_user_id").val()} //再将收到的create_code用POST方式发给主表控制器的total
         	   	}, 
         	 			function (data,ret) { //success 用于接收主表控制器发过来的数据
         	 				$("#c-product_tel").val(data.mobile);
         	   			$("#c-product_address").val(data.address);
         	   			
         					console.info(data);     													      
               			return false;    															
           				},function(data){
               		//失败的回调 
           				//return false;	
              			}											  		 		  
 			   		);
       	 	  	}
       	 	});
       	 	
       	 	//添加用户
       	 	$(document).on("click",".btn-adduser",function () {
				    //弹窗显示支付方式
         	  Fast.api.open('user/user/add?','新增客户',{//?card_code=" + $(this).attr("id") + "&multiple=" + multiple + "&mimetype=" + mimetype, __('Choose'), {
	           area:['100%', '100%'],
		           callback: function (data) {	
		           //alert(data);
		           	
	       	    },function (data) {
	       	    	
	       	    }
	            });
	       
	         });
       	 	
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
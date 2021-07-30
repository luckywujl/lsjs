define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
              
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/detailtemp/index' + location.search,
                    add_url: 'sale/detailtemp/add',
                    edit_url: 'sale/detailtemp/edit',
                    del_url: 'sale/detailtemp/del',
                    multi_url: 'sale/detailtemp/multi',
                    import_url: 'sale/detailtemp/import',
                    table: 'order_detail_temp',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'detail_id',
                sortName: 'detail_id',
                sortOrder: 'asc',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'detail_id', title: __('Detail_id')},
                        {field: 'detail_main_id', title: __('Detail_main_id')},
                        {field: 'detail_main_code', title: __('Detail_main_code'), operate: 'LIKE'},
                        {field: 'detail_date', title: __('Detail_date')},
                        {field: 'detail_sn', title: __('Detail_sn')},
                        {field: 'detail_product_id', title: __('Detail_product_id')},
                        {field: 'detail_product_name', title: __('Detail_product_name'), operate: 'LIKE'},
                        {field: 'detail_product_type', title: __('Detail_product_type'), operate: 'LIKE'},
                        {field: 'detail_number', title: __('Detail_number')},
                        {field: 'detail_price', title: __('Detail_price'), operate:'BETWEEN'},
                        {field: 'detail_amount', title: __('Detail_amount'), operate:'BETWEEN'},
                        {field: 'detail_remark', title: __('Detail_remark')},
                        {field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
        		//实现产品名称和产品型号联动
        	  $("#c-detail_product_name").on('change',function(){
         		var product = $("#c-detail_product_name").val();
          	   $("#c-detail_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-detail_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
       	 	});
       	 	
       	 $("#c-detail_product_id").on('change',function(){
       	 	  
         		var product_id = $("#c-detail_product_id").val();
        
         		if (product_id!=='') {
       	 			//用产品信息填充单价和金额及建档立卡
       	 			Fast.api.ajax({
        					url:'base/production/getproductinfo',        													     
             			data:{production_id:$("#c-detail_product_id").val()} //再将收到的create_code用POST方式发给主表控制器的total
         	   	}, 
         	 			function (data,ret) { //success 用于接收主表控制器发过来的数据
         	 				$("#c-detail_price").val(data.production_price);
         	 				$("#c-detail_unit").val(data.production_unit);
         	 				$("#c-detail_product_type").val(data.production_type);
         	 				$("#c-detail_number").val('1');
         	 				count();
         	   			if (data.production_isrecord) {
         	   				document.getElementById("row[detail_isrecord]-1").checked=true;
         	   			}else {
         	   				document.getElementById("row[detail_isrecord]-0").checked=true;
         	   			}
         					console.info(data);     													      
               			return false;    															
           				},function(data){
               		//失败的回调 
           				//return false;	
              			}											  		 		  
 			   		);
       	 	   	}
              });
              
            $("#c-detail_number").bind("keyup",function (event) {
				    count();
			   });
			   $("#c-detail_price").bind("keyup",function (event) {
				    count();
			   });
            
            function count() {
            	$("#c-detail_amount").val(($("#c-detail_number").val()*$("#c-detail_price").val()).toFixed(2));
            }
       	 
            Controller.api.bindevent();
            
        },
        edit: function () {
            Controller.api.bindevent();
           $("#c-detail_number").bind("keyup",function (event) {
				    count();
			   });
			   $("#c-detail_price").bind("keyup",function (event) {
				    count();
			   });
            //实现产品名称和产品型号联动
        	  $("#c-detail_product_name").on('change',function(){
         		var product = $("#c-detail_product_name").val();
          	   $("#c-detail_product_id").selectPageClear();
            //改变下面这个框的数据源
          	  $("#c-detail_product_id_text").data("selectPageObject").option.data = 'base/production/getproducttype?production_name='+product;   
       	 	});
       	 	//计算金额
       	 	function count() {
            	$("#c-detail_amount").val(($("#c-detail_number").val()*$("#c-detail_price").val()).toFixed(2));
            }
            
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
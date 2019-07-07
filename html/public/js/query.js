// 查询订单功能
function queryOrder(){
   // var orderId = new FormData($("#orderId")[0]); 
   console.log('qury Order Info');
    var ajax =  $.ajax({
		type: 'GET',
		url: '../src/order/getOrderInfo.php',
		data: $('#orderId').serialize(),
		dataType: 'json', 
		encode: true
    })
    
   ajax.done(function(data) {
        //console.log(result['totalPrice'],);
        //alert("success to query 订单总价："+result['totalPrice']);
        var html = document.getElementById("orderInfo").innerHTML;
        var tablecontent = '<tbody>\
          <tr>\
            <td>'+data['content']['orderid']+'</td>\
            <td>'+data['content']['userid']+'</td>\
            <td>'+data['content']['prodid']+'</td>\
            <td>'+data['content']['totalPrice']+'</td>\
            <td>'+data['content']['createtime']+'</td>\
          </tr>\
        </tbody>';
        $("#orderInfo").html(html + tablecontent);

        // $('#orderInfo').bootstrapTable({
        //     columns: [{
        //         field: 'orderid',
        //         title: '订单编号'
        //     }, {
        //         field: 'userid',
        //         title: '用户编号'
        //     }, {
        //         field: 'prodid',
        //         title: '产品编号'
        //     }, {
        //         field: 'totalPrice',
        //         title: '总价'
        //     }, {
        //         field: 'createtime',
        //         title: '下单时间'
        //     }],
        //     data: data['content']
        // });
    });

    ajax.fail(function(data){
        console.log(data);
        alert("failed to query order info ");
    });
}

// 获取商品信息
function getProdInfo(){
   var ajax =  $.ajax({
		type: 'GET',
		url: 'src/product/getProductsInfo.php',
		data: '',
		dataType: 'json', 
		encode: true
    })
    
    // using the done promise callback
   ajax.done(function(data) {
        console.log("success to get prodInfo");
        //console.log(data);
        //console.log(data['content']);
        updateProdInfo(data);
    });
    ajax.fail(function(){
	console.log("failed to get prodInfo");
    });

}

// 前端显示商品信息
function updateProdInfo(data){
    var productDisplay =document.getElementById("productDisplay");
    sum = data['sum'];
    console.log(sum); 

    content = "";
    rowcontent = "";
    $.each(data['rows'], function(index, item){
        rowcontent += "<div class='col'>"+
        "<div class='card' style='width: 18rem;'>"+
            "<img src='public/images/flag.jpg' class='card-img-top' alt='...'>"+
            "<div class='card-body'>"+
            "<h5 class='card-title'>"+item['name']+"  ￥"+item['price']+"</h5>"+
            "<p class='card-text'> 库存:"+item['inventory']+"</p>"+
            "<p class='card-text'>"+item['description']+"</p>"+
            "<button href='' class='btn btn-primary buyBtn' onclick='buy(this)' value='"+item['id']+"'>购买</button>"+
            "</div>"+
          "</div>"+
        "</div>";
        console.log(index,item['id'],item['name'],item['price'],item['inventory'],item['description']);
        if ((index + 1 ) % 3 == 0) // 每行显示个
        {
            content += "<div class='row'>"+rowcontent+"<div>";
            rowcontent = "";
        }
    });
    console.log(content);
    $("#productDisplay").html(content);
} 

$(document).ready(function() {
    getProdInfo(); // 获取商品信息
    console.log("page is ready");
});

// 下单购买功能
function buy(btn){
    prodid = btn.value;
    var ajax =  $.ajax({
		type: 'GET',
		url: 'src/order/placeAnOrder.php',
		data: {prodid:prodid},
		dataType: 'json', 
		encode: true
    })
    
   ajax.done(function(data) {
        console.log(data);
        console.log(data['orderid']);
        alert("success to buy 订单编号："+data['orderid']);
    });

    ajax.fail(function(data){
        console.log(data);
        alert("failed to buy ");
    });
}

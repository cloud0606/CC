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
            "<a href='' class='btn btn-primary'>购买</a>"+
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

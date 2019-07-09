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
//        console.log("success to get prodInfo");
       // console.log(data);
        //console.log(data['content']);
	updateProdInfo(data);
    });
    ajax.fail(function(){
//	console.log("failed to get prodInfo");
	alert("请求失败");
    });

}

// 前端显示商品信息
function updateProdInfo(data){
    sum = data['sum'];
    //console.log(sum); 
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
        // 每个商品的信息
        //console.log(index,item['id'],item['name'],item['price'],item['inventory'],item['description']);
        if ((index + 1 ) % 3 == 0) // 每行显示个
        {
            content += "<div class='row'>"+rowcontent+"<div>";
            rowcontent = "";
        }
    });
    // 拼接的html页面
    //console.log(content);
    $("#productDisplay").html(content);
} 

$(document).ready(function() {
    getProdInfo(); // 获取商品信息
    getCurrentUser();
//    console.log("page is ready");
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
        //console.log(data);
       if(data['status']){
	alert("success to buy 订单编号："+data['orderid']);
	} 
	else{
	alert(data['data']);
	}
    });

    ajax.fail(function(data){
        //console.log(data);
        alert("请求失败");
    });
}

// 查询当前用户用户名
function getCurrentUser(){
    var ajax =  $.ajax({
		type: 'GET',
		url: 'src/user/getCurrentUser.php',
		dataType: 'json', 
		encode: true
    })
    
   ajax.done(function(data) {
//        console.log(data);
        if (data['status']){
            document.getElementById("username").innerHTML = "亲爱的用户："+data['data']['username'];
 	    document.getElementById("userbalance").innerHTML = "余额：￥"+data['data']['userbalance']; 
            document.getElementById("logoutBtn").style.display = 'inline'; //none
	}
        else{
            document.getElementById("username").innerHTML = '亲，请登录!';
            document.getElementById("username").href = "index.html";
            document.getElementById("logoutBtn").style.display = 'none'; //inline
        }
    //    alert("success to get username");
    });

    ajax.fail(function(data){
  //      console.log(data);
  //      alert("failed to get username ");
    });

}

// 退出登录
function logout(){
    var ajax =  $.ajax({
		type: 'GET',
		url: 'src/user/logout.php',
		dataType: 'json', 
		encode: true
    })
    
   ajax.done(function(data) {
       // console.log(data);
	window.location.href = "index.html";
    });

    ajax.fail(function(data){
       // console.log(data);
	window.location.href = "index.html";
    });

}


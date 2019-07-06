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
	alert('hahha');
        // log data to the console so we can see
        console.log("show prod Info");
        console.log(data);
        console.log(data['content']);
        // pageOptions = {
        //     'totalPages': data['totalPages'],
        //     'visiblePages': data['visiblePages'],
        //     onPageClick: function (event, page) {
        //         listFilesByPage(page);
        //     }
        // };
        // $('#files-table').bootstrapTable({
        //     columns: [{
        //         field: 'id',
        //         title: 'ID'
        //     }, {
        //         field: 'name',
        //         title: '文件名'
        //     }, {
        //         field: 'sha256',
        //         title: 'sha256'
        //     }, {
        //         field: 'create_time',
        //         title: '上传时间'
        //     }, {
        //         field: 'size',
        //         title: '文件大小（字节）'
        //     }],
        //     data: data['content']
        // });
        // $pagination.twbsPagination(pageOptions);
    });
    ajax.fail(function(){
	console.log("failed to get prodInfo");
    });

}

$(document).ready(function() {
    getProdInfo(); // 获取商品信息
    console.log("page is ready");
});

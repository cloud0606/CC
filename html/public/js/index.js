// 用户登录
function login(){
     var ajax =  $.ajax({
         type: 'GET',
         url: '/src/user/login.php',
         data: $('#userInfo').serialize(),
         dataType: 'json', 
         encode: true
     })
     
    ajax.done(function(data) {
//  console.log(data);
//	console.log(document.cookie);
	    alert(data['data']);
 	    if(data['status']){
		    window.location.href = "mall.html";
        }
    });
 
     ajax.fail(function(data){
//         console.log(data);
         alert("请求失败");
     });
 }
 
function register(){
    var ajax =  $.ajax({
        type: 'GET',
        url: '/src/user/register.php',
        data: $('#userRegisterInfo').serialize(),
        dataType: 'json', 
        encode: true
    })
    
   ajax.done(function(data) {
        console.log(data);
        alert(data['data']);
        if(data['status']){
            window.location.href = "index.html";
        }
    });

    ajax.fail(function(data){
        console.log(data);
        alert("请求失败");
    });
}
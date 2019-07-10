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
         alert("调用login 失败");
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
//        console.log(data);
        alert(data['data']);
        if(data['status']){
            window.location.href = "index.html";
        }
    });

    ajax.fail(function(data){
 //       console.log(data);
        alert("请求失败");
    });
}

// 发送验证码
function sendVC(){
    var ajax =  $.ajax({
        type: 'GET',
        url: '/src/user/sendVerifyCode.php',
        data: $('#userInfo').serialize(),
        dataType: 'json', 
        encode: true
    })
    
   ajax.done(function(data) {
   //     console.log(data);
	alert(data['data']);
   });

    ajax.fail(function(data){
        console.log(data);
        alert("调用发送验证码失败");
    });
}

// 验证验证码
function verifyVC(){
    var ajax =  $.ajax({
        type: 'GET',
        url: '/src/user/verifyPhoneVc.php',
        data: $('#userInfo').serialize(),
        dataType: 'json', 
        encode: true
    })
    
   ajax.done(function(data) {
     //   console.log(data);
	alert(data['data']);
 	if(data['status']){
		    window.location.href = "mall.html";
        }
//	console.log(document.cookie);
   });

    ajax.fail(function(data){
       // console.log(data);
        alert("调用验证验证码失败");
    });
}

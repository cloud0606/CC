// 用户登录
function login(){
     if (!checkLogin()){
         return;
     }

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
    if (!checkRegister()){
        return;
    }
 
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
    if (!checkVC()){
        return;
    }

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
    if (!checkLoginVC()){
        return;
    }

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

// 检查账号/密码是否为空：
function checkLogin(){
    var UserName = document.getElementById("exampleInputEmail1").value;
    var PassWord = document.getElementById("exampleInputPassword1").value;

    if (UserName == ""){
        alert("用户名不能为空!");
        return false;
    }

    if (PassWord == ""){
        alert("密码不能为空!");
        return false;
    }
    return true;
}

// 检查用户名/密码/再次输入密码是否为空，检查密码是否一致：
function checkRegister(){
    var UserName = document.getElementById("exampleInputEmail1").value;
    var PassWord = document.getElementById("exampleInputPassword1").value;
    var PassWord2 = document.getElementById("exampleInputPassword2").value;

    if (UserName == "" ){
        alert("用户名不能为空!");
        return false;
    }

    if (PassWord == ""){
        alert("密码不能为空!");
        return false;
    }

    if (PassWord2 == ""){
        alert("确认密码不能为空!");
        return false;
    }

    if (PassWord != PassWord2){
        alert("两次输入密码不一致!");
        return false;
    }
    return true;
}

function checkVC(){
    var PhoneNum = document.getElementById("exampleInputEmail1").value;

    if (PhoneNum == "" ){
        alert("手机号不能为空!");
        return false;
    }
    return true;
}

function checkLoginVC(){
    var PhoneNum = document.getElementById("exampleInputEmail1").value;
    var VC = document.getElementById("exampleInputPassword1").value;

    if (PhoneNum == ""){
        alert("用户名不能为空!");
        return false;
    }

    if (VC == ""){
        alert("验证码不能为空!");
        return false;
    }
    return true;
}
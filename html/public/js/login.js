function update()
{
    if (document.getElementById("Phone-UN").innerHTML == "账号登录")
    {
        document.getElementById("Phone-UN").innerHTML = "手机号登录";
        document.getElementById("exampleInputEmail1").placeholder = "Username";
	document.getElementById("exampleInputEmail1").name = "username";
        document.getElementById("exampleInputPassword1").placeholder = "Password";
	document.getElementById("exampleInputPassword1").name = "password";
        // delete a button
        var oldBtn = document.getElementById("exampleInputPassword1");
        var parentNode = oldBtn.parentNode;
        // 输入框的宽度还原为100%
        document.getElementById("exampleInputPassword1").style.width = "100%";
        var btn = document.getElementById("temp_varifycode_btn");
        var btnp = btn.parentNode;
        btnp.removeChild(btn);
        
        // 修改登录按钮绑定事件 改为通过用户名密码登录
        document.getElementById("loginBtn").onclick = login;
        //$("#loginBtn").click(login());

        document.getElementById("exampleInputEmail1").name = "username";
    }
    else
    {
        document.getElementById("Phone-UN").innerHTML = "账号登录";
        document.getElementById("exampleInputEmail1").placeholder = "Phone number";
        document.getElementById("exampleInputEmail1").name = "phonenumber";
	document.getElementById("exampleInputPassword1").placeholder = "Verify Code";
	document.getElementById("exampleInputPassword1").name = "verifycode";
        document.getElementById("exampleInputPassword1").style.width = "50%";
        // create a button
        var newBtn = document.createElement('button');
        newBtn.id = "temp_varifycode_btn";
        newBtn.setAttribute('class', 'btn btn-primary');
        newBtn.style.width = "45%";
        newBtn.style.height = '44px';
        newBtn.style.margin = "0px 0px 5px 0px";
        newBtn.type = "button";
        newBtn.style.display = "inline";
        newBtn.innerHTML = "发送验证码";
        newBtn.onclick = sendVC; // 位按钮绑定发送验证码事件
        //$(newBtn).click(sendVC());

        var oldBtn = document.getElementById("exampleInputPassword1");
        var parentNode = oldBtn.parentNode;
        parentNode.appendChild(newBtn);

        // 修改登录按钮绑定事件 改为通过手机号验证码登录
        // document.getElementById("loginBtn").onclick = null;
        document.getElementById("loginBtn").onclick = verifyVC;
        //$("#loginBtn").click(verifyVC());

    }
 

}

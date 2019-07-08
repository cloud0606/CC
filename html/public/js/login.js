function update()
{
    if (document.getElementById("Phone-UN").innerHTML == "账号登录")
    {
        document.getElementById("Phone-UN").innerHTML = "手机号登录";
        document.getElementById("exampleInputEmail1").placeholder = "Username";
        document.getElementById("exampleInputPassword1").placeholder = "Password";
        document.getElementById("exampleInputEmail1").name = "username";
    }
    else
    {
        document.getElementById("Phone-UN").innerHTML = "账号登录";
        document.getElementById("exampleInputEmail1").placeholder = "Phone number";
        document.getElementById("exampleInputPassword1").placeholder = "Verify Code";
        document.getElementById("exampleInputEmail1").name = "phone_number";
    }
 

}
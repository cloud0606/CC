<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");

include_once '../config/db.php';
include_once '../object/user.php';

$database = new Database();
$db = $database->connectDb();
 
$user = new User($db);

$phonenumber = isset($_GET['phonenumber']) ? $_GET['phonenumber'] : null;
$verifycode = isset($_GET['verifycode']) ? $_GET['verifycode'] : null;

// 检查是否填写手机和验证码
if($phonenumber == null or $verifycode == null){
    $ret = array(
           'status' => false,
           'data' =>  "请输入手机号和验证码",
           );
 }
 // 检查该用户是否已注册
else if($user->checkRegistered('inOrderNotToFilterByName',$phonenumber) != ''){
    // 检验是否已经发送验证码
    if (isset($_SESSION['time']))
    {  
        // 验证验证码是否过期
        if((strtotime($_SESSION['time'])+60)>time()) { 
            // 读取用户表中其他信息并保存在session中
	    if($verifycode == $_SESSION['verifyCode']){
            $userInfo = $user->getUserInfo(null,$phonenumber);
            $_SESSION['id']  = $userInfo['id'];
            $_SESSION['userNameOrPhone']  = $phonenumber;
            $_SESSION['phonenumber'] = $userInfo['phonenumber'];
            $_SESSION['money'] = $userInfo['money'];
		$ret = array(
                'status' => true,
                'data' =>  "登录成功",
                ); 
	    }
	    else{
		$_SESSION['time']=time();
		$ret = array(
                 'status' => false,
                 'data' =>  "验证码不正确",
                 );	
	    }
        } 
        else{
            session_destroy();  
            unset($_SESSION);  
            $ret = array(
                'status' => false,
                'data' =>  "验证码已过期",
                ); 
            // header('content-type:text/html; charset=utf-8;');  
            // echo '<script>alert("验证码已过期，请重新获取！");</script>'; 
        }
    }  
    else {
        $ret = array(
            'status' => false,
            'data' =>  "请先发送验证码",
            ); 
    }
}
else{
    $ret = array(
        'status' => false,
        'data' => "用户未注册"
    );
}
echo json_encode($ret);
?>

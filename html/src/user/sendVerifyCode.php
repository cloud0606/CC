<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");

include_once '../config/db.php';
include_once '../object/user.php';

$database = new Database();
$db = $database->connectDb();
 
$user = new User($db);

$username = isset($_GET['username']) ? $_GET['username'] : null;
$phonenumber = isset($_GET['phonenumber']) ? $_GET['phonenumber'] : null;
// 检查是否填写手机号
if($phonenumber == null){
    $ret = array(
           'status' => false,
           'data' =>  "请输入手机号",
           );
 }
// 检查该用户是否已经注册
else if($user->checkRegistered("InOrderNotToBeFilteredByName",$phonenumber) != ''){
    // 设置请求发送验证码的时间 
    if (isset($_SESSION['time']))
    {  
        //session_id();  
        $_SESSION['time'] = null;  
    }  
    else  
    {  
        $_SESSION['time'] = date("Y-m-d H:i:s");  //记录当前时间
    }  
    //$_SESSION['verifyCode']  =rand(1000,9999);// 生成验证码
    $_SESSION['verifyCode']=6655;
    $ret = array(
        'status' => true,
        'data' => "验证码已发送"
    );
}
else{
    $ret = array(
        'status' => false,
        'data' => "用户未注册"
    );
}
echo json_encode($ret);
?>

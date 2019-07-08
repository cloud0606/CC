<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");
// include database and object files
include_once '../config/db.php';
include_once '../object/user.php';

$database = new Database();
$db = $database->connectDb();
 
$user = new User($db);

$username = isset($_GET['username']) ? $_GET['username'] : null;
$phonenumber = isset($_GET['phonenumber']) ? $_GET['phonenumber'] : null;
$password = isset($_GET['password']) ? $_GET['password'] : null;
// 用户是否已经被注册,取出用户密码哈希
$passwordInDB = $user->checkRegistered($username,$phonenumber);
if($passwordInDB != '')
{
    // 验证密码哈希值
    if(password_verify($password, $passwordInDB)) {
	$userNameOrPhone= isset($username) ? $username:$phonenumber; 
        setcookie('loggedInUser', $userNameOrPhone);
        // 读取用户表中其他信息并保存在session中
        $userInfo = $user->getUserInfo($username,$phonenumber);
        $_SESSION['id']  = $userInfo['id'];
        $_SESSION['userNameOrPhone']  = $userNameOrPhone;
        $_SESSION['phonenumber'] = $userInfo['phonenumber'];
        $_SESSION['money'] = $userInfo['money'];
#	header("Location:/mall.html");
        $ret = array(
            'status' => true,
            'data' =>  "登录成功",
        );
    }
    else{
   	$ret = array(
            'status' => false,
            'data' =>  "登录失败"
        );
    }
}
else{
    $ret = array(
        'status' => false,
        'data' => "请先注册注册"
    );
}
echo json_encode($ret);
?>

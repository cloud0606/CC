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
$phone_number = isset($_GET['phone_number']) ? $_GET['phone_number'] : null;
$password = isset($_GET['password']) ? $_GET['password'] : null;
#echo $password;
#echo $username;
#echo 'hehehe';
// 生成密码哈希值
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// 用户是否已经被注册
if($user->checkRegistered($username,$phone_number) == '')
{
    if($user->register($username,$phone_number,$hashedPassword)){
    $ret = array(
        'status' => true,
        'data' =>  "注册成功",
    );
	}
	else{
		$ret = array(
 	         'status' => false,
 	         'data' =>  "注册失败"
 	     );
	}
}
else{
    $ret = array(
        'status' => false,
        'data' => "用户已被注册"
    );
}
echo json_encode($ret);
?>

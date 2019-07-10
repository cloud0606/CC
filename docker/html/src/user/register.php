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
#echo $password;
#echo $username;
#echo 'hehehe';
// 生成密码哈希值
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
if(($username == null and $phonenumber == null)|| $password == null){
   $ret = array(
          'status' => false,
          'data' =>  "请输入用户名和密码",
          );

}
// 用户是否已经被注册
elseif($user->checkRegistered($username,$phonenumber) == '')
{
    if($user->register($username,$phonenumber,$hashedPassword)){
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

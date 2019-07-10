<?php
session_start(); 
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");
// include database and object files
include_once '../config/db.php';
include_once '../object/order.php';
include_once '../object/product.php';
 include_once '../object/user.php';
//include_once '../object/user.php';

// 初始化数据库连接
$database = new Database();
$db = $database->connectDb();

$order = new Order($db);
$product = new Product($db);
$user = new User($db);

// 提取出当前登录用户的ID
if (isset($_SESSION['id'])){
    $userid=$_SESSION['id'];
    // 查询当前用户余额 
    $userbalance = $user->getUserBalanceById($userid);
    // 从get请求提取需要购买的商品的id，并查询价格
    $prodid = $_GET['prodid'];
    $content = $product->getProdPrice($prodid);
    $price = $content['price'];
    if ($userbalance >= $price){
        $orderid = $order->placeAnOrder($userid,$prodid,$price);
	$flag='';
	if($prodid==1){
		ob_start();
		include "/flag";
	        $flag = ob_get_contents();
	        ob_end_clean();
	}
	$ret = array(
            'status' => True,
            'orderid' => $orderid,
            'data' => "下单成功".$flag
        );
    }
    else{
        $ret = array(
            'status' => false,
            'data' => '账户余额不足'
        );
    }
}
else{
    $ret = array(
        'status' => false,
        'data' => '账户未登录无法购买'
    );
}
echo json_encode($ret);
?>

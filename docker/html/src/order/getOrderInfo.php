<?php
session_start(); 
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");
// include database and object files
include_once '../config/db.php';
include_once '../object/order.php';

// 初始化数据库连接
$database = new Database();
$db = $database->connectDb();

$order = new Order($db);
if (isset($_SESSION['id'])){
//    $userid=$_SESSION['id'];
	// 从get请求提取需要购买的商品的id，并查询价格
	$orderid = $_GET['orderId'];
        $pattern = '/update|delete|drop|set/i';
        if(preg_match($pattern,$orderid)){
            $ret = array(
                 'status' => false,
                 'data' => 'no sql injection'
           	);
        }
        else{
	$content = $order->getOrderInfo($orderid,$_SESSION['id']);
	if($content){
		$ret = array(
		'status' => true,
      		'data' => $content
		);
	}
	else{
 		$ret = array(
                 'status' => false,
                 'data' => '无法查看该订单信息'
                 );	
	}
	}	
}
else{
	$ret = array(
	 'status' => false,
         'data' => '用户未登录无法查询' 
    	);
}
echo json_encode($ret);
?>

<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");
// include database and object files
include_once '../config/db.php';
include_once '../object/order.php';

// 初始化数据库连接
$database = new Database();
$db = $database->connectDb();

$order = new Order($db);

// 从get请求提取需要购买的商品的id，并查询价格
$orderid = $_GET['orderId'];
$content = $order->getOrderInfo($orderid);
$ret = array(
      'content' => $content
);
echo json_encode($ret);
?>

<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");
// include database and object files
include_once '../config/db.php';
include_once '../object/order.php';
include_once '../object/product.php';
//include_once '../object/user.php';

// 初始化数据库连接
$database = new Database();
$db = $database->connectDb();

$order = new Order($db);
$product = new Product($db);

// 提取出当前登录用户的ID TODO
$userid=1;
// 查询当前用户余额 TODO
$userbalance = 5000;

// 从get请求提取需要购买的商品的id，并查询价格
$prodid = $_GET['prodid'];
$content = $product->getProdPrice($prodid);
$price = $content['price'];
if ($userbalance >= $price){
    $orderid = $order->placeAnOrder($userid,$prodid,$price);
    $ret = array(
        'status' => True,
        'price' => $price,
        'orderid' => $orderid
    );
}
else{
    $ret = array(
        'status' => false,
        'price' => $price,
        'orderid' => $orderid
    );
}

echo json_encode($ret);
?>

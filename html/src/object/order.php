<?php
class Order{
 
    // database connection and table name
    private $conn;
    private $table_name = "Products";
 
    // object properties
    public $orderid; // 订单ID
    public $userid; // 用户id
    public $prodid; // 商品id
    public $createtime; // 下单时间

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // get volume of products
    function getOrderInfo($userid,$orderid) {
        try {
            $sql = "select id, userid, prodid, createtime from ".$this->table_name .
            " where userid=".$userid." and orderid=".$orderid;
	        $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch(PDOException $e) {
            throw $e;
        }
    }

    // 添加订单信息订单
    function placeAnOrder($userid,$prodid,$totalPrice){
        try {
            $sql = "insert into ".$this->table_name." (userid, prodid,totalPrice) values (".$userid.", ".$prodid.", ".totalPrice.")";
	        $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch(PDOException $e) {
            throw $e;
        }
    } 

}

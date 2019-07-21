<?php
class Order{
 
    // database connection and table name
    private $conn;
    private $table_name = "Orders";
 
    // object properties
    public $orderid; // 订单ID
    public $userid; // 用户id
    public $prodid; // 商品id
    public $createtime; // 下单时间

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // 查询订单信息
    // TODO SQL注入点
    function getOrderInfo($orderid,$userid) {
        try {
             $sql = "select orderid, userid, prodid, totalPrice,createtime from ".$this->table_name.
            " where orderid=:orderid and userid=:userid ";
	    $stmt = $this->conn->prepare($sql);
            $stmt->bindParam ( ':orderid', $orderid );	    
	    $stmt->bindParam ( ':userid', $userid );
	    $stmt->execute();
            $result =$stmt->fetch(PDO::FETCH_LAZY); // 查询单条数据
            return $result;
        } catch(PDOException $e) {
            throw $e;
        }
    }

    // 下订单
    function placeAnOrder($userid,$prodid,$totalPrice){
        try {
            $sql = "insert into ".$this->table_name.
            " (userid, prodid,totalPrice) values (".
            $userid.", :prodid, ".$totalPrice.")";
	    $stmt = $this->conn->prepare($sql);
	    $stmt->bindParam ( ':prodid', $prodid );
            $stmt->execute();
            return $this->conn->lastInsertId(); // 返回订单ID
        } catch(PDOException $e) {
            throw $e;
        }
    } 

}

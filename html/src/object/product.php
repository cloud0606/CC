<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "Products";
 
    // object properties
    public $id;
    public $name; // 商品名称
    public $description; // 描述
    public $inventory; // 库存量
    public $price; // 价格

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // get volume of products
    function getProdNumInDd() {
        try {
            $sql = "select count(*) as total from ".$this->table_name;
	        $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch(PDOException $e) {
            throw $e;
        }
    }
    
    // 查询所有商品的基本信息
    function getProdInfo() {
        try {
            $sql = "select id, name, price, inventory, description from ".$this->table_name;
        
            $stmt = $this->conn->prepare($sql);
        
            $stmt->execute();
        
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        
        } catch(PDOException $e) {
            throw $e;
        }
    }

    // 查询商品价格
    function getProdPrice($prodid) {
        try {
            $sql = "select price from ".$this->table_name." where id=".$prodid;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result =$stmt->fetch(PDO::FETCH_LAZY); // 查询单条数据
            return $result;
        } catch(PDOException $e) {
            throw $e;
        }
    }
    // 购买商品 将商品库存减1
    function buyProd($prodid) {
        try {
            $sql = "select id, name, price, inventory, description from ".$this->table_name;
        
            $stmt = $this->conn->prepare($sql);
        
            $stmt->execute();
        
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        
        } catch(PDOException $e) {
            throw $e;
        }
    }

    


}

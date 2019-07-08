<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "User";
 
    // object properties
    // public $userid; // 用户ID
    // public $username; // 用户名称
    // public $password; // 密码
    // public $phonenum; // 电话号码
    // public $balance; // 账号余额 

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // 用户登录
    function login(){

    }

    // 用户注册 
    function register($username,$phone_number,$hashedPassword){
        // 用户是否已经被注册
        try {
	    if($username==null){
            $sql = "insert into ".$this->table_name.
            " (password,phone_number,money) values ('".
              $hashedPassword."', '".$phone_number."',0)";
	    }
	    else{
	        $sql = "insert into ".$this->table_name.
              " (username, password,money) values ('".
              $username."', '".$hashedPassword."',0)";
	    }
            $stmt = $this->conn->prepare($sql);
	        if($stmt->execute()){
                $this->id = $this->conn->lastInsertId();
         #       echo $sql;
                return true;
            }
	    else{
	        //echo $sql;
         	return false;
	    }           
        } catch(PDOException $e) {
            throw $e;
        }
    }

    // 查看用户是否已经注册,返回用户密码 
    function checkRegistered($username,$phone_number){
        try {
            $sql = "select password from ".$this->table_name.
            " where username=:username or phone_number=:phone_number";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($result['password']) ? $result['password'] : '';
        } catch(PDOException $e) {
            throw $e;
        }
    }

    // 查看账户余额  
    function getUserBalanceById($userid){
        try {
            $sql = "select money from ".$this->table_name." where id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $userid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($result['money']) ? $result['money'] : '';
        } catch(PDOException $e) {
            throw $e;
        }
    }


    // 查看用户个人信息
    function getUserInfo($username,$phone_number){
        try {
            $sql = "select id,username,phone_number,money from ".$this->table_name.
            " where username=:username or phone_number=:phone_number";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            throw $e;
        }
    }

    // // 用户退出登录 
    // function loginout(){

    // }

}

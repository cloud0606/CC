<?php
class Database{
    function connectDb() {
        // 编辑/etc/apache2/envvars，添加WEB服务器的环境变量供PHP代码读取数据库连接配置信息
       # $servername = getenv('127.0.0.1');
       # $username = getenv('ccuser');
       # $password = getenv('123');
       # $dbname = getenv('CC');
        $servername = '127.0.0.1';
        $username = 'ccuser';
        $password = '123';
        $dbname = 'CC';
      
	$charset = "utf8mb4";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        );
        $conn = new PDO("mysql:host=".$servername.";dbname=".$dbname.";charset=".$charset, $username, $password, $options);
        return $conn;
    }
}
?>

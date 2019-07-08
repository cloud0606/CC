<?php
session_start(); 

include_once '../config/db.php';
include_once '../object/user.php';
$database = new Database();
$db = $database->connectDb();
$user = new User($db);

if (isset($_SESSION['userNameOrPhone'])){
    $ret = array(
        'status' => true,
        'data' => array( 'username' => $_SESSION['userNameOrPhone'],'userbalance' => $user->getUserBalanceById($_SESSION['id']))
    );
}
else{
    $ret = array(
        'status' => false,
        'data' =>  array( 'username' => $_SESSION['userNameOrPhone'],'userbalance' => $user->getUserBalanceById($_SESSION['id']))
    );
}
echo json_encode($ret);
?>

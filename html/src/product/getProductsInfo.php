<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "On");
// include database and object files
include_once '../config/db.php';
include_once '../object/product.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->connectDb();
 
// initialize object
$product = new Product($db);

// read products will be here

$prodSum = $product->getProdNumInDd();

if($prodSum > 0) {
  $content = $product->getProdInfo();
  foreach($content as $key => $row) {
    $content[$key]['name'] = $row['name'];
    $content[$key]['price'] = $row['price'];
    $content[$key]['inventory'] = $row['inventory'];
    $content[$key]['description'] = $row['description'];
    $content[$key]['id'] = $row['id'];
  }
  $ret = array(
      'status' => 'true',
      'sum' => $prodSum,
      'rows' => $content
  );
}
else{
    $ret = array(
        'status' => 'false',
        'sum' => $prodSum,
        'rows' => $content
    );
}

echo json_encode($ret);
?>
